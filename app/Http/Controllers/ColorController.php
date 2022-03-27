<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;

class ColorController extends Controller
{
    public function listAll() {
        $color = Color::get();

        return response()->json(compact('color'));
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
        } else {
            $Color = Color::create([
                "name" => $name
            ]);
        }
    }

    public function delete(Request $request): JsonResponse 
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $ColorId = $request->post('id');
        Color::where('id', $ColorId)->delete();

        //return response()->json("OK");
    }
}
