<?php

namespace App\Repositories;

class BaseRepository
{
    protected $obj, $route, $view, $permission;

    public function setProperty($prop)
    {
        $this->route = optional($prop)['route'];
        $this->view = optional($prop)['view'];
        $this->permission = optional($prop)['permission'];
    }
}
