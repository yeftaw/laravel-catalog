<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$product1 = Product::create([
			'name'  => 'Hyundai IX20',
			'model' => '1,4 Blue Drive Classic 5DR',
			'photo' => 'Hyundai_IX20.jpg'
		]);
		$product1->categories()->attach([1, 2]);

		$product2 = Product::create([
			'name'  => 'Centrion Berlingo Multispace',
			'model' => '1.6 HDI 90 Plus 5DR',
			'photo' => 'Centrion_Berlingo_Multispace.jpg'
		]);
		$product2->categories()->attach([1, 2]);

		$product3 = Product::create([
			'name'  => 'Mini Convertible',
			'model' => '1.6 Cooper S Sidewalk',
			'photo' => '21b6a37b55ca2a155df97c9329a1270a.jpg'
		]);
		$product3->categories()->attach([1, 5]);

		$product3 = Product::create([
			'name'  => 'Nissan Qashqai',
			'model' => '1.6 N-TEC',
			'photo' => '6f73d1a742aca5458e785b2bedea419c.jpg'
		]);
		$product3->categories()->attach([1, 7]);
	}
}
