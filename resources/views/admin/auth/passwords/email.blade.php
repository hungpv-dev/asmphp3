<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss'])
    <title>{{$title}}</title>
</head>
<body>
@include('sweetalert::alert')
<div class="container">
    <div class="content col-9 col-md-6 col-lg-5 col-xl-4 rounded mt-5 m-auto border p-3">
        <a href="{{route('admin.login')}}" class="btn btn-outline-dark py-0">< Đăng nhập</a>
        <h1 class="alert fs-5 text-center">Quên mật khẩu</h1>
        <form action="{{route('admin.forget')}}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" name="email"  oninput="validate(this,'.error-email')" value="{{old('login')}}" class="form-control">
                @error('email')
                <p class="text-danger fs-8 fw-bold old-error-email">{{$message}}</p>
                @enderror
                <p class="text-danger fs-8 fw-bold error-email"></p>
            </div>
            <div class="form-group mb-3 d-flex flex-column-reverse">
                <button class="btn btn-outline-primary">Gửi mail</button>
            </div>
        </form>
    </div>
</div>
@vite(['resources/js/app.js'])
    <script>
        function validate(html, text) {
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(html.value)) {
                document.querySelector('.old-error-email').innerText = '';
                document.querySelector(text).innerText = 'Email không hợp lệ';
            } else {
                document.querySelector(text).innerText = '';
            }
        }
    </script>
</body>
</html>
