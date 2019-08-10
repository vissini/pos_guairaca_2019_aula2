<?php
*Deve sertar o nome do controle@metodo que vai chamar na rota
Route::get('/', 'SiteController@index');
*Como o index ainda não existe, devemos criar ele.
    public function index()
    {
        return 'Site Controller';
    }
*Demonstrar como as rotas ficaram mais enxutas
*criar uma rota /contato e seu método
Route::get('/contato', 'SiteController@contato');
public function contato()
    {
        return 'Contato';
    }
*Demonstrar como criar uma rota com parametro, chamando o Controller
*Perguntar como deixar o parametro opcional
Route::get('/categoria/{idCat?}', 'SiteController@categoria');
public function categoria($idCat = 1)
    {
        return "Categoria = {$idCat}";
    }
*Mostrar como prefiro organizar meus controllers separando dentro das pastinhas....
*Mostrar de forma manual, para explicar como funciona o namespace, e tb o composer auto-load
*Criar uma pasta Site dentro de controllers
*Mover o controle SiteController para dentro da pasta Site
*Alterar namespace para:
namespace App\Http\Controllers\Site;
*Como a classe controller do extends não está na mesma pasta do SiteController, devemos dar um use nele
use App\Http\Controllers\Controller;
*Alterar a rota para pegar do novo namespace adicionando o /site no caminho do controller nas rotas
Route::get('/', 'Site\SiteController@index');
Route::get('/contato', 'Site\SiteController@contato');
Route::get('/categoria/{idCat?}', 'Site\SiteController@categoria');
*Podemos melhorar isso criando um route group
Route::group(['namespace'=>'Site'], function(){
    Route::get('/', 'SiteController@index');
    Route::get('/contato', 'SiteController@contato');
    Route::get('/categoria/{idCat?}', 'SiteController@categoria');
});
*Comentar que as vezes, qdo vc faz uma alteração de pastas, ou apaga alguma classe, o autload pode não enxergar esse arquivo, então devemos usar o comando:
composer dump-autoload
*Mostrar como ja criar o controller dentro do namespace desejado
php artisan make:controller Admin\\AdminController

*Demonstrar formas de como podemos usar o middleware
*Forma1: passando diretamente no group
Route::group(['namespace'=>'Site', 'middleware'=>'auth'], function(){
    Route::get('/', 'SiteController@index');
    Route::get('/contato', 'SiteController@contato');
    Route::get('/categoria/{idCat?}', 'SiteController@categoria');
});
*Forma2: Passando diretamente na rota
Route::get('/contato', 'SiteController@contato')->middleware('auth');
*Demonstrar que essa rota em especifico ficou inacessivel
*Forma 3: Utilizar o middleware chamando de dentro de um construtor
public function __contruct()
    {
        $this->middleware('auth');
    }
*Explicar como funciona o construct
*Demonstrar utilizando qualquer uma das rotas que utilizam esse controller.
*Demonstrar formas de dizer qual metodo vai passar pelo middleware, pode passar uma string com o método ou um array
public function __contruct()
    {
        $this->middleware('auth')->only(['contato', 'categoria']);
    }
*Mostrar tentando acessar a rota /  e depois tentando acessar a rota contato, e depois tentando acessar a rota categoria
*Da para setar qual não vai passar
public function __contruct()
    {
        $this->middleware('auth')->except(['index', 'contato']);
    }

*Demonstrar agora como funciona a criação de um controller do tipo resource. O que seria um controller do tipo resource??
*Remover o construct
php artisan make:controller Admin\ProdutoController --resource
*Demonstrar como ficou o controller gerado com o método resource, explicar cada método
*Demonstrar como criar uma rota para o controller do tipo resource
Route::resource('/admin/produtos', 'Admin\ProdutoController');
*Se acessar essa rota ele não vai dar erro, mas não vai mostrar nada pois o metodo index que ele está chamando não retorna nada
*Para ver a lista de rotas que ele criou usar o comando:
php artisan route:list
*Para mostrar que a rota funcionou adicionar um retorno no metodo index
*Falar como o laravel é incrivel e como funciona o DI - Dependency Injection ,
*Quando em um método vc identifica que vai utilizar um obejto, o Laravel consegue automaticamente atribuir o uso desse objeto dentro do mmetodo
*Dentro do método vc já vai conseguir utilizar todos aqueles metodos do objeto
*Conforme formos evoluindo vc vai conseugir entender melhor

