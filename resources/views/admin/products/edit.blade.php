@extends('admin.template.template')
@section('content')
<form action="{{ route('products.update', $prod->id) }}" method="post">
        {{method_field('PUT')}}
        @include('admin.products._form')
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Alterar Produto</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
</form>
@endsection