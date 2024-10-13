<!doctype html>
<html lang="en">
  <head>
  	<title>Buku Tamu BKPSDM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('/form/css/style.css')}}">


    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <script>
        // Script untuk menyembunyikan alert setelah 3 detik (3000 milidetik)
        setTimeout(function() {
            var alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.remove('show'); // Menghapus kelas 'show' agar alert disembunyikan
            }
        }, 3000); // 3000 milidetik = 3 detik
    </script>


	</head>
	<body>
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
						<div class="img" style="background-image: url({{url('form/images/bkpsdm.jpg')}});">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
			      	</div>

					  <form action="/buku-tamu/cek-nik" method="POST" class="signin-form">
							@csrf
							<div class="form-group mb-3">
								<label class="label" for="nik">ID/NIK</label>
								<input type="text" name="nik" class="form-control" placeholder="Silahkan masukkan ID/NIK" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3">Next</button>
							</div>
						</form>

					<div style="height: 100px;"></div> <!-- Ruang tambahan -->
		      </div>
				</div>
			</div>
		</div>
	</section>


	<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentHour = new Date().getHours();
        if (currentHour < 7 || currentHour > 14) {
            alert('Akses hanya tersedia antara jam 07:00 hingga 14:00.');
            window.location.href = '/'; // Arahkan ke halaman lain atau tampilkan pesan
        }
    });
	</script> -->



  <script src="{{asset('form/js/jquery.min.js')}}"></script>
  <script src="{{asset('form/js/popper.js')}}"></script>
  <script src="{{asset('form/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('form/js/main.js')}}"></script>

	</body>
</html>

