<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected $obj_repository, $route, $view, $permission;

    public function getPropertyToRepository()
    {
        return [
            'route' => $this->route,
            'view' => $this->view,
            'permission' => $this->permission,
        ];
    }

    public function view($view_name, $data = [], $optional = [])
    {
        return view($this->view . $view_name, array_merge([
            'route' => $this->route,
            'permission' => $this->permission,
            'view' => $this->view,
            'data' => $data
        ], $optional));
    }

    public static function errorResponse($message, $code = 400, $response = [])
    {
        return response()->json(array_merge(
            ["status" => false, "message" => $message],
            $response ?? []
        ), $code);
    }

    public static function successResponse($response, $message = "Ok", $code = 200)
    {
        return response()->json(array_merge(
            ["status" => true, "message" => $message],
            $response ?? []
        ));
    }
}
