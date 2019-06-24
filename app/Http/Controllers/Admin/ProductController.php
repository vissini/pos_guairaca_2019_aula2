<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = new Product;
        $products = $product->all();
        $title = 'Lista de Produtos';
        return view('admin.products.index', compact('products', 'title'));                                
    }

    public function teste()
    {
        $product = new Product;
        $delete = $product->destroy(7);
        // $delete = $prod->delete();
        if($delete){
            return "Gravado com sucesso!";
        }else{
            return "Erro ao gravar!";
        }
        // $insert = $product->create([
        //     'name' => 'Mouse',
        //     'number' => 000,
        //     'active' => 0,
        //     'category' => 'informatica',
        //     'description' => 'Mouse sem fio da marca xxx',
        // ]);
        // if($insert){
        //     return "Gravado com sucesso!";
        // }else{
        //     return "Erro ao gravar!";
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Criar Produto';
        $prod = new Product();
        return view('admin.products.create', compact('prod','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $product = new Product;
        $insert = $product->create($dataForm);
        if($insert){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('products.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = new Product();
        $prod = $product->find($id);
        $title = "Editar Produto - {$prod->name}";
        return view('admin.products.edit', compact('prod','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = new Product();
        $prod = $product->find($id);
        $dataForm = $request->all();
        $update = $prod->update($dataForm);

        if($update){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('products.edit', $prod->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = new Product();
        $delete = $product->destroy($id);
        if($delete){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('products.index');
        }
    }
}
