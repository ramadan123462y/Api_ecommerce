<?php

namespace Database\Seeders;

use App\Models\ApiFrontend\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        for($i=1;$i<=10;$i++){

          Product::create([

            'name'=>'name'.$i,
            'price'=>$i,
            'stock'=>$i,
            'categorie_id'=>$i

            ]);
        }
    }
}
