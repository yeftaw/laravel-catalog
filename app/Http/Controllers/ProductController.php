<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User as User;
use App\Product;
use App\Category;
use Validator;

class ProductController extends Controller
{
	public function index(Request $request)
	{
		if($request->has('filter'))
		{
			$filter = $request->input('filter');
			$products = Product::whereHas('categories', function($q) use ($filter) {
									$q->whereIn('categories.id', $filter);
								})->simplePaginate(10);
		} else {
			$filter = "";
			$products = Product::with('categories')->simplePaginate(10);
		}

		$categories = Category::withDepth()->get();
		$categories = $categories->toTree();

		return view('products.index', ['products' => $products, 'categories' => $categories, 'filter' => $filter]);
	}

	public function create()
	{
		$categories = Category::withDepth()->get();
		$categories = $categories->toTree();

		return view('products.create', ['categories' => $categories]);
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'            => 'required|max:100',
			'model' 	      => 'max:100',
			'category_id'     => 'required|array',
			'photo'			  => 'image|max:2048'
		]);

		if(!$validator->fails())
		{
			$categories_id = $request->input('category_id');
			$catTitles = "";
			// add title and comma for success message
			foreach ($categories_id as $index => $id) {
				$catTitles .= Category::find($id)->title;
				if($index+1 != count($categories_id))
				{
					$catTitles .= ", ";
				}
			}

			$product = Product::create([
				'name'  => $request->input('name'),
				'model' => $request->input('model')
			]);

			$product->categories()->attach($categories_id);

			if($request->hasFile('photo'))
			{
				$uploaded_photo = $request->file('photo');
				$extension = $uploaded_photo->getClientOriginalExtension();
				$filename = md5(time()). '.' .$extension;
				$destinationPath =  public_path('img');
				$uploaded_photo->move($destinationPath, $filename);
			}

			$product->photo = $filename;
			$product->save();

			return redirect('products')
					->with('successMsg', $request->input('name').' has been successfully created under : '.$catTitles);
		} else {
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function edit($id)
	{
		$product = Product::with('categories')->find($id);
		$categories = Category::withDepth()->get();
		$categories_id = array();
		foreach ($product->categories as $category) {
			$categories_id[] = $category->id;
		}

		$categories = $categories->toTree();

		return view('products.edit', ['product' => $product, 'categories' => $categories, 'categories_id' => $categories_id]);
	}

	public function update(Request $request, $id)
	{
		$product = Product::findOrFail($id);

		$validator = Validator::make($request->all(), [
			'name'            => 'required|max:100',
			'model' 	      => 'max:100',
			'category_id'     => 'required|array',
			'photo'			  => 'image|max:2048'
		]);

		if(!$validator->fails())
		{
			$categories_id = $request->input('category_id');

			if($request->hasFile('photo'))
			{
				$uploaded_photo = $request->file('photo');
				$extension = $uploaded_photo->getClientOriginalExtension();
				$filename = md5(time()). '.' .$extension;
				$destinationPath =  public_path('img');
				$uploaded_photo->move($destinationPath, $filename);

				if($product->photo)
				{
					$old_cover = $product->photo;
					$filepath = public_path('img/'.$old_cover);

					try {
						\File::Delete($filepath);
					} catch (FileNotFoundException $e) {
						// file has been deleted or not exist
					}

				}

				// save photo change
				$product->photo = $filename;
				$product->save();
			}

			// save product change
			$product->name = $request->input('name');
			$product->model = $request->input('model');
			$product->save();

			// update pivot table
			$product->categories()->sync($categories_id);

			return redirect('products')
					->with('successMsg', $request->input('name').' has been successfully edited.');

		} else {
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function destroy($id)
	{
		$product = Product::find($id);

		if(!Product::destroy($id))
		{
			return redirect()->back();
		}

		return redirect('products')->with('successMsg', $product->name.' has been successfully deleted.');
	}
}
