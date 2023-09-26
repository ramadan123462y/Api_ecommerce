<?php

namespace Database\Seeders;

use App\Models\ApiFrontend\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->delete();
      for($i=1;$i<=10;$i++){

        Categorie::create([

            'name'=>'category'.$i

          ]);
      }

    }
}
