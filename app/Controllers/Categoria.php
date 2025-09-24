<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Categoria extends BaseController
{
    public function index()
    {
        echo "Controller Categoria, método index";
    }

    public function form(string $action, int $id)
    {
        echo "Controller Categoria, método: form";
    }
}