<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public function listAll()
    {
        $permissions = Permission::get();

        return response()->json(compact('permissions'));
    }

    public function getWithId(int $PermissionId)
    {
        $Permission = null;

        $Permission = Permission::where('id', $PermissionId)->first();

        return response()->json(compact('Permission'));
    }

    public function save(Request $request, int $PermissionId = null)
    {
        if ($PermissionId) {
            $Permission = Permission::where('id', $PermissionId)->update($request->only([
                'description',
                'information',
                'status'
            ]));
            return response()->json(["message" => "Atualizou com sucesso"], Response::HTTP_OK);
        } else {
            $Permission = Permission::create($request->only([
                'description',
                'information',
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

        $permissionId = $request->post('id');
        $permission = Permission::where('id', $permissionId)->first();

        if ($permission) {
            $permission->delete();

            return response()->json(["message" => "Deletou com sucesso"], Response::HTTP_OK);
        }

        return response()->json(["message" => "Deu ruim"], Response::HTTP_NOT_ACCEPTABLE);
    }
}
