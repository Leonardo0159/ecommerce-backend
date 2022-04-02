<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PermissionUser;
use Illuminate\Http\Response;

class PermissionUserController extends Controller
{
    public function listAll()
    {
        $permissionUsers = PermissionUser::get();

        return response()->json(compact('permissionUsers'));
    }

    public function getWithId(int $PermissionUserId)
    {
        $PermissionUser = null;

        $PermissionUser = PermissionUser::where('id', $PermissionUserId)->first();

        return response()->json(compact('PermissionUser'));
    }

    public function save(Request $request, int $PermissionUserId = null)
    {
        if ($PermissionUserId) {
            $PermissionUser = PermissionUser::where('id', $PermissionUserId)->update($request->only([
                'permission_id',
                'user_id'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $PermissionUser = PermissionUser::create($request->only([
                'permission_id',
                'user_id'
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

        $permissionUserId = $request->post('id');
        $permissionUser = PermissionUser::where('id', $permissionUserId)->first();

        if ($permissionUser) {
            $permissionUser->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
