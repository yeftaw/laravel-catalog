<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$parent1 = Category::create([
			'title' => 'Cars',
			'description' => 'A wheeled, self-powered motor vehicle used for transportation'
		]);
		$child1 = Category::create([
			'title' => 'Large'
		]);
		$child2 = Category::create([
			'title' => 'MPV'
		]);
		$child3 = Category::create([
			'title' => 'Van'
		]);
		$child4 = Category::create([
			'title' => 'Convertible'
		]);
		$child5 = Category::create([
			'title' => 'Sports'
		]);
		$child6 = Category::create([
			'title' => '4x4/SUV'
		]);
		$parent1->appendNode($child1);
		$parent1->appendNode($child2);
		$parent1->appendNode($child3);
		$parent1->appendNode($child4);
		$parent1->appendNode($child5);
		$parent1->appendNode($child6);
		$parent1->saveAsRoot();

		$parent2 = Category::create([
			'title' => 'Motorcycles',
			'description' => 'Vehicle used to transport people from one place to another.'
		]);
		$parent2->saveAsRoot();

		$parent3 = Category::create([
			'title' => 'Others',
			'description' => 'Others category.'
		]);
		$parent3->saveAsRoot();
	}
}
