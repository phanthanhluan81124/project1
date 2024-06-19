@extends('layouts.master')

@section('content')
    <div class="container">
        <h4 class="text-center mt-1">Thông Tin Hóa Đơn</h4>
        <div class="row ">
            <div class="col-12 mt-2 mb-2" style="background-color: #004dda ;padding: 10px;"><img src="./../upload/logo.svg"
                    alt="" width="100" height="35">
            </div>
        </div>
        <div class="row">
            <label for="">PartnerCode: {{ $bills->partnerCode }}</label>
            <label for="">Mã Đơn Hàng: {{ $bills->orderId }}</label>
            <label for="">Kiểu Thanh Toán: {{ $bills->orderType }}</label>
            <label for="">PayType: {{ $bills->payType }}</label>
            <label for="">Thời Gian Thanh Toán : {{ $bills->created_at }}</label>
            <hr>
            <h3 style="color: #004dda">Giá tiền :  {{ number_format($bills->amount, 0, ',', '.') . ' đ' }}</h3>
        </div>
    </div>
@endsection
