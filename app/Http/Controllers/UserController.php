<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function listAll()
    {
        $users = User::get();

        return response()->json(compact('users'));
    }

    public function getWithId(int $UserId)
    {
        $User = null;

        $User = User::where('id', $UserId)->first();

        return response()->json(compact('User'));
    }

    public function save(Request $request, int $UserId = null)
    {
        if ($UserId) {
            $User = User::where('id', $UserId)->update($request->only([
                'name',
                'email',
                'password',
                'cpf',
                'admin'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $User = User::create($request->only([
                'name',
                'email',
                'password',
                'cpf',
                'admin'
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

        $userId = $request->post('id');
        $user = User::where('id', $userId)->first();

        if ($user) {
            $user->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
