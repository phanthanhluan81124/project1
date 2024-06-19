@extends('layouts.master')

@section('content')
    <main>
        <!-- layout-wrapper -->
        <div class="container margin_30">
            <div class="layout-wrapper">
                <!-- content -->
                <div class="content ">

                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <form action="" method="post" enctype="multipart/form-data"
                                        id ="formUpdateInforUser" onsubmit="return Validate()">
                                        <div class="mb-4">
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <h6 class="card-title mb-4 col-5">Thông tin cá nhân</h6>
                                                        <h6 class="col-4 text-success" id="check">
                                                            @if (isset($mes['all']))
                                                                {{ $mes['all'] }}
                                                            @endif
                                                        </h6> <br>
                                                    </div>
                                                    <div class="row text-center mb-4">
                                                        <div class="col">
                                                            <figure class="me-4">
                                                                <img width="100" height="100"
                                                                    src="{{ BASE_URL . 'upload/' . $userInfor[0]->avatar }}"
                                                                    alt="...">
                                                            </figure>
                                                            <input type="file" name="avatar" placeholder="Chọn ảnh">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tên đăng nhập</label>
                                                                    <input type="text" name="username"
                                                                        class="form-control"
                                                                        value="{{ $userInfor[0]->username }}" disabled>
                                                                </div>
                                                                @if ($userInfor[0]->role != 'admin')
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="email" name="email"
                                                                            class="form-control"
                                                                            value="{{ $userInfor[0]->email }}">
                                                                        <span
                                                                            class="text-danger">{{ $mess['email'] }}</span>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Họ và tên</label>
                                                                    <input type="text" name="fullname"
                                                                        class="form-control"
                                                                        value="{{ $userInfor[0]->fullname }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Số điện thoại</label>
                                                                    <input type="text" name="tel"
                                                                        class="form-control"
                                                                        value="{{ $userInfor[0]->tel }}">
                                                                    <span class="text-danger">{{ $mess['tel'] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @if ($userInfor[0]->role != 'admin')
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Địa chỉ</label>
                                                                        <input type="text" name="address"
                                                                            class="form-control"
                                                                            value="{{ $userInfor[0]->address }}">
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                        @if (isset($_GET['changepass']))
                                                            <div class="row" id="changePass">
                                                                <div class="row mt-1">
                                                                    <div class="col">
                                                                        <div class="mb-3" id="password1">
                                                                            <label class = "form-label"> Mật khẩu cũ
                                                                            </label>
                                                                            <input type = "text" class = "form-control"
                                                                                id = "oldPassword" name = "oldPassword">
                                                                        </div>
                                                                        <div class="mb-3  text-danger" id="errorPass">
                                                                            @if (isset($mes['error']))
                                                                                {{ $mes['error'] }}
                                                                            @else 

                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3" id="newPassword1">
                                                                            <label class = "form-label">Mật khẩu mới
                                                                            </label>
                                                                            <input type = "text" name = "password"
                                                                                id="newPasswordUser"class="form-control">
                                                                        </div>
                                                                        <div class="mb-3"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3 mt-1" id = "checkNewPassowrd1">
                                                                            <label class = "form-label"> Nhập lại mật khẩu
                                                                                mới
                                                                            </label> <input type = "text"
                                                                                id = "checkNewPassowrd"
                                                                                class = "form-control">
                                                                        </div>
                                                                        <div class="mb-3 text-danger" id='checkPassowrd'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div> <br>
                                                    <a href="{{ BASE_URL . 'infor/' . $userInfor[0]->id }}"><button
                                                            class="btn btn-primary me-2" type="submit">Lưu thay
                                                            đổi</button></a>

                                                    @if ($userInfor[0]->role == 'customer')
                                                        <a href="{{ BASE_URL . $_GET['url'] . '?changepass' }}"><button
                                                                class="btn btn-info" id="changePassword"
                                                                type="button">Đổi
                                                                mật
                                                                khẩu</button></a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                    <script>
                                        var submit = document.getElementById('formUpdateInforUser');
                                        var password = document.getElementById('password1');
                                        var newPassword = document.getElementById('newPassword1');
                                        var checkNewPassowrd = document.getElementById('checkNewPassowrd1');
                                        if(document.getElementById('check').innerText != ""){
                                            document.getElementById('check').innerHTML = "Lưu Thành Công";
                                           location.search = "";
                                        }
                                        function Validate() {
                                            // var passowrdForm = document.getElementById('oldPassword').value;
                                            var passowrdNewForm = document.getElementById('newPasswordUser').value;
                                            var passowrdNewFormCheck = document.getElementById('checkNewPassowrd').value;
                                            console.log(passowrdNewForm, passowrdNewFormCheck);
                                            console.log(passowrdForm);
                                            if (passowrdNewForm != passowrdNewFormCheck) {
                                                document.getElementById('checkPassowrd').innerText = "Mật khẩu không trùng khớp ";
                                                return false;
                                            } else if (passowrdNewForm == passowrdNewFormCheck) {
                                                document.getElementById('checkPassowrd').innerText = " ";
                                                return true;
                                            }
                                        }


                                        // })
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                </div>
                <!-- ./ content -->
            </div>
        </div>

    </main>
@endsection
