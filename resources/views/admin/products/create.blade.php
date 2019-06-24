@extends('admin.template.template')
@section('content')
<form action="{{ route('products.store') }}" method="post">
        @include('admin.products._form')
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Criar Produto</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
</form>
@endsection