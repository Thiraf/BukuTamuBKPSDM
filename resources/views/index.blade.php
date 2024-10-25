<!doctype html>
<html lang="en">
<head>
    <title>Buku Tamu BKPSDM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts and Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="{{asset('/form/css/style.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body>

<!-- Toast Success Notification -->
<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    @if(session('success'))  <!-- Kondisi: Tampilkan hanya jika ada session success -->
    <div class="toast show" id="successToast" data-delay="5000" style="min-width: 300px; padding: 20px; background-color: #28a745; color: white; font-size: 1.2rem; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 10px;">
        <div class="toast-header" style="background-color: transparent; border-bottom: none; color: white;">
            <i class="fa fa-check-circle" style="font-size: 1.5rem; margin-right: 10px;"></i>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
    @endif
</div>

<!-- Toast Error Notification -->
<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 100px; right: 20px; z-index: 9999;">
    @if($errors->any())  <!-- Kondisi: Tampilkan hanya jika ada error -->
    <div class="toast show" id="errorToast" data-delay="5000" style="min-width: 300px; padding: 15px; background-color: rgba(255, 0, 0, 0.8); color: white; font-size: 1.2rem; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <div class="toast-header" style="background-color: transparent; border-bottom: none;">
            <strong class="mr-auto" style="color: white;">Peringatan</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ $errors->first() }}
        </div>
    </div>
    @endif
</div>



<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Buku Tamu BKPSDM</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <!-- Image Section -->
                    <div class="img" style="background-image: url({{url('form/images/bkpsdm.jpg')}});"></div>

                    <!-- Form Section -->
                    <div class="login-wrap p-4 p-md-5">
                        <h3 class="mb-4"></h3>
                        <form action="/buku-tamu/cek-nik" method="POST" class="signin-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="nik">ID/NIK</label>
                                <input type="text" name="nik" class="form-control" placeholder="Silahkan masukkan ID/NIK" required>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text p-0">
                                        <img src="{!! captcha_src('default') !!}" id="captcha-img" alt="captcha" class="captcha-img">
                                    </span>
                                    <button type="button" class="btn btn-outline-secondary refresh-btn" id="refresh-captcha">
                                        <i class="fa fa-refresh" style="font-size: 24px;"></i>
                                    </button>
                                </div>
                                <div class="input-group mt-2">
                                    <input type="text" class="form-control" placeholder="Enter Captcha" id="captcha" name="captcha" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Next</button>
                            </div>
                        </form>

                        <div style="height: 15px;"></div> <!-- Extra space -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Toast Display Script -->
<!-- Toast Display Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Toast untuk Error
        @if ($errors->any())
            $('#errorToast').toast({
                autohide: true,   // Aktifkan auto-hide
                delay: 5000       // Waktu tampil (5 detik)
            }).toast('show');
        @endif

        // Inisialisasi Toast untuk Success
        @if (session('success'))
            $('#successToast').toast({
                autohide: true,   // Aktifkan auto-hide
                delay: 5000       // Waktu tampil (5 detik)
            }).toast('show');
        @endif

        // Tutup toast secara manual jika tombol "x" ditekan
        $('.toast .close').on('click', function () {
            $(this).closest('.toast').toast('hide');
        });
    });
</script>

{{-- <!-- Accessibility Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentHour = new Date().getHours();
        if (currentHour < 7 || currentHour > 14) {
            alert('Akses hanya tersedia antara jam 07:00 hingga 14:00.');
            window.location.href = '/'; // Arahkan ke halaman lain atau tampilkan pesan
        }
    });
</script> --}}

<!-- External Scripts -->
<script src="{{asset('form/js/jquery.min.js')}}"></script>
<script src="{{asset('form/js/popper.js')}}"></script>
<script src="{{asset('form/js/bootstrap.min.js')}}"></script>
<script src="{{asset('form/js/main.js')}}"></script>

<!-- Refresh Captcha Script -->
<script type="text/javascript">
    document.getElementById('refresh-captcha').addEventListener('click', function () {
        var captcha = document.querySelector('.input-group-text img'); // Mengambil elemen gambar captcha
        captcha.src = '/captcha/default?' + Math.random(); // Menambah parameter acak agar captcha dimuat ulang
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if ($errors->any())
        $('#errorToast').toast('show');
    @else
        $('#successToast').toast('show');
    @endif
});

</script>


</body>
</html>
