<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    public function listAll()
    {
        $addresses = Address::get();

        return response()->json(compact('addresses'));
    }

    public function getWithId(int $AddressId)
    {
        $Address = null;

        $Address = Address::where('id', $AddressId)->first();

        return response()->json(compact('Address'));
    }

    public function save(Request $request, int $AddressId = null)
    {
        if ($AddressId) {
            $Address = Address::where('id', $AddressId)->update($request->only([
                'user_id',
                'street',
                'district',
                'city',
                'uf',
                'cep',
                'number',
                'complement'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $Address = Address::create($request->only([
                'user_id',
                'street',
                'district',
                'city',
                'uf',
                'cep',
                'number',
                'complement'
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

        $addressId = $request->post('id');
        $address = Address::where('id', $addressId)->first();

        if ($address) {
            $address->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
