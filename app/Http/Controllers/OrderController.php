<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function listAll()
    {
        $orders = Order::get();

        return response()->json(compact('orders'));
    }

    public function getWithId(int $OrderId)
    {
        $Order = null;

        $Order = Order::where('id', $OrderId)->first();

        return response()->json(compact('Order'));
    }

    public function save(Request $request, int $OrderId = null)
    {
        if ($OrderId) {
            $Order = Order::where('id', $OrderId)->update($request->only([
                'cart_id',
                'promotion_id',
                'total_value'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $Order = Order::create($request->only([
                'cart_id',
                'promotion_id',
                'total_value'
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

        $orderId = $request->post('id');
        $order = Order::where('id', $orderId)->first();

        if ($order) {
            $order->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
