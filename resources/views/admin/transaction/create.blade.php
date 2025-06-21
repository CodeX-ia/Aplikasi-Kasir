@extends('components.app')

@section('title', 'Buat Transaksi Baru')

@section('content')
    <div class="container">
        <h1 class="mb-4">Buat Transaksi Baru</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="products">Pilih Produk</label>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($product as $product)
                        <tr>
                            <td><input type="checkbox" name="products[]" value="{{ $product->id }}"></td>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <input type="number" name="quantities[{{ $product->id }}]" class="form-control" min="1" max="{{ $product->stock }}">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
