<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function listAll() {
        $products = Product::get();

        return response()->json($products, Response::HTTP_OK);
    }

    public function getWithId(int $ProductId) {

        $Product = null;

        $Product = Product::where('id', $ProductId)->first();

        return response()->json($Product, Response::HTTP_OK);
    }

    public function save(Request $request, int $ProductId = null) {
        $this->validate($request, [
            "name" => "required|string|max:100|min:1"
        ]);

        $name = $request->post("name");
        $barCode = $request->post("barCode");
        $idColor = $request->post("color_id");
        $idSize = $request->post("size_id");
        $idCategory = $request->post("category_id");
        $status = $request->post("status");
        if ($ProductId) {
            $Product = Product::where('id', $ProductId)->update([
                "name" => $name,
                "barCode" => $barCode,
                "color_id" => $idColor,
                "size_id" => $idSize,
                "category_id" => $idCategory,
                "status" => $status
            ]);
            return response()->json(["message"=>"Atualizou com sucesso"],Response::HTTP_OK);
        } else {
            $Product = Product::create([
                "name" => $name,
                "barCode" => $barCode,
                "color_id" => $idColor,
                "size_id" => $idSize,
                "category_id" => $idCategory,
                "status" => $status
            ]);
            return response()->json(["message"=>"Criou com sucesso"],Response::HTTP_OK);
        }
        return response()->json(["message"=>"Deu ruim"],Response::HTTP_NOT_ACCEPTABLE);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $productId = $request->post('id');
        $product = Product::where('id', $productId)->first();

        if($product){
            $product->delete(); 
            
            return response()->json(["message"=>"Deletou com sucesso"],Response::HTTP_OK);
        }
        
        return response()->json(["message"=>"Deu ruim"],Response::HTTP_NOT_ACCEPTABLE);
    }
}
