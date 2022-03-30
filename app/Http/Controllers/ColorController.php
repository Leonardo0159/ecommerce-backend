<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use Illuminate\Http\Response;

class ColorController extends Controller
{
    public function listAll() {
        $colors = Color::get();

        return response()->json(compact('colors'));
    }

    public function getWithId(int $ColorId) {

        $Color = null;

        $Color = Color::where('id', $ColorId)->first();

        return response()->json(compact('Color'));
    }

    public function save(Request $request, int $ColorId = null) {
        $this->validate($request, [
            "name" => "required|string|max:100|min:1"
        ]);

        $name = $request->post("name");
        if ($ColorId) {
            $Color = Color::where('id', $ColorId)->update([
                "name" => $name
            ]);
            return response()->json(["message"=>"Atualizou com sucesso"],Response::HTTP_OK);
        } else {
            $Color = Color::create([
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

        $colorId = $request->post('id');
        $color = Color::where('id', $colorId)->first();

        if($color){
            $color->delete(); 
            
            return response()->json(["message"=>"Deletou com sucesso"],Response::HTTP_OK);
        }
        
        return response()->json(["message"=>"Deu ruim"],Response::HTTP_NOT_ACCEPTABLE);
    }
}
