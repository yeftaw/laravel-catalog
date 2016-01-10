<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = "products";

	protected $fillable = [
		'name', 'model', 'photo'
	];

	public function categories()
	{
		return $this->belongsToMany('App\Category', 'product_category', 'product_id', 'category_id');
	}

	public static function boot()
	{
		parent::boot();

		self::deleting(function($product)
		{
			$product->categories()->detach();
		});
	}
}