----VIEWS------
*Falar que devemos sempre tentar utilizar a view para tentar mostrar os dados para o usuário
*Devemos alterar o controller para chamar o helper view(), que vai receber como parametro a view que ele vai receber.
*Por padrão todos os arquivos de view devem seguir o padrão de nome_do_arquivo.blade.php
*Mostrar onde devem ficar as views
*Criar um arquivo teste.blade.php
*Criar um HTML Padrão, e mostrar como chama ela no controller.
return view('teste');
*Demonstrar que funcionou.
*Demonstrar como enviar parametros para minha view
$teste = 123;
return view('teste', ['teste'=>$teste]);
Mostrar como imprimir o valor
Mostrar como passar varias variavies usando o compact()
Demonstrar na view como imprimiria essas variaveis.
Mostrar como estruturar as pastas dentro da view.
Criar uma pasta site e uma pasta admin
Mover o arquivo teste para dentro da pasta site, e mostrar que gerou um erro, pois a view não foi encontroada.
Mostrar como corrigir a chamada da view
Mostrar como ficaria criando mais um diretório dentro do site, mover o arquivo para dentro, e mostrar como fica a chamada

_____BLADE______
Primeira coisa vamos demonstrar como criar template
dentro da pasta site, vamos criar uma pasta chamada template
criar o arquivo template.blade.php
Adicionar um HTML Padrão, e dentro do de  onde de ser carregado o seus conteudos adicionar a tag blade
@yield('content')
Criar uma pasta home
Criar um arquivo index.blade.php
Alterar metodo index para chamar essa view
Adicionar dentor do arquivo um include para o arquivo do template
@extendes('site.template.template')

e para definir o conteudo que vai estar na parte dinamica do template utilizar o codigo:
@section('content')

@endsection
Demonstrar exemplos

Alterar metodo contato para chamar view contato
Criar a view contato, que vai chamar o mesmo template

*Mostrar algumas tags do blade
como imprimir os parametros = {{  }}
Se não passar a variavel, como tratar
{{ $var1 or '' }}
Mostrar isso alterando o title do site.
Mostrar alterando o index, para passar o valor dessa variavel title
Criar uma variavel $xss='<script>alert('teste');</script>
se você tentar imprimir, vc vai verificar que ele imprimiu o código.
Demonstrar como imprimir essa variavel, {!!  !!}

Mostrar if
Fazer um teste passando uma variavel como parametro
Mostrar o else

Mostrar o @unless que faz uma verificação se é falso, ao contrario do if

Mostrar o For
@for ( $i=0; $i < 10; $i++ )
@endfor

@foreach($arrayData as $array)
@endforeach

;Mostrar como seria se o arrayData viesse vazio, e como usar o foreach
;Mostrar primeiro como fazer com o if
@forelse($arrayData as $array)
@empty
@endforelse

Comentario {{--
  --}}

  @php
  @endphp

  @include arquivo php como por exemplo um sidebar.
  Mostrar criando uma view dentro de includes e adicionando ela em outra view
  @include('site.includes.sidebar')
  Mostrar como passar parametros para esse include
  @include('site.includes.sidebar', compact('var1'));

  @stacks - Para colocar CSS ou JS especifico por pagina.
  Explicar porque não carregar todos no template.
  @stack('scripts') no template.blade.php onde ficam os scripts
  *Onde vai inserir os script
  @push('scripts')
    //colar script aqui
  @endpush

  ____MIGRATIONS______
  Explicar que vamos começar a trabalhar com o banco, que é a parte do models....
  Criar o banco na collection utf8mb4-unicode_ci
  Migrations seria um git para gerenciar as tabelas
  Vamos trabalhar com esse conceito agora
  É uma classe, deve ter um nome explicativo com a ação.
  Tem 2 métodos um Up e um down
  Como criar uma nova Migration
  mostrar o comando no artisan
  php artisan make:migration create_products_table
  Cuidar sempre a ordem que está criando as migration, por causa de relacionamentos
  Criar campos
  id
  string->name,150
  integer->number
  boolean->active
  string->image,200
  enum->category ['cat1',cate2]
  text->description

  A partir da versão 5.5 qdo passou-se a utlizar o mb4 no collection do banco, o que permite a inserção de emoticons, no banco, os campos unique tem no maximo o tamanho de 192.
  Ou seja ao criar a tabela usuario vai dar erro.
  Para resolver isso, podemos definir o tamanho maximo no campo, ou então adicionar esse codigo no arquivo aa\providers\AppServiceProvider:
  <?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

Para alterar uma tabela como é desenv, podemos ir no arquivo e alterar o campo, depois rodar o comando
php artisan migrate:refresh

