<?php

use App\Models\Product;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $products = Product::all();

        $seededAdminEmail = 'admin@admin.com';
        $user = User::where('email', '=', $seededAdminEmail)->first();

        foreach ($products as $product) {

            for ($i = 0; $i < 20; $i++) {
                $comment = Comment::where('id', '=', $i)->first();
                if ($comment === null) {
                    $comment = Comment::create([
                        'content' => $faker->text,
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                    ]);

                    $comment->save();
                }
            }
        }
    }
}
