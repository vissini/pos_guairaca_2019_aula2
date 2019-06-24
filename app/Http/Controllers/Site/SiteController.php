<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function __construct(){
        //$this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $var1 = 'Variavel1';
        $xss="<script>alert('teste');</script>";
        $var2 = 1;
        $arrayData = [1,2,3,4,5,6,7,8,9,0];
        return view('site.index', compact('var1', 'xss', 'var2', 'arrayData'));
    }

    
    public function contato()
    {
        return view('site.contato');
    }
    public function contato2()
    {
        return "Estamos no Contato2";
    }
    public function categoria($idCat=999)
    {
        return "Estamos na Categoria: {$idCat}";
    }
}
