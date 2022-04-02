<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryCart;
use Illuminate\Http\Response;

class InventoryCartController extends Controller
{
    public function listAll()
    {
        $inventoryCarts = InventoryCart::get();

        return response()->json(compact('inventoryCarts'));
    }

    public function getWithId(int $InventoryCartId)
    {

        $InventoryCart = null;

        $InventoryCart = InventoryCart::where('id', $InventoryCartId)->first();

        return response()->json(compact('InventoryCart'));
    }

    public function save(Request $request, int $InventoryCartId = null)
    {
        if ($InventoryCartId) {
            $InventoryCart = InventoryCart::where('id', $InventoryCartId)->update($request->only([
                'inventory_id',
                'cart_id',
                'total_value_products',
                'quantity'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $InventoryCart = InventoryCart::create($request->only([
                'inventory_id',
                'cart_id',
                'total_value_products',
                'quantity'
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

        $inventoryCartId = $request->post('id');
        $inventoryCart = InventoryCart::where('id', $inventoryCartId)->first();

        if ($inventoryCart) {
            $inventoryCart->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
