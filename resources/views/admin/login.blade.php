<!doctype html>
<html lang="en">
<head>
    <title>Login Admin - Buku Tamu BKPSDM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/form/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="d-flex justify-content-center align-items-center bg-light">
    <!-- Toast Success Notification -->
    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        @if(session('success'))
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
        @if($errors->any())
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


    <div class="overlay"></div> <!-- Layer hitam -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h3>Admin Buku Tamu BKPSDM</h3>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg text-center"></p>

                        <!-- Tampilkan alert jika ada error -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form login -->
                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username_admin" class="form-label">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Username" id="username_admin" name="username_admin" required>
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text p-0">
                                        <img src="{!! captcha_src('flat') !!}" id="captcha-img" alt="captcha" class="captcha-img">
                                    </span>
                                    <button type="button" class="btn btn-outline-secondary refresh-btn" id="refresh-captcha">
                                        <i class="fa fa-refresh" style="font-size: 24px;"></i>
                                    </button>
                                </div>

                                <div class="input-group mt-2">
                                    <input type="text" class="form-control" placeholder="Enter Captcha" id="captcha" name="captcha" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8"></div>
                                <div class="col-4 d-grid">
                                    <button type="submit" class="btn btn-primary" style="padding: 15px 30px; font-size: 18px;">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                const errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                errorToast.show();
            @elseif(session('success'))
                const successToast = new bootstrap.Toast(document.getElementById('successToast'));
                successToast.show();
            @endif
        });
        </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        document.getElementById('refresh-captcha').addEventListener('click', function () {
            var captcha = document.querySelector('.input-group-text img');
            captcha.src = '/captcha/flat?' + Math.random();
        });
    </script>

<script>
    function hideToast(toast) {
        toast.classList.add('hide-toast');

        setTimeout(() => {
            toast.style.display = 'none';
        }, 500);
    }

    document.querySelectorAll('.toast').forEach(toast => {
        setTimeout(() => {
            hideToast(toast);
        }, 3000);

        const closeButton = toast.querySelector('.close, .btn-close');
        if (closeButton) {
            closeButton.addEventListener('click', () => hideToast(toast));
        }
    });
</script>

</body>
</html>
