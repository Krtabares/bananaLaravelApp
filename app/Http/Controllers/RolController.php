<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Rol;
use App\Http\BnImplements\RolBnImplement;

class RolController extends Controller
{
    private $rol_imp;

    public function __construct(RolBnImplement $rol_imp){
        $this->rol_imp = $rol_imp;
    }

    public function indexRol()
    {
        $result = $this->rol_imp->selectRol();

        dd($result);
    }

}
