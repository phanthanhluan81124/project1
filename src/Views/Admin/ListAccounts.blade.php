@extends('layouts.master')

@section('content')
    <div class="content ">
        <div class="card mb-4" style="width: 100%;" >
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="true"
                    data-bs-target="#keywordsCollapseExample" role="button">
                    <div>Tìm kiếm tài khoản</div>
                    <div class="bi bi-chevron-down"></div>
                </div>
                <div class="collapse show mt-4" id="keywordsCollapseExample">
                    <div class="input-group">
                        <form action="" method="get">
                            <input type="text" class="form-control" name="keyword" placeholder="email......">
                            <button class="btn" type="submit">
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
        <div class="row" style="width: 100%;">
            <div class="col-md-8" style="width: 100%;">

                <a href="{{ BASE_URL . 'admin/accounts-add' }}"> <button type="submit" class="btn btn-primary"
                        style="margin: 0px">Thêm mới</button></a>

            </div>
            <!-- Button trigger modal -->

            <!-- Modal -->
        </div>
        <div class="table-responsive" style="width: 100%;" id="category">
            <table class="table table-custom table-lg mb-0">
                <thead>
                    <tr>

                        <th>Tên Đăng Nhập</th>
                        <th>Tên Đầy Đủ</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Trạng Thái</th>
                        <th class="text-end">Actions</th>
                        <!-- <th ">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Accounts as $item)
                        <tr>

                            <td>{{ $item->username }}</td>
                            <td>{{ $item->fullname }}</td>
                            @if ($item->role == 'customer')
                                <td>{{ $item->email }}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ $item->tel }}</td>
                            @if ($item->status == 'active')
                                <td class="text-success">Active</td>
                            @else
                                <td class="text-danger">Ban</td>
                            @endif
                            <td class="d-flex text-end" style="margin-left: 25px">
                                @if ($_SESSION['user'][0]->role == 'manager')
                                    @if ($item->role == 'manager')
                                    @elseif($item->status == 'ban')
                                        <a href="{{ BASE_URL . 'admin/accounts-delete-' . $item->id . '?unban=' }}">
                                            <button class="btn btn-danger" style="margin-left: 2px"
                                                onclick="return confirm('Bạn có chắc muốn unBan không?')"
                                                name="unban">UnBan</button>
                                        </a>
                                    @else
                                        <a href="{{ BASE_URL . 'admin/accounts-delete-' . $item->id }}">
                                            <button class="btn btn-danger" style="margin-left: 2px"
                                                onclick="return confirm('Bạn có chắc muốn ban không?')">Ban</button>
                                        </a>
                                    @endif
                                @endif
                                @if ($_SESSION['user'][0]->role == 'admin')
                                    @if ($item->role == 'admin')
                                    @endif
                                    @if ($item->role == 'customer')
                                        @if ($item->status == 'ban')
                                            <a href="{{ BASE_URL . 'admin/accounts-delete-' . $item->id . '?unban=' }}">
                                                <button class="btn btn-success" style="margin-left: 2px"
                                                    onclick="return confirm('Bạn có chắc muốn unBan không?')"
                                                    name="unban">UnBan</button>
                                            </a>
                                        @else
                                            <a href="{{ BASE_URL . 'admin/accounts-delete-' . $item->id }}">
                                                <button class="btn btn-danger" style="margin-left: 2px"
                                                    onclick="return confirm('Bạn có chắc muốn ban không?')">Ban</button>
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="container text-center mb-5">
        @for ($i = 1; $i <= $number; $i++)
            @if (isset($_GET['keyword']) && !empty($_GET['keyword']))
                <a href = "{{ BASE_URL . $_GET['url'] . '?keyword=' . $_GET['keyword'] . '&page=' . $i }}">
                    <button class="btn btn-primary" id ='page' style="margin: 0px">
                        <p id="number" style="height: 5px; text-align:center ;margin-left: 3px">{{ $i }}</p>
                    </button>
                </a>
            @else
                <a href = "{{ BASE_URL . $_GET['url'] . '?page=' . $i }}">
                    <button class="btn btn-primary" id ='page' style="margin: 0px">
                        <p id="number" style="height: 5px; text-align:center ;margin-left: 3px">{{ $i }}
                        </p>
                    </button>
                </a>
            @endif
        @endfor
    </div>
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
