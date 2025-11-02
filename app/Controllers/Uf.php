<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UfModel;

class Uf extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UfModel();
    }

    public function index()
    {
        return view("admin/listaUf", $this->model->lista()); 
    }

    public function form(string $action, int $id)
    {
        return view("admin/formUf");
    }

    public function store()
    {
    }

    public function delete()
    {
    }
}