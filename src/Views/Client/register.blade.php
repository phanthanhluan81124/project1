@extends('layouts.master')

@section('content')
    <main class="bg_gray">

        <div class="container margin_30">
            <div class="page_header text-center">
                <!-- <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#">Đăng nhập/Đăng ký</a></li>
                            <li>Page active</li>
                        </ul>
                </div>
                <h1>Đăng ký</h1> -->
            </div>
            <!-- /page_header -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <form action="" method="post" onsubmit="return CheckRegister()">
                        <div class="box_account">
                            <h3 class="new_client text-center">Đăng ký</h3>
                            <div class="form_container">
                                <div class="form-group">
                                    <label for="email_2" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ $data['email'] }}">
                                    <span class="error text-danger " id="errorEmail">{{ $mess['email'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label">Tên đăng nhập</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ $data['username'] }}">
                                    <span class="error text-danger" id="errorUsername">{{ $mess['username'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="{{ $data['password'] }}">
                                    <span class="error text-danger" id="errorPass"></span>
                                </div>
                                <span class="mt-3 text-danger" id="error"></span>

                            </div>
                            <div class="text-center mt-1"><input type="submit" value="Đăng ký" class="btn_1 full-width"></div>

                        </div>
                        <!-- /form_container -->
                </div>
                </form>
                <!-- /box_account -->
            </div>

            <div class="row text-center mt-4 mb-5">
                <p>Bạn đã có tài khoản? <a href="{{ BASE_URL . 'login' }}">Đăng nhập</a></p>
            </div>
        </div>
        <script>
            function CheckRegister(){
                const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
                const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                const email = document.getElementById('email').value;
                console.log(email);
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                if(email == "" || username == "" || password ==""){
                    document.getElementById('error').innerHTML = "Vui lòng nhập đầy đủ thông tin";
                    return false;
                }
                if(!emailRegex.test(email)){
                    document.getElementById('errorEmail').innerHTML = "Email không đúng định dạng";
                    return false;
                }
                if(!passwordRegex.test(username)){
                    document.getElementById('errorUsername').innerHTML = "Tên đăng nhập phải tối thiểu 8 kí tự, có ít nhất một chữ cái và một số";
                    return false;
                }
                if(!passwordRegex.test(password)){
                    document.getElementById('errorPass').innerHTML = "Mật khẩu phải tối thiểu 8 kí tự, có ít nhất một chữ cái và một số";
                    return false;
                }
            }
        </script>
        <!-- /row -->
        <!-- /container -->
    </main>
    <!--/main-->
@endsection
