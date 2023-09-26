<?php

namespace App\Repositories;

use App\Http\Traits\ApiResponse;

use App\Models\ApiFrontend\Categorie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesRepositrie
{
    use ApiResponse;
    public function get_all_categories()
    {

        try {
            $categories = Categorie::all();

            return $this->api($categories, 200, []);
        } catch (\Exception $e) {
            return $this->api(null, 400, [$e->getMessage()]);
        }
    }
    public function get_category_byid($id)
    {

        $categorie = Categorie::find($id);
        if ($categorie) {
            return $this->api($categorie, 200, []);
        } else {

            return $this->api(null, 200, ["categorie not found"]);
        }
    }
    public function store($request)
    {


        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
        ]);

        if ($validation->fails()) {
            return $this->api([], 400, [$validation->errors()]);
        } else {
            $categorie =  Categorie::create([

                'name' => $request->name
            ]);
            return $this->api($categorie, 200, ["categorie added Sucessfully"]);
        }
    }
    public function update($request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'id' => 'required'
        ]);


        if ($validation->fails()) {
            return $this->api([], 400, [$validation->errors()]);
        } else {

            if (empty(Categorie::find($request->id)->id)) {

                return $this->api([], 400, ["categorie not found"]);
            }

            $categorie = Categorie::find($request->id)->update([

                'name' => $request->name
            ]);
            return $this->api($categorie, 200, ["categorie Updated Sucessfully"]);
        }
    }
    public function destroy($request)
    {


        $validation = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->api([], 400, [$validation->errors()]);
        } else {
            if (empty(Categorie::find($request->id)->id)) {

                return $this->api([], 400, ["categorie not found"]);
            }


            $categorie =  Categorie::find($request->id)->delete();
            return $this->api($categorie, 200, ["categorie delete Sucessfully"]);
        }
    }
}
