<?php

namespace App\Http\Controllers\ApiFrontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\ApiFrontend\Categorie;
use App\Repositories\CategoriesRepositrie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    use ApiResponse;
    protected $categorie;

    public function __construct(CategoriesRepositrie $categorie)
    {


        $this->categorie = $categorie;
    }
    public function get_all_categories()
    {

        return $this->categorie->get_all_categories();
    }
    public function get_category_byid($id)
    {

        return $this->categorie->get_category_byid($id);
    }


    public function store(Request $request)
    {
        return $this->categorie->store($request);
    }
    public function update(Request $request)
    {
        return $this->categorie->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->categorie->destroy($request);
    }
}
