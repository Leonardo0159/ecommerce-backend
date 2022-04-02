<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Illuminate\Http\Response;

class PromotionController extends Controller
{
    public function listAll()
    {
        $promotions = Promotion::get();

        return response()->json(compact('promotions'));
    }

    public function getWithId(int $PromotionId)
    {
        $Promotion = null;

        $Promotion = Promotion::where('id', $PromotionId)->first();

        return response()->json(compact('Promotion'));
    }

    public function save(Request $request, int $PromotionId = null)
    {
        if ($PromotionId) {
            $Promotion = Promotion::where('id', $PromotionId)->update($request->only([
                'description',
                'value',
                'status'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $Promotion = Promotion::create($request->only([
                'description',
                'value',
                'status'
            ]));
            return response()->json(["message" => "Criou com sucesso"], Response::HTTP_OK);
        }
        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $promotionId = $request->post('id');
        $promotion = Promotion::where('id', $promotionId)->first();

        if ($promotion) {
            $promotion->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
