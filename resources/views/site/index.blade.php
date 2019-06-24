@extends('site.template.template')
@push('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endpush
@section('content')
    <h1>Index</h1>
    {{ $var1 or 'Nulo' }}<br>
    {{ $xss }}
    <br>

    @if($var2 > 2)
        Maior que 2
    @else
        Menor ou igual a 2
    @endif
    <br>
    @unless($var2 > 2)
      Menor = 2
    @endunless

    <br>
    {{-- Comentario --}}
    @for ( $i=0; $i < 10; $i++ )
        i={{ $i }}<br>
    @endfor

    @include('site.includes.sidebar', compact('var1'))

    @forelse ($arrayData as $item)
        j = {{ $item }}<br>
    @empty
        <p>Sem registros</p>
    @endforelse
    @php

    @endphp









@endsection
