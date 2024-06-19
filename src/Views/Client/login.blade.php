@extends('layouts.master')

@section('content')
    <main class="bg_gray">

        <div class="container margin_30">
            <!-- <div class="page_header text-center">
                                                    <div class="breadcrumbs">
                                                        <ul>
                                                            <li><a href="#">Trang chủ</a></li>
                                                            <li><a href="#">Đăng nhập/Đăng ký</a></li>
                                                            <li>Page active</li>
                                                        </ul>
                                                </div>
                                                <h1>Đăng nhập</h1> -->
        </div>
        <!-- /page_header -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">

                    @if (isset($_SESSION['emailCheck']) && isset($_SESSION['code']))
                        <input type="hidden" id="codeEmail1" value="{{ $_SESSION['code'] }}">
                        <h3 class="client text-center">Mã xác thực</h3>
                        <div class="form_container">
                            <form action="" method="post" id="codeMail" onsubmit="return codeEmail()">
                                <div class="form-group" id="code">
                                    <label for="code" class="form-label">Mã xác thực</label>
                                    <input type="text" class="form-control" name="code" id="codeCheck">
                                    <input type="hidden" class="form-control" name="email"
                                        value="{{ $_SESSION['emailCheck'] }}">
                                </div>
                                <label for="" class ="text-danger" id="errorCode"></label>
                                <div class="text-center mt-1"><input type="submit" value="Gửi mã xác thực"
                                        class="btn_1 full-width"></div>
                            </form>
                        </div>
                    @elseif (isset($_SESSION['resPass']))
                        <h3 class="client text-center">Tạo mật khẩu mới</h3>
                        <div class="form_container">
                            <form action="" method="post" id="codeMail" onsubmit="return CheckPass()">
                                <div class="form-group" id="code">
                                    <label for="code" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" name="newPass" id="newPass">
                                    <input type="hidden" class="form-control" name="email"
                                        value="{{ $_SESSION['emailCheck'] }}">
                                </div>
                                <div class="form-group" id="code">
                                    <label for="code" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="newPassCheck">
                                </div>
                                <label for="" class ="text-danger" id="errorNewPass"></label>
                                <div class="text-center mt-1"><input type="submit" value="Tạo mật khẩu"
                                        class="btn_1 full-width"></div>
                            </form>
                        </div>
                    @else
                        <h3 class="client text-center" id="login">Đăng nhập</h3>
                        <h3 class="client text-center" id="ForgotPassword" hidden>Quên Mật khẩu</h3>
                        <div class="form_container">
                            <form action="" method="post" id="FormLogin">
                                <div class="form-group" id="username">
                                    <label for="username" class="form-label">Tên đăng nhập</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ $data['username'] }}">
                                </div>
                                <div class="form-group" id="Email" hidden>
                                    <label for="email" class="form-label">Email của bạn</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ $data['email'] }}">
                                </div>
                                <div class="form-group" id="password">
                                    <label for="password_in" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" id="password_in">
                                    <span class="text-danger mt-1">{{ $mess }}</span>
                                </div>
                                <p class="text-danger" id="error">@php
                                    if(isset($mess1)){
                                        echo $mess1;
                                    }
                                @endphp</p>

                                <div class="clearfix add_bottom_15" id="itemLogin">
                                    <div class="checkboxes float-start">
                                        <label class="container_check text-drak">Ghi nhớ mật khẩu
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                    <div class="float-end"><button type="button" class="" id="checkpass"
                                            onclick="check()">Quên mật
                                            khẩu</button></a>
                                    </div>
                                </div>
                                <div class="text-center" id="itemLogin1">
                                    <button class="btn_1 full-width" type="submit" >Đăng
                                        nhập</button>
                                    {{-- <input type="button" value="Đăng nhập"
                                        class="btn_1 full-width"> --}}
                                </div>
                                <div class="text-center" id='ForgotPassword1' hidden>
                                    <button type="button" class="btn_1 full-width" onclick="EmailCheck()">Gửi</button>
                                    
                                    {{-- <input type="submit"
                                        value="Gửi" class=""> --}}
                                    </div>
                            </form>
                        </div>
                        <!-- /form_container -->
                </div>
                @endif


                <!-- /box_account -->
                <div class="row text-center mt-4 mb-5">
                    <p>Bạn chưa có tài khoản ? <a href="{{ BASE_URL . 'register' }}">Đăng ký ngay</a></p>
                    <p id="login1" hidden><a href="{{ BASE_URL . 'login' }}">Đăng nhập</a></p>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /row -->
        </div>
        <style>
            #checkpass {
                border: solid 1px #f8f9fa;
                background-color: #f8f9fa;
                color: rgb(0, 0, 0);
            }
        </style>
        <!-- /container -->
        <script>
            btn = document.getElementById('checkpass')

            if(document.getElementById('error').innerText != "" ){
                document.getElementById('username').hidden = true;
                document.getElementById('password').hidden = true;
                document.getElementById('login').hidden = true;
                document.getElementById('login1').hidden = false;
                document.getElementById('itemLogin').hidden = true;
                document.getElementById('itemLogin1').hidden = true;
                document.getElementById('Email').hidden = false;
                document.getElementById('ForgotPassword').hidden = false;
                document.getElementById('ForgotPassword1').hidden = false;
            }

            function check() {
                document.getElementById('username').hidden = true;
                document.getElementById('password').hidden = true;
                document.getElementById('login').hidden = true;
                document.getElementById('login1').hidden = false;
                document.getElementById('itemLogin').hidden = true;
                document.getElementById('itemLogin1').hidden = true;
                document.getElementById('Email').hidden = false;
                document.getElementById('ForgotPassword').hidden = false;
                document.getElementById('ForgotPassword1').hidden = false;
                return false;
            }

            function codeEmail() {
                var code = document.getElementById('codeEmail1').value;
                var codeCheck = document.getElementById('codeCheck').value;
                console.log(code, codeCheck);

                if (code == codeCheck) {
                    return true;
                } else {
                    document.getElementById('errorCode').innerHTML = "Mã xác nhận không đúng";
                    return false;
                }

            }

            function CheckPass() {
                const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
                var newPass = document.getElementById('newPass').value;
                var newPassCheck = document.getElementById('newPassCheck').value;
                // console.log(code, codeCheck);
                if(newPass==""|| newPassCheck==""){
                    document.getElementById('errorNewPass').innerHTML = "Vui lòng nhập mật khẩu";
                    return false;
                }
                else if(!passwordRegex.test(newPass)){
                    document.getElementById('errorNewPass').innerHTML = "Mật khẩu phải tối thiểu 8 kí tự, có ít nhất một chữ cái và một số";
                    return false;
                }
                else if (newPass == newPassCheck && passwordRegex.test(newPass)) {
                    return true;
                } else {
                    document.getElementById('errorNewPass').innerHTML = "Mật khẩu không trùng khớp";
                    return false;
                }
                // return false

            }

            function EmailCheck() {
                const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                var email = document.getElementById('email');
                
                if(email.value ==""){
                    document.getElementById('error').innerHTML = "Vui lòng nhập đầy đủ thông tin ";
                    return false;
                }
                else if(email.value != "" && !emailRegex.test(email.value) ){
                    document.getElementById('error').innerHTML = "Email không đúng định dạng ";
                    console.log(email.value);
                    return false
                }
                else {
                    document.getElementById('error').innerHTML = "";
                    console.log(email.value, emailRegex.test(email.value));
                    const form = document.getElementById('FormLogin');
                    form.submit();
                    // return true;
                }
            }
        </script>
    </main>
    <!--/main-->
@endsection
