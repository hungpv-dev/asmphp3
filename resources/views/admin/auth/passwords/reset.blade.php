<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss'])
    <title>Mật khẩu mới</title>
</head>
<body>
@include('sweetalert::alert')
<div class="container">
    <div class="content col-9 col-md-6 col-lg-5 col-xl-4 rounded mt-5 m-auto border p-3">
        <h1 class="alert fs-5 text-center">Đặt lại mật khẩu</h1>
        <form action="{{route('admin.reset')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" name="email" value="{{$email}}" readonly class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Mật khẩu mới</label>
                <input type="text" name="pass" value="{{old('pass')}}" id="pass" onblur="validate(this,'.error-pass','Mật khẩu từ 8-20 kí tự!')" class="form-control">
                @error('email')
                <p class="text-danger fs-8 fw-bold old-error-pass">{{$message}}</p>
                @enderror
                <p class="text-danger fs-8 fw-bold error-pass"></p>
            </div>
            <input type="hidden" name="check_token" value="{{$token}}">
            <div class="form-group mb-3">
                <label for="" class="form-label">Xác nhận mật khẩu</label>
                <input type="text" name="repass" value="{{old('repass')}}" onblur="validate(this,'.error-repass','Mật khẩu không khớp!')" class="form-control">
                @error('email')
                <p class="text-danger fs-8 fw-bold old-error-repass">{{$message}}</p>
                @enderror
                <p class="text-danger fs-8 fw-bold error-repass"></p>
            </div>
            <div class="form-group mb-3 d-flex flex-column-reverse">
                <button class="btn btn-outline-primary">Thay đổi</button>
            </div>
        </form>
    </div>
</div>
@vite(['resources/js/app.js'])
    <script>
        function validate(html, text, message) {
            ip = html.value;
            if (ip.length < 8 || ip.length > 20) {
                document.querySelector(text).innerText = message;
            } else {
                document.querySelector(text).innerText = '';
            }

            if(text == '.error-repass'){
                let pass = document.querySelector("#pass").value;
                if(ip === pass){
                    document.querySelector(text).innerText = '';
                }else{
                    document.querySelector(text).innerText = message;
                }
            }
        }
    </script>
</body>
</html>
