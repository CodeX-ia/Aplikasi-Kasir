@extends('components.app')

@section('title', 'Tambah Produk Baru')

@section('content')

    <div class="container">
        <h3>Tambah Produk</h3>
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
