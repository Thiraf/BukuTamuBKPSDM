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
    <link rel="stylesheet" href="{{asset('css/data_pekerja.css')}}">

	</head>

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 600px;">
        <!-- Tambahkan card untuk membuat kotak -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="text-center mb-4">Data Pegawai</h3>
                <!-- Tombol untuk melanjutkan -->
                <form action="/buku-tamu/simpan-pegawai" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text"  name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Bidang</label>
                        <input type="text"  name="jabatan_pegawai" value="{{ $pegawai->bidang['nama_bidang'] }}"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Unit Kerja</label>
                        <input type="text"  name="unit_kerja_pegawai" value="{{ $pegawai->unit_kerja_pegawai}}"  class="form-control" required>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

