<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function listAll() {
        $categories = Category::get();

        return response()->json(compact('categories'));
    }

    public function getWithId(int $categoryId) {

        $category = null;

        $category = Category::where('id', $categoryId)->first();

        return response()->json(compact('category'));
    }

    public function save(Request $request, int $categoryId = null) {
        $this->validate($request, [
            "name" => "required|string|max:100|min:1"
        ]);

        $name = $request->post("name");
        if ($categoryId) {
            $category = Category::where('id', $categoryId)->update([
                "name" => $name
            ]);
            return response()->json(["message"=>"Atualizou com sucesso"],Response::HTTP_OK);
        } else {
            $category = Category::create([
                "name" => $name
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

        $categoryId = $request->post('id');
        $category = Category::where('id', $categoryId)->first();

        if($category){
            $category->delete(); 
            
            return response()->json(["message"=>"Deletou com sucesso"],Response::HTTP_OK);
        }
        
        return response()->json(["message"=>"Deu ruim"],Response::HTTP_NOT_ACCEPTABLE);
    }
}
