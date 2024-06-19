@extends('layouts.master')

@section('content')
    <div class="container">
        @if (isset($infoVoucher))
            <h1>Sửa Voucher</h1>
        @else
            <h1>Thêm Voucher</h1>
        @endif

        <h6>
            @if (isset($mess))
                {{ $mess }}
            @endif
        </h6>
        <form action="" id="form_voucher" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Mã Giảm Giá</label>
                        <input type="text" class="form-control" id="code_voucher" placeholder="mã giảm giá" name="code"
                            value="@if (isset($data['code'])) {{ $data['code'] }} @elseif(isset($infoVoucher)){{ $infoVoucher->code }} @endif">
                        <span class="text-danger">
                            @if (isset($error))
                                {{ $error['code'] }}
                            @endif
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Kiểu Giảm Giá</label>
                        <select name="category_code" id="category_code" class="form-control">
                            <option value="" selected>---Kiểu Giảm Giá---</option>
                            <option value="0"
                                @if (isset($data['category_code']) && $data['category_code'] == 0) selected @elseif(isset($infoVoucher) && $infoVoucher->category_code == 0) selected @endif>
                                Giảm theo giá tiền
                            </option>
                            <option value="1"
                                @if (isset($data['category_code']) && $data['category_code'] == 1) selected @elseif(isset($infoVoucher) && $infoVoucher->category_code == 1) selected @endif>
                                Giảm theo phần trăm
                            </option>
                        </select>
                        <span id="errorCategoryCode" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Số Lượng Giảm</label>
                        <input type="text" class="form-control" id="value" placeholder="số lượng giảm % hoặc đ"
                            name="value"
                            value="@if (isset($data['value'])) {{ $data['value'] }} @elseif(isset($infoVoucher)){{ $infoVoucher->value }} @endif">
                        <span id="errorValue" class="text-danger"></span>
                    </div>

                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Ngày Bắt Đầu</label>
                        @if (isset($infoVoucher))
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" id="value_start"
                                        value="{{ $infoVoucher->date_start }}"disabled>
                                    <input type="datetime-local" class="form-control mt-2" id="date_start" name="date_start"
                                        hidden>
                                </div>
                                <div class="col-4"> <button type="button" class="btn btn-dark" id="editDate1">sửa</button>
                                </div>
                            </div>
                        @else
                            <input type="datetime-local" class="form-control" id="date_start" name="date_start">
                        @endif
                        <span id="errorStart" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Ngày Kết Thúc</label>
                        @if (isset($infoVoucher))
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" id="value_end" value="{{ $infoVoucher->date_end }}"
                                        disabled>
                                    <input type="datetime-local" class="form-control mt-2" id="date_end" name="date_end"
                                        hidden>
                                </div>
                                <div class="col-4"> <button type="button" class="btn btn-dark" id="editDate2">sửa</button>
                                </div>
                            </div>
                        @else
                            <input type="datetime-local" class="form-control" id="date_end" name="date_end">
                        @endif
                        <span id="errorEnd" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Số Lượng Mã</label>
                        <input type="text" class="form-control" id="quantity" placeholder="số lượng mã " name="quantity"
                            value="@if (isset($data['quantity'])) {{ $data['quantity'] }} @elseif(isset($infoVoucher)){{ $infoVoucher->quantity }} @endif">
                        <span id="errorQuantity" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <br>
            @if (isset($infoVoucher))
                <input type="text" name="update" hidden>
                <button type="submit" class="btn btn-success">Sửa</button>
            @else
                <input type="text" name="add" hidden>
                <button type="submit" class="btn btn-success">Thêm Mới</button>
            @endif
            <a href="{{ BASE_URL . 'admin/list-voucher' }}"><button type="button" class="btn btn-primary">Danh
                    Sách</button></a>
        </form>
        <p id="checked" hidden></p>
    </div>
    @if (isset($infoVoucher))
        <script>
            const btn1 = document.getElementById('editDate1');
            const btn2 = document.getElementById('editDate2');
            btn1.addEventListener('click', function(event) {
                document.getElementById('date_start').hidden = false;
            })
            btn2.addEventListener('click', function(event) {
                document.getElementById('date_end').hidden = false;
            })


            const now = new Date();
            const btn = document.getElementById('form_voucher');
            btn.addEventListener('submit', function(event) {
                event.preventDefault();
                const category_code = document.getElementById('category_code').value;
                const code = document.getElementById('code_voucher').value;
                const value1 = document.getElementById('value').value;
                if (document.getElementById('date_start').hidden == false) {
                    const date_start = document.getElementById('date_start').value;
                }else{
                    const date_start = document.getElementById('value_start').value; 
                }
                if (document.getElementById('date_end').hidden == false) {
                    const date_end = document.getElementById('date_end').value;
                }else{
                    const date_end = document.getElementById('value_end').value;
                }
                const quantity = document.getElementById('quantity').value;
                const datetime_local = new Date(Date.parse(date_start.value));
                const datetime_local1 = new Date(Date.parse(date_end));
                document.getElementById('errorValue').innerHTML = "";
                document.getElementById('errorQuantity').innerHTML = "";
                document.getElementById('errorStart').innerHTML = "";
                document.getElementById('errorEnd').innerHTML = "";
                document.getElementById('checked').innerHTML = 'true';
                // console.log(date_start);
                // console.log(date_start.value, date_end);
                if (category_code == "" || code == "" || value1 == "" || quantity == "") {
                    alert("Vui Lòng Nhập Đầy Đủ Thông Tin");
                    document.getElementById('checked').innerHTML = 'false';
                } else if (category_code != "" && code != "" && value1 != "" && quantity != "") {
                    document.getElementById('checked').innerHTML = 'false';
                    if (!isNaN(value1) && value1 < 1) {
                        document.getElementById('errorValue').innerHTML = "Số lượng giảm phải lớn hơn 0";
                    } else if (category_code == 1 && value1 > 100) {
                        document.getElementById('errorValue').innerHTML =
                            "Số lượng giảm theo phần trăm phải hớn hơn 1 và nhỏ hơn 100";
                    } else if (isNaN(value1)) {
                        document.getElementById('errorValue').innerHTML = "Số lượng giảm phải là số";
                    }
                    if (!isNaN(quantity) && quantity < 1) {
                        document.getElementById('errorQuantity').innerHTML = "Số lượng mã giảm giá phải lớn hơn 0";
                    } else if (isNaN(quantity)) {
                        document.getElementById('errorQuantity').innerHTML = "Số lượng mã giảm giá phải là số";
                    }
                    if (document.getElementById('date_start').hidden == false) {
                        if (now > datetime_local) {
                            document.getElementById('errorStart').innerHTML = "Ngày bắt đầu phải lơn hơn hiện tại";
                        }
                    }
                    if (document.getElementById('date_end').hidden == false) {
                        if (date_start.value > date_end) {
                            document.getElementById('errorEnd').innerHTML = "Ngày kết thúc phải lớn hơn ngày bắt đầu ";
                        }
                    }
                    if ((document.getElementById('date_start').hidden == false) && (document.getElementById('date_end')
                        .hidden == false)) {
                        if (value1 > 1 && now < datetime_local && date_start.value < date_end) {
                            if (category_code == 1 && value1 < 100) {
                                document.getElementById('checked').innerHTML = 'true';
                            } else {
                                document.getElementById('checked').innerHTML = 'true';
                            }
                        }
                    }
                    if (document.getElementById('date_start').hidden == true && document.getElementById('date_end')
                        .hidden == true) {
                        if (value1 > 1 && now < datetime_local && date_start.value < date_end) {
                            if (category_code == 1 && value1 < 100) {
                                document.getElementById('checked').innerHTML = 'true';
                            } else {
                                document.getElementById('checked').innerHTML = 'true';
                            }
                        }
                    }
                }
                if (document.getElementById('checked').innerText == 'true') {
                    btn.submit();
                }
            })
        </script>
    @else
        <script>
            const now = new Date();
            const btn = document.getElementById('form_voucher');
            btn.addEventListener('submit', function(event) {
                event.preventDefault();
                const category_code = document.getElementById('category_code').value;
                const code = document.getElementById('code_voucher').value;
                const value1 = document.getElementById('value').value;
                const date_start = document.getElementById('date_start').value;
                const date_end = document.getElementById('date_end').value;
                const quantity = document.getElementById('quantity').value;
                const datetime_local = new Date(Date.parse(date_start));
                const datetime_local1 = new Date(Date.parse(date_end));
                document.getElementById('errorValue').innerHTML = "";
                document.getElementById('errorQuantity').innerHTML = "";
                document.getElementById('errorStart').innerHTML = "";
                document.getElementById('errorEnd').innerHTML = "";
                if (category_code == "" || code == "" || value1 == "" || date_start == "" || date_end == "" ||
                    quantity == "") {
                    alert("Vui Lòng Nhập Đầy Đủ Thông Tin");
                    document.getElementById('checked').innerHTML = 'false';
                } else if (category_code != "" && code != "" && value1 != "" && date_start != "" && date_end != "" &&
                    quantity != "") {
                    document.getElementById('checked').innerHTML = 'false';
                    if (!isNaN(value1) && value1 < 1) {
                        document.getElementById('errorValue').innerHTML = "Số lượng giảm phải lớn hơn 0";
                    } else if (category_code == 1 && value1 > 100) {
                        document.getElementById('errorValue').innerHTML =
                            "Số lượng giảm theo phần trăm phải hớn hơn 1 và nhỏ hơn 100";
                    } else if (isNaN(value1)) {
                        document.getElementById('errorValue').innerHTML = "Số lượng giảm phải là số";
                    }
                    if (!isNaN(quantity) && quantity < 1) {
                        document.getElementById('errorQuantity').innerHTML = "Số lượng mã giảm giá phải lớn hơn 0";
                    } else if (isNaN(quantity)) {
                        document.getElementById('errorQuantity').innerHTML = "Số lượng mã giảm giá phải là số";
                    }
                    if (now > datetime_local) {
                        document.getElementById('errorStart').innerHTML = "Ngày bắt đầu phải lơn hơn hiện tại";
                    }
                    if (date_start > date_end) {
                        document.getElementById('errorEnd').innerHTML = "Ngày kết thúc phải lớn hơn ngày bắt đầu ";
                    }
                    if (value1 > 1 && now < datetime_local && date_start < date_end) {
                        if (category_code == 1 && value1 < 100) {
                            document.getElementById('checked').innerHTML = 'true';
                        } else {
                            document.getElementById('checked').innerHTML = 'true';
                        }
                    }
                }
                if (document.getElementById('checked').innerText == 'true') {
                    btn.submit();
                }
            })
        </script>
    @endif
@endsection
