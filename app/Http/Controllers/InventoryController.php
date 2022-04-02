<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    public function listAll()
    {
        $inventories = Inventory::get();

        return response()->json(compact('inventories'));
    }

    public function getWithId(int $InventoryId)
    {

        $Inventory = null;

        $Inventory = Inventory::where('id', $InventoryId)->first();

        return response()->json(compact('Inventory'));
    }

    public function save(Request $request, int $InventoryId = null)
    {
        if ($InventoryId) {
            $Inventory = Inventory::where('id', $InventoryId)->update($request->only([
                'product_id',
                'quantity',
                'localization',
                'unitary_value',
                'status'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $Inventory = Inventory::create($request->only([
                'product_id',
                'quantity',
                'localization',
                'unitary_value',
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

        $inventoryId = $request->post('id');
        $inventory = Inventory::where('id', $inventoryId)->first();

        if ($inventory) {
            $inventory->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
