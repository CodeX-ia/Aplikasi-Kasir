@extends('components.app')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detail Transaksi</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>ID Transaksi:</strong> {{ $transaction->id }}</p>
{{--                <p><strong>Tanggal:</strong> {{ $transaction->date->format('d-m-Y H:i') }}</p>--}}
                <p><strong>Kasir:</strong> {{ $transaction->user->name }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            </div>
        </div>

        <h4>Daftar Produk</h4>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transaction->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ route('transaction.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
