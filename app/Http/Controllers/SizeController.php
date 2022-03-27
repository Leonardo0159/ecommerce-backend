<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;

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
        } else {
            $Size = Size::create([
                "name" => $name
            ]);
        }
    }

    public function delete(Request $request): JsonResponse 
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $SizeId = $request->post('id');
        Size::where('id', $SizeId)->delete();

        //return response()->json("OK");
    }
}
