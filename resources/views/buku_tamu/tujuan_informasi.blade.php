<!doctype html>
<html lang="en">
  <head>
    <title>Buku Tamu BKPSDM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/form/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/tujuan_informasi.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript">
        (function () {
            window.history.forward();
        })();

        window.onunload = function () {
            null;
        };
    </script>
 </head>

    <body>
        @extends('layouts.app')

    @section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container" style="max-width: 600px;">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="text-center">Tujuan Informasi</h1>
                    <form action="{{ route('buku-tamu.update', $bukuTamu->id_buku_tamu) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_buku_tamu" value="{{ $bukuTamu->id_buku_tamu }}">

                        <div class="form-group">
                            <select name="id_layanan" id="id_layanan" class="form-control select2" required>
                                <option value="" disabled>Pilih Layanan</option>
                                @foreach($layanans as $layanan)
                                    <option value="{{ $layanan->id_layanan }}"
                                        {{ $layanan->id_layanan == $bukuTamu->id_layanan ? 'selected' : '' }}>
                                        {{ $layanan->nama_layanan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#id_layanan').select2({
                                    placeholder: "Pilih Layanan",
                                    allowClear: true,
                                    width: '100%' // Dropdown mengikuti lebar elemen induk
                                });
                            });

                        </script>


                        <!-- Input untuk tujuan informasi dengan textarea -->
                        <div class="form-group">
                            <label for="tujuan_informasi">Kendala/Informasi yang dibutuhkan</label>
                            <textarea name="tujuan_informasi" class="form-control" rows="5" required>{{ $bukuTamu->tujuan_informasi }}</textarea>
                        </div>

                        <!-- Tombol untuk submit form -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn" data-bs-dismiss="alert" aria-label="Close">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

  </body>
</html>
