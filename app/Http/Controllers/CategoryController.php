<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = Category::withDepth()->get();
		$categories = $categories->toTree();

		return view('categories.index', ['categories' => $categories]);
	}

	public function create()
	{
		$categories = Category::withDepth()->get();
		$categories = $categories->toTree();

		return view('categories.create', ['categories' => $categories]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title'       => 'required|max:100',
			'description' => 'max:255',
			'id'          => 'integer|exists:categories'
		]);

		if(!$validator->fails())
		{
			$node = Category::create([
				'title'       => $request->input('title'),
				'description' => $request->input('description')
			]);

			$parent = $request->input('id');
			// if node save as root
			if($parent == null)
			{
				$node->saveAsRoot();

				return redirect('categories')
					->with('successMsg', $request->input('title').' has been successfully created as root category.');
			} else {
				$node->parent_id = $parent;
				$node->save();
				$parent_name = Category::find($parent)->title;

				return redirect('categories')
					->with('successMsg', $request->input('title').' has been successfully created under '.$parent_name);
			}
		} else {
			return redirect('categories/create')
				->withErrors($validator)
				->withInput();
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$category = Category::find($id);
		$categories = Category::withDepth()->get();
		$categories = $categories->toTree();

		return view('categories.edit', ['category' => $category, 'categories' => $categories]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$category = Category::findOrFail($id);

		$validator = Validator::make($request->all(), [
			'title'       => 'required|max:100',
			'description' => 'max:255',
			'id'          => 'integer|exists:categories'
		]);

		$parent = $request->input('id');
		$node = Category::find($parent);

		// if change the node
		if ($category->parent_id != $parent)
		{
			// if the node has children
			if ($category->getDescendantCount() > 0)
			{
				return redirect()
					->back()
					->with('errorMsg', 'This category has children, you can\'t move this category until you removed all the children');
			} else {
				if(!$validator->fails())
				{
					// delete node first
					$category->delete();
					// then recreate new node
					$node = Category::create([
						'title'       => $request->input('title'),
						'description' => $request->input('description')
					]);
					// if node move to root
					if($parent == null)
					{
						$node->saveAsRoot();

						return redirect('categories')
							->with('successMsg', $request->input('title').' has been successfully moved as root category.');
					} else {
						$node->parent_id = $parent;
						$node->save();
						$parent_name = Category::find($parent)->title;

						return redirect('categories')
							->with('successMsg', $request->input('title').' has been successfully moved under '.$parent_name);
					}
				} else {
					return redirect('categories')
						->with('successMsg', 'Category has been successfully edited.');
				}
			}
		} else {
			if(!$validator->fails())
			{
				$category->title = $request->input('title');
				$category->description = $request->input('description');
				$category->save();

				return redirect('categories')
					->with('successMsg', 'Category has been successfully edited.');
			} else {
				return redirect()
					->back()
					->withErrors($validator)
					->withInput();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$category = Category::findOrFail($id);

		if(!$category->delete())
		{
			return redirect('categories');
		}

		return redirect('categories')->with('successMsg', $category->title.' has been deleted.');
	}
}
