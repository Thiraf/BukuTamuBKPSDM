@extends('layouts.app')

<!doctype html>
<html lang="en">
  <head>
  	<title>Buku Tamu BKPSDM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('/form/css/style.css')}}">

	</head>

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 600px;">
        <!-- Tambahkan card untuk membuat kotak -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="text-center mb-4">Data Pegawai</h3>
                <!-- Form untuk menampilkan data pekerja -->
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nik }}" readonly>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label>Bidang</label>
                    <input type="text" class="form-control" value="{{ $pegawai->bidang['nama_bidang'] }}" readonly>
                </div>
                <div class="form-group">
                    <label>Layanan</label>
                    <input type="text" class="form-control" value="{{ $pegawai->layanan['nama_layanan']}}" readonly>
                    {{-- <input type="text" class="form-control" value="{{ $pegawai->layanan }}" readonly> --}}
                </div>
                <div class="form-group">
                    <label>Tempat Tanggal Lahir</label>
                    <input type="text" class="form-control" value="{{ $pegawai->tempat_tanggal_lahir }}" readonly>
                </div>
                <div class="form-group">
                    <label>No Hp</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nomor_hp }}" readonly>
                </div>
                <!-- Tombol untuk melanjutkan -->
                <form action="/buku-tamu/tujuan-informasi" method="POST">
                    @csrf
                    <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

