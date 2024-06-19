@extends('layouts.master')

@section('content')
    <div class="content ">
        <div class="card mb-4" style="width: 100%;" id="searchCategory">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="true"
                    data-bs-target="#keywordsCollapseExample" role="button">
                    <div>Tìm kiếm đơn hàng</div>
                    <div class="bi bi-chevron-down"></div>
                </div>
                <div class="collapse show mt-4" id="keywordsCollapseExample">
                    <div class="input-group">
                        <form action="" method="get" onsubmit="return searchCheck()">
                            <input type="text" class="form-control" name="keyword" id="keyword"
                                placeholder="số điện thoại ......">
                            <button class="btn" type="submit" id = 'search' onclick="searchCheck()">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            form {
                display: flex;
            }

            form .form-control {
                width: 800px;
            }

            .btn {
                margin-left: -58px;
            }

            .card,
            .table-responsive {
                width: 850px;
            }

            .mt-4 {
                align-items: center;
            }
        </style>
        @if ($number == 0)
            <p class="text-center">Không có đơn hàng</p>
        @else
            <div class="table-responsive" style="width: 100%;" id="category">
                <table class="table table-custom table-lg mb-0">
                    <thead>
                        <tr>
                            <th>Tên người nhận</th>
                            <th>email</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th class="text-end"></th>
                            <!-- <th ">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->tel }}</td>
                                @if ($item->status == 'canceled')
                                    <td class="text-danger">{{ $item->status }}
                                @else
                                    <td class="text-success">{{ $item->status }}
                                @endif
                                <br>
                                </td>
                                <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                <td class="d-flex text-end ">

                                    <a href="{{ BASE_URL . 'admin/orders-detail-' . $item->order_id }}"
                                        style="color: blue;">xem thêm</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="container text-center mb-5">
                @for ($i = 1; $i <= $number; $i++)
                    @if (isset($_GET['keyword']) && !empty($_GET['keyword']))
                        <a href = "{{ BASE_URL . $_GET['url'] . '&keyword=' . $_GET['keyword'] . '&page=' . $i }}">
                            <button class="btn btn-primary" id ='page' style="margin: 0px">
                                <p id="number" style="height: 5px; text-align:center ;margin-left: 3px">
                                    {{ $i }}
                                </p>
                            </button>
                        </a>
                    @else
                        <a href = "{{ BASE_URL . $_GET['url'] . '?page=' . $i }}">
                            <button class="btn btn-primary" id ='page' style="margin: 0px">
                                <p id="number" style="height: 5px; text-align:center ;margin-left: 3px">
                                    {{ $i }}
                                </p>
                            </button>
                        </a>
                    @endif
                @endfor
            </div>
        @endif

    </div>
    <style>
        .page {
            width: 30px;
            height: 30px;
            margin: 5px;
            color: #ff6e40;
            border: solid 1px #ff6e40;
            background-color: #fff;
            border-radius: 10px;
        }

        .page:hover {
            background-color: #ff6e40;
            color: #fff;
        }

        button {
            background-color: #ff6e40;
            color: #fff;
            border: solid 1px #ff6e40;
            border-radius: 5px;
        }
    </style>
@endsection
