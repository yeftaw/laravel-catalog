<?php

namespace App;


class Category extends \Kalnoy\Nestedset\Node
{
	protected $table = 'categories';

	public $timestamps = false;

	protected $fillable = [
		'title', 'description'
	];

	public function products()
	{
		return $this->belongsToMany('App\Product');
	}

	public static function boot()
	{
		parent::boot();

		self::deleting(function($category)
		{
			$categories_id = $category->descendants()->lists('id');
			$categories_id[] = $category->getKey();
			$products = Product::whereHas('categories', function($q) use ($categories_id) {
					$q->whereIn('categories.id', $categories_id);
				})->get();

			if ($category->getDescendantCount() > 0)
			{
				$html = "This category has children, you can't delete this category until you removed all the children";

				\Session::flash('errorMsg', $html);

				return false;
			}
			else if($products->count() > 0)
			{
				$html = "Cannot delete this category due to still has related product(s).<br>\n";
				$html .= "<ul>\n";
				foreach ($products as $product) {
					$html .= "    <li>$product->name</li>\n";
				}
				$html .= "</ul>\n";

				\Session::flash('errorMsg', $html);

				return false;
			}
		});
	}
}
