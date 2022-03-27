<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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
        } else {
            $category = Category::create([
                "name" => $name
            ]);
        }
    }

    public function delete(Request $request): JsonResponse 
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $categoryId = $request->post('id');
        Category::where('id', $categoryId)->delete();

        //return response()->json("OK");
    }
}
