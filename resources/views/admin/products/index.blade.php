@extends('components.app')

@section('title', 'Data Produk')


@section('content')

    <div class="card-body">
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-2">Tambah Produk</a>
        <h1 class="text-lg-center">DATA PRODUK</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <a href="{{ route('product.update', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
