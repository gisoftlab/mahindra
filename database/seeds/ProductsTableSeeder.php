<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 200; $i++) {
            $product = Product::where('id', '=', $i)->first();
            if ($product === null) {
                $product = Product::create([
                    'name' => $faker->name,
                    'description' => $faker->text,
                ]);

                $product->save();
            }
        }
    }
}
