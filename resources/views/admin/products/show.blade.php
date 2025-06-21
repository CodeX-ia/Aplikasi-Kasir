@extends('components.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Detail Produk</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="card-text"><strong>Stok:</strong> {{ $product->stock }}</p>
{{--                <p class="card-text"><strong>Dibuat pada:</strong> {{ $product->created_at->format('d-m-Y H:i') }}</p>--}}

                <a href="{{ route('product.update', $product->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
