<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function listAll()
    {
        $carts = Cart::get();

        return response()->json(compact('carts'));
    }

    public function getWithId(int $CartId)
    {

        $Cart = null;

        $Cart = Cart::where('id', $CartId)->first();

        return response()->json(compact('Cart'));
    }

    public function save(Request $request, int $CartId = null)
    {
        if ($CartId) {
            $Cart = Cart::where('id', $CartId)->update($request->only([
                'user_id',
                'total_value_cart',
                'status'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $Cart = Cart::create($request->only([
                'user_id',
                'total_value_cart',
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

        $cartId = $request->post('id');
        $cart = Cart::where('id', $cartId)->first();

        if ($cart) {
            $cart->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
