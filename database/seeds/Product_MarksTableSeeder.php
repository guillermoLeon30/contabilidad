<?php

use Illuminate\Database\Seeder;

class Product_MarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProductMark::class, 50)->create();
    }
}
