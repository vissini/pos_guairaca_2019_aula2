@extends('admin.template.template')
@section('content')
    <a class="btn btn-primary" href="{{ route('products.create') }}">Adicionar Produto</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>number</th>
                <th>Ativo</th>
                <th>Categoria</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    @forelse ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->number }}</td>
            <td>{{ $product->active }}</td>
            <td>{{ $product->category }}</td>
            <td style="width: 180px;">
                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Editar</a>
                <a class='btn btn-danger' href=" {{ route('products.destroy', $product->id) }} " 
                    onclick="event.preventDefault(); if(confirm('Deseja apagar o Produto')){
                        document.getElementById('form-product-delete{{ $product->id }}').submit();}"
                >Deletar</a>
                <form id="form-product-delete{{ $product->id }}" style="display:none" action="{{ route('products.destroy', $product->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </td>
            
    @empty
        <p>Nenhum registro encontrado!</p>
    @endforelse    
        </tbody>
    </table>
@endsection
