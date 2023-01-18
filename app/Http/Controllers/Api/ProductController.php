<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth:sanctum');
    }
    public function view_products(){
        $products = Product::all();
        // return response(['status'=> 'success','data'=>$products],200);
        return response(['status' => 'success', 'description' => 'Products loading', $products], 200);

    }


    public function save_product(Request $request){

        $validate = $request->validate([
            'name'=>'required',
            'category'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);

        $products = Product::create($validate);

        return response(['status' => 'success', 'discription' => 'product saved successfully', 'data' => $products], 200);

    }

    public function update(Request $request, $id){

        $validate = $request->validate([
            'name'=>'required',
            'category'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);

        $update = Product::whereId($id)->update($validate);

        return response(['status' => true, 'message' => 'updated the data','data'=>$update],200);

    }


    public function delete($id){

        $products = Product::find($id)->delete();

        return response(['status' => true, 'message' => 'Product deleted successfully']);
    }


}
