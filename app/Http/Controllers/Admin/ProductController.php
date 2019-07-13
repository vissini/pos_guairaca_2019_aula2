<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 3;

    public function index()
    {
        //$prod = Product::withTrashed()->get();
        //$prod = Product::onlyTrashed()->get();
        //dd($prod);
        $prod = Product::withTrashed()->find(2);
        $prod->restore();
        //echo $prod->trashed();
        exit;

        $product = new Product;
        //$products = $product->ofType('moveis')->paginate($this->totalPage);
        $products = $product->paginate($this->totalPage);
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
    public function store(ProductRequest $request)
    {
        
        $dataForm = $request->all();
        //$dataForm = $request->only(['campo']);
        //$dataForm = $request->except(['campo']);
        //$dataForm = $request->input('campo');
        //$dataForm = $request->input('campo','valor Padrão');

        //$dataForm['active'] = isset($dataForm['active'])?1:0;
        $dataForm['active'] = $request->has('active');

    
        $product = new Product;
        $insert = $product->create($dataForm);
        if($insert){
            return redirect()->route('products.index')->with('success','Produto Inserido com Sucesso!');
        }else{
            return redirect()->route('products.create')->with('error','Erro ao inserir o Produto!');;
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
    public function edit(Product $product)
    {

        // $product = new Product();
        // $prod = $product->findOrFail($id);
        //$prod = $product->find($id);
        //$prod = Product::findOrFail($id);
        $prod = $product;
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
    public function update(ProductRequest $request, Product $product)
    {
        // $product = new Product();
        // $prod = $product->find($id);
        $dataForm = $request->all();
        $update = $product->update($dataForm);

        if($update){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('products.edit', $product->id);
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

    protected function _validate(Request $request, $productId=null)
    {
        $this->validate($request,[
            'name' => 'required|min:3|max:100',
            'number' => "required|numeric|unique:products,number,{$productId}",
            'category' => 'required',
            'description' => 'min:3|max:500|nullable' 
        ],
        [
            'number.required' => 'O Campo Número é obrigatório'
        ]);
    }
}
