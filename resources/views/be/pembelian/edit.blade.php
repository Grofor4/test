@extends('be.layouts.content')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fas fa-edit"></i> Edit Pembelian</h2>
    <div class="card shadow border-0">
        <div class="card-body">
            @if(!$pembelian)
                <div class="alert alert-danger">Data pembelian tidak ditemukan.</div>
            @else
            <form method="POST" action="{{ url('/pembelian/'.$pembelian->id) }}">
                @csrf
                @method('POST')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>No Nota</label>
                        <input type="text" name="nonota" class="form-control" value="{{ $pembelian->nonota }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal Pembelian</label>
                        <input type="date" name="tgl_pembelian" class="form-control" value="{{ $pembelian->tgl_pembelian instanceof \Carbon\Carbon ? $pembelian->tgl_pembelian->format('Y-m-d') : $pembelian->tgl_pembelian }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>Distributor</label>
                        <select name="id_distributor" class="form-control" required>
                            @foreach($distributor as $dist)
                                <option value="{{ $dist->id }}" @if($pembelian->id_distributor == $dist->id) selected @endif>
                                    {{ $dist->nama_distributor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Harga Beli</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembelian->detailPembelian as $loopIdx => $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nama_obat }}</td>
                                <td>{{ $d->jumlah_beli }}</td>
                                <td>Rp {{ number_format($d->harga_beli,0,',','.') }}</td>
                                <td>Rp {{ number_format($d->subtotal,0,',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total</th>
                                <th>Rp {{ number_format($pembelian->total_bayar,0,',','.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    <form method="POST" action="{{ url('/pembelian/'.$pembelian->id) }}" onsubmit="return confirm('Yakin hapus pembelian ini?')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus Pembelian</button>
                    </form>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
