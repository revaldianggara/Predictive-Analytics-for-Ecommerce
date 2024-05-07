<?php

namespace Modules\UserConfig\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use stdClass;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->obj = new User();
    }

    public function getData($validated)
    {
        $query = User::when($validated != [], function ($q) use ($validated) {
            filterData($q, $validated);
        });
        return $query;
    }

    public function storeByRequest($data)
    {
        $obj = new User();
        $obj->name = $data['name'];
        $obj->username = $data['username'];
        $obj->email = $data['email'];
        $obj->password = Hash::make($data['password']);

        $role = Role::find($data['role']);
        $obj->assignRole($role);
        $obj->save();

        return $obj;
    }

    public function updateByRequest($id, $data)
    {

        DB::beginTransaction();
        $obj = $this->find($id);
        $obj->name = $data['name'];
        $obj->email = $data['email'];
        if ($data['password']) {
            $obj->password = Hash::make($data['password']);
        }
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $obj->assignRole($data['role']);
        $obj->save();
        DB::commit();

        return $obj;
    }

    public function find($id)
    {
        return $this->obj->withTrashed()->findOrFail($id);
    }

    public function queryUserRoles($obj_id)
    {
        return $this->find($obj_id)->roles();
    }

    public function getUserRolesIds($obj_id)
    {
        return $this->queryUserRoles($obj_id)->pluck('id')->toArray();
    }

    public function deleteById($id)
    {
        $obj = $this->find($id);
        $obj->delete();
    }

    public function restoreById($id)
    {
        $obj = $this->find($id);
        $obj->restore();
    }
}
