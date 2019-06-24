<h1>Products</h1>
@forelse ($products as $product)
    <p>{{ $product->name }} - {{ $product->number }}</p>
@empty
    <p>Nenhum registro encontrado!</p>
@endforelse