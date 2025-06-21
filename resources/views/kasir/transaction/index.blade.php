@extends('components.app')
@section('title', 'Daftar Transaksi')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Transaksi</h1>

        <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-3">+ Transaksi Baru</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total</th>
{{--                <th>Tanggal</th>--}}
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transaction as $trx)
                <tr>
                    <td>{{ $trx->id }}</td>
                    <td>{{ $trx->user->name ?? 'User #' . $trx->user_id }}</td>
                    <td>Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
{{--                    <td>{{ $trx->created_at->format('d M Y H:i') }}</td>--}}
                    <td>
                        <a href="{{ route('transaction.show', $trx->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <form action="{{ route('transaction.destroy', $trx->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus transaksi ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
