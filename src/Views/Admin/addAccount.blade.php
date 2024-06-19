@extends('layouts.master')

@section('content')
    <h3>Thêm Tài Khoản</h3>
    @if (isset($mess))
        <div class="alert alert-success" role="alert">
            {{ $mess }}
        </div>
    @endif

    <form action="" method="post" enctype="multipart/form-data" id="form_user">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username: <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ $data['username'] }}">
                    <span id="errorUsername" class="text-danger">{{ $error['username'] }}</span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email:<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $data['email'] }}">
                    <span id="errorEmail" class="text-danger">{{ $error['email'] }}</span>

                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password:<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="password" name="password"
                        value="{{ $data['password'] }}">
                    <span id="errorPassword" class="text-danger"></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter the password:<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="EnterThePassword" value="{{ $data['password'] }}">
                    <span id="errorEnterPassword" class="text-danger"></span>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">FullName:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname"
                        value="{{ $data['fullname'] }}">
                    <span id="errorFullname" class="text-danger"></span>

                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Number Phone:<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tel" name="tel"value="{{ $data['tel'] }}">
                    <span id="errorPhone" class="text-danger"></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Avatar:</label>
                    @if (!empty($data['avatar']))
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="avatar"
                            value="{{ $data['avatar'] }}" hidden>
                        <input type="file" class="form-control" id="exampleFormControlInput1" name="avatar">
                    @else
                        <input type="file" class="form-control" id="exampleFormControlInput1" name="avatar">
                    @endif

                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $data['address'] }}">
                    <span id="errorAddress" class="text-danger"></span>

                </div>
            </div>
        </div>

        @if ($_SESSION['user'][0]->role == 'manager')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">role: <span class="text-danger">*</span></label>
                <select name="role" id="role" class="form-control">
                    <option value="" selected>-ROLE-</option>
                    <option value="admin" @if (isset($data) && $data['role'] == 'admin') selected @endif>Admin</option>
                    <option value="customer" @if (isset($data) && $data['role'] == 'customer') selected @endif>Customer</option>
                </select>
            </div>
        @endif
        <p id="checked" hidden></p>
        <button class="btn btn-success" type="submit" id="btn">Thêm</button>
        <a href="{{ BASE_URL . 'admin/accounts' }}"><button class="btn btn-primary" type="button">Danh
                Sách</button></a>
    </form>
    <script>
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        const addresRegex = /^\d+\s+([A-Za-z]+(?:\s+[A-Za-z]+)*),\s+([A-Za-z ]+)\s*([0-9]{5})?$/;;
        const emailRegex =
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const regex = /^(?:\p{L}{1,}\s){1,2}(?:\p{L}{1,})+$/;
        const textRegex =
            /^(?:((([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-.\s])){1,}(['’,\-\.]){0,1}){2,}(([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-. ]))*(([ ]+){0,1}(((([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-\.\s])){1,})(['’\-,\.]){0,1}){2,}((([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-\.\s])){2,})?)*)$/;
        const btn = document.getElementById('form_user');
        btn.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const enterPassword = document.getElementById('EnterThePassword').value;
            const tel = document.getElementById('tel').value;
            const role = document.getElementById('role').value;
            const fullname = document.getElementById('fullname').value;
            const address = document.getElementById('address').value;

            document.getElementById('errorPassword').innerHTML = "";
            document.getElementById('errorEnterPassword').innerHTML = "";
            document.getElementById('errorEmail').innerHTML = "";
            document.getElementById('errorUsername').innerHTML = "";
            document.getElementById('errorFullname').innerHTML = "";
            document.getElementById('errorAddress').innerHTML = "";

            document.getElementById('checked').innerHTML = true;
            if (username == "" || email == "" || password == "" || enterPassword == "" || tel == "" || role == "") {
                alert('Vui lòng nhập đầy đủ thông tin!');
                document.getElementById('checked').innerHTML = false;
            } else {
                document.getElementById('checked').innerHTML = false;
                if (!passwordRegex.test(password)) {
                    document.getElementById('errorPassword').innerHTML =
                        "Mật khẩu phải tối thiểu 8 kí tự,  một chữ cái và một số";
                }
                if (password != enterPassword) {
                    document.getElementById('errorEnterPassword').innerHTML = "Mật khẩu không trùng khớp";
                }
                if (!email.match(emailRegex)) {
                    document.getElementById('errorEmail').innerHTML = "Email không hợp lệ";
                }
                if (!passwordRegex.test(username)) {
                    document.getElementById('errorUsername').innerHTML = "Username không hợp lệ";
                }
                if (fullname != "" && !fullname.match(textRegex)) {
                    document.getElementById('errorFullname').innerHTML = "FullName không hợp lệ";
                }
                if (passwordRegex.test(password) && password == enterPassword && email.match(emailRegex) &&
                    passwordRegex.test(username) && fullname != "" && fullname.match(textRegex) && address != "" &&
                    !address.match(textRegex)) {
                    document.getElementById('checked').innerHTML = true;
                }
            }
            if (document.getElementById('checked').innerText == 'true') {
                btn.submit();
            }

        })
    </script>
@endsection
