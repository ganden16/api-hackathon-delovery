<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function getAll()
    {
        $role = Role::paginate(5);

        return response()->json([
            'status' => true,
            'message' => 'list data role',
            'data' => $role
        ], 200);
    }

    public function findOne(Role $role)
    {
        return response()->json([
            'status' => true,
            'message' => 'data role',
            'data' => $role
        ]);
    }

    public function add(Request $request)
    {
        $data = [
            'nama' => $request['nama'],
        ];
        $rules = [
            'nama' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newRole = new Role($data);
        $newRole->save();

        return response()->json([
            'status' => true,
            'message' => 'tambah role sukses',
            'data' => $newRole
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request['nama'],
        ];
        $rules = [
            'nama' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        Role::where('id', $id)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'update role sukses',
            'data' => Role::find($id)
        ], 201);
    }

    public function delete($id)
    {
        $isRole = Role::find($id);
        if (!$isRole) {
            return response()->json([
                'status' => false,
                'message' => 'data role tidak ditemukan'
            ], 400);
        }
        Role::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus role berhasil, id role = ' . $id
        ]);
    }
}
