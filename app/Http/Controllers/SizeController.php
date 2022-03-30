<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;
use Illuminate\Http\Response;

class SizeController extends Controller
{
    public function listAll() {
        $sizes = Size::get();

        return response()->json(compact('sizes'));
    }

    public function getWithId(int $SizeId) {

        $Size = null;

        $Size = Size::where('id', $SizeId)->first();

        return response()->json(compact('Size'));
    }

    public function save(Request $request, int $SizeId = null) {
        $this->validate($request, [
            "name" => "required|string|max:100|min:1"
        ]);

        $name = $request->post("name");
        if ($SizeId) {
            $Size = Size::where('id', $SizeId)->update([
                "name" => $name
            ]);
            return response()->json(["message"=>"Atualizou com sucesso"],Response::HTTP_OK);
        } else {
            $Size = Size::create([
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

        $sizeId = $request->post('id');
        $size = Size::where('id', $sizeId)->first();

        if($size){
            $size->delete(); 
            
            return response()->json(["message"=>"Deletou com sucesso"],Response::HTTP_OK);
        }
        
        return response()->json(["message"=>"Deu ruim"],Response::HTTP_NOT_ACCEPTABLE);
    }
}