Depois qdo começarmos a ver mais sobre eloquente, vamos ver a forma correta de fazer essa alteração, para guardarmos a versão anterior do banco.

Outro recurso bem interessante, é a parte de seed, onde vc consegue deixar pré-definida a inserção de dados.
Explicar que poderia adiconar dentro do metodo run do seed.
PHP artisan make:seeder UserTableSeeder
rodar o comando:
App\User::create([
    'name' => 'Diego Vissini',
    'email' => 'diego@vissini.com.br'
    'password' => bcrypt('123456'),
]);
Depois descomentar a chamada no arquivo database seeder
php artisan db:seed
Verificar no banco que deu tudo certo.



  php artisan migrate


  -----------------Formularios---------------
  Arrumar a rota do botão cadastrar
  poderia fazer {{ url('/admin/product/create) }} no href
  Outra forma é:
  {{  rounte('products.create') }}

  Alterar o metodo create para chamar a view do formulario create
  Criar a view nas pastas corretas
  Mostrar que funcionou
  Usar a template do lista
  Testar que o template está correto,
  PAssar a variavel title
  Criar o formulário para os campos do banco [name, ativo, category, descricao]
  Criar o dropdown de forma manual no primeiro momento....
  Depois demonstrar que podiamos pegar do controller fazendo um foreach
  Fazer o formulario que chama o create sem o token
  Demonstrar que gera o ERRo TokenMismatchException
  Para criar o token
  <input type="text" name="_token" value="{{ crsf_token() }}"/>
  Verificar o token que foi gerado
  Mostrar forma simplificada de gerar
  {!! crsf_field() !!}

  ___________REQUESTS___________
  Preencher Formulário de dar um cadastrar, 
  dd($request->all());
  suponde que quisesse pegar apenas alguns campos
  $request->only(['name']);
  $request->except(['name']);
  $request->input('name');
  $request->input('name', 'valor_default');

  no controller metodo store
  $dataForm = $request->all();
  $insert = $this->product->insert($dataForm);
  if( $insert ){
      return redirect()->route('products.index');
  }else{
      //return redirect()->back();
      return redirect()->route('products.create');
  }
Mostrar que vai gerar um erro pq ta tentando inserir o campo token.
PAra resolver podemos usar o request except ou então mudar o insert para CREATE
Mostrar que da um erro se o ativo estiver vazio.
Para resolver:
$dataForm['ative'] = isset($dataForm['ative'])?1:0;

____VALIDAR DADOS____________
Mostrar a importancia de validar os dados
Mostrar o erro
Existem diversas maneiras de validar os dados....vou mostrar a mais simples;
Validar antes do create
As regras de validação devem ficar na model, ou o laravel permite criar um objeto do tipo request para essa validação.
No model:
criar atributo 
public $rules = [
    'name' => 'required|min:3|max:100',
    'number' => 'required|numeric',
    'category' => 'required',
    'description' => 'min:3|max:1000',
];

No controller:
$this->validate($request, $this->product->rules);
Fazer teste....mostrar que não enviou, mas não mostrou a mensagem de erro
Como mostrar o erro:
@if( isset ($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach( $errors->all() as $error )
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

Como resolver a parte de perder os valores do formulário qdo dá erro
value="{{ old('name') }}"

Demonstrar que podemos passar um terceiro parametro no validate que seriam as mensagens de erro
--------------------------------------------
Outra maneira de validar de forma manual
$validate = validator::make($dataForm, $this->product->rules);
$validate = Validator($dataForm, $this->product->rules);
Só isso não garante que valida.
devemos fazer:
if( $validate->fails() ){
    return redirect()->route('products->create')->withErrors($validate)->withInput();
}

Mostrar o array messages
exemplo: [
    'name.required' => 'O Campo nome é obrigatório',
]

Particularmente utilizo pouco essa parte de mensagens, pois costumo usar a parte de translate

Pode verificar regras de ACL na classe formRequest.
Comando para criar o request
php artisan make:request ProductFormRequest
Dizer que poderia ser por exemplo ProductCreateRequest, ou até mesmo que podemos colocar dentro de uma pasta para organizar mais o código, que é o que vamos fazer Admin\ProductFormRequest

2 metodos
autorize, onde a poderiamos definir se a pessoa tem ou não permissão para fazer essa ação....muito usado no ACL
Copiar para dentro de rules o array das regras
return [
    regras
];

se quiser podemos adicionar um novo metodo para mensagens
public function messages()
{
    return [
        messages
    ]
}

Dentro do controller temos que dar um Use nesse formRequest
Depois alterar o parametro de entrada para ser um objeto de formRequest

// *Mostrar como melhorar os itens da listagem
// Mostrar usando bootstrap
// Criar o template
// Criar uma pasta dentro de public\assets\admin\ [js, css, img]
// para chamar o arquivo podemos usar {{ url('assets/admin/css/admin.css') }} ou utilizar public_path

// Arrumar a rota do botão cadastrar na listagem
  poderia fazer {{ url('/admin/product/create') }} no href
  Outra forma é:
  {{  route('products.create') }}

//   Alterar o metodo create para chamar a view do formulario create
//   Criar a view nas pastas corretas
//   Mostrar que funcionou
//   Usar a template do lista
//   Testar que o template está correto,
//   PAssar a variavel title
//   Criar o formulário para os campos do banco [name, ativo, category, descricao]
//   Criar o dropdown de forma manual no primeiro momento....
//   Depois demonstrar que podiamos pegar do controller fazendo um foreach
//   Fazer o formulario que chama o create sem o token
//   Demonstrar que gera o ERRo TokenMismatchException
//   Para criar o token
//   <input type="text" name="_token" value="{{ crsf_token() }}"/>
//   Verificar o token que foi gerado
//   Mostrar forma simplificada de gerar
//   {!! crsf_field() !!}

  ___________REQUESTS___________
  //Preencher Formulário de dar um cadastrar, 
  dd($request->all());
//   suponde que quisesse pegar apenas alguns campos
  $request->only(['name']);
  $request->except(['name']);
  $request->input('name');
  $request->input('name', 'valor_default');

//   no controller metodo store
  $dataForm = $request->all();
  $insert = $this->product->insert($dataForm);
  if( $insert ){
      return redirect()->route('products.index');
  }else{
      //return redirect()->back();
      return redirect()->route('products.create');
  }
// Mostrar que vai gerar um erro pq ta tentando inserir o campo token.
// PAra resolver podemos usar o request except ou então mudar o insert para CREATE
// Mostrar que da um erro se o ativo estiver vazio.
Para resolver:
$dataForm['ative'] = isset($dataForm['ative'])?1:0;

____VALIDAR DADOS____________
// Mostrar a importancia de validar os dados
// Mostrar o erro
// Existem diversas maneiras de validar os dados....vou mostrar a mais simples;
// Validar antes do create
// As regras de validação devem ficar na model, ou o laravel permite criar um objeto do tipo request para essa validação.
No model:
criar atributo 
public $rules = [
    'name' => 'required|min:3|max:100',
    'number' => 'required|numeric',
    'category' => 'required',
    'description' => 'min:3|max:1000',
];

No controller:
$this->validate($request, $this->product->rules);

// Fazer teste....mostrar que não enviou, mas não mostrou a mensagem de erro
Como mostrar o erro:
@if( isset ($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach( $errors->all() as $error )
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

// Como resolver a parte de perder os valores do formulário qdo dá erro
value="{{ old('name') }}"

// Demonstrar que podemos passar um terceiro parametro no validate que seriam as mensagens de erro
--------------------------------------------
// Outra maneira de validar de forma manual
$validate = validator::make($dataForm, $this->product->rules);
$validate = Validator($dataForm, $this->product->rules);
Só isso não garante que valida.
devemos fazer:
if( $validate->fails() ){
    return redirect()->route('products->create')->withErrors($validate)->withInput();
}

Mostrar o array messages
exemplo: [
    'name.required' => 'O Campo nome é obrigatório',
]

// Particularmente utilizo pouco essa parte de mensagens, pois costumo usar a parte de translate

// Pode verificar regras de ACL na classe formRequest.
// Comando para criar o request
php artisan make:request ProductFormRequest
Dizer que poderia ser por exemplo ProductCreateRequest, ou até mesmo que podemos colocar dentro de uma pasta para organizar mais o código, que é o que vamos fazer Admin\ProductFormRequest

// 2 metodos
// autorize, onde a poderiamos definir se a pessoa tem ou não permissão para fazer essa ação....muito usado no ACL
// Copiar para dentro de rules o array das regras
return [
    regras
];

// se quiser podemos adicionar um novo metodo para mensagens
public function messages()
{
    return [
        messages
    ]
}

// Dentro do controller temos que dar um Use nesse formRequest
// Depois alterar o parametro de entrada para ser um objeto de formRequest

Editar
Primeiro passo é alterar o link no listar
Mostrar com url
{{ url('/admin/products/id/edit') }}
Depois mostrar com route
{{ route('products.edit', $id) }}

primeiro passo recuperar o produto
$prod = $this->product->find($id);
dd($prod) para mostrar os dados desse produto
Chamar a view passando o produto por parametro
Mas antes vamos organizar as views, para que o create e o edit usem o mesmo form
CREATE
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Adicionar Serviços</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              @include('admin._errors')
              <form role="form" method="POST" action="{{ route('services.store') }}">
                @include('admin.services._form')
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Criar Serviço</button>
                  <a href="{{ route('services.index') }}" class="btn btn-default">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->
  
  
          </div>
    </div>

@stop

EDIT
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Editar Depoimentos</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              @include('admin._errors')
              <form role="form" method="POST" action="{{ route('testimonials.update', ['testimonial'=>$testimonial->id]) }}" enctype="multipart/form-data">
                {{method_field('PUT')}}
                @include('admin.testimonials._form')
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Editar Depoimento</button>
                  <a href="{{ route('testimonials.index') }}" class="btn btn-default">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->
  
  
          </div>
    </div>

@stop

FORM
<div class="box-body">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name='name' id="name" placeholder="Nome" value="{{ old('name',$testimonial->name) }}" required>
        </div>
        <div class="form-group">
          <label for="position">Cargo</label>
          <input type="text" class="form-control" name='position' id="position" placeholder="Insira o Cargo" value="{{ old('position',$testimonial->position) }}">
        </div>
        <div class="form-group">
          <label for="testimony">Depoimento</label>
          <textarea class="form-control" name='testimony' id="testimony" placeholder="Insira o Depoimento" required>{{ old('testimony',$testimonial->testimony) }}</textarea>
        </div>
        <div class="form-group">
          <label for="photo">Foto</label>
          <input type="file" class="form-control" name='photo' id="photo" placeholder="Insira a Foto" value="">
        </div>
        @if ($testimonial->photo)
            <img src="{{$testimonial->photo}}" alt="{{$testimonial->name}}" width="200px">
        @endif
    </div>
    <!-- /.box-body -->

    // MOSTRAR que o Update não recebe o metodo POST e sim o PUT
    // Mostrar novamente que o cadastrar continua funcionando
    // Depois ir no editar para esse mesmo cara
    
    // primeiro passo recuperar o id a ser editado com find
    
    $dataForm = $request->all();
    $dataForm['ative'] = isset($dataForm['ative'])?1:0;

    $product = $this->product->find($id);

    $update = $product->update($dataForm);
    if( $insert ){
        return redirect()->route('products.index')->with('success'=>'Produto alterado com sucesso!');
    }else{
        //return redirect()->back();
        return redirect()->route('products.edit')->with('errors'=>'Erro ao editar registro');
    }

Dizer que não está validando e mudar para validar
Lembrar que tem que alterar onde mostrar os erros, para mostrar a mensagem de sucesso tb.
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <ul class="alert alert-danger padding-lg">
        @foreach ($errors->all() as $error)
            <li class=''>{{$error}}</li>
        @endforeach
    </ul>
@endif


DELETE
Primeiro vamos mostrar o delete pela tela de vizualizar
Vamos criar um botão novo na listagem de vizualizar e chamar sua rota
Depois montar um HTML usando o template que mostre os dados desse produto
Nessa tela ter um botão cancelar que volta para a listagem e ter um delete
Dizer que o link não daria certo pois seria por post e não pelo verbo DELETE
Criar um form apontando para o link destroy e com o method delete

Mostrar o deletar na propria listagem:
<a class='btn btn-danger' href=" {{ route('testimonials.destroy', ['testimonial'=>$testimonial->id]) }} " 
                                    onclick="event.preventDefault(); if(confirm('Deseja apagar o Depoimento')){document.getElementById('form-testimonial-delete').submit();}"
                                >Deletar</a>
                                <form id="form-testimonial-delete" style="display:none" action="{{ route('testimonials.destroy', ['testimonial'=>$testimonial->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>


PAGINACAO
explicar importancia
Mostrar paginacao
criar um atributo no construct para definir o numero de itens por pagina
private $totalPage = 3;
no metodo index
mudar o ->find() por:
paginate($this->totalPage);
Mostrar que se atualizar a pagina vai vir apenas esse numero de itens
Mostrar como adicionar os links da paginação
{!! $products->links() !!}

Mostrar depois o findorfail
findOrFail() onde se não encontrar dá um 404

Depois mostrar que poderiamos usar o objeto no parametro que já faz isso de forma automatica

Mostrar que poderiamos criar uma arquivo e usar como include para mostrar os erros


Se sobrar tempo mostrar a parte de autenticar admin usando o adminlte
https://github.com/jeroennoten/Laravel-AdminLTE