@extends('layouts.master')

@section('content')
    <div class="content ">
        <div class="card mb-4" style="width: 100%;" id="searchCategory">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="true"
                    data-bs-target="#keywordsCollapseExample" role="button">
                    <div>Tìm kiếm Voucher</div>
                    <div class="bi bi-chevron-down"></div>
                </div>
                <div class="collapse show mt-4" id="keywordsCollapseExample">
                    <div class="input-group">
                        <form action="" method="get">
                            <input type="text" class="form-control" name="keyword" placeholder="Mã voucher ......">
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
                {{-- <div class="card" style="width: 100%;">
                    <div class="card-body" style="width: 100%;">
                        <div class="d-md-flex">
                            <div class="d-none d-md-flex">All Category</div>
                        </div>
                    </div>
                </div> --}}
                <div class="container" style="margin-left: 35px" id="addNew">
                    <a href="{{BASE_URL . 'admin/add-voucher'}}"><button type="button" class="btn btn-primary">Thêm mới</button></a>
                </div>
                <!-- Button trigger modal -->

                <!-- Modal -->
            </div>
            @if (isset($vouchers))
                <div class="table-responsive" style="width: 100%;" id="category">

                    <table class="table table-custom table-lg mb-0">
                        <thead>
                            <tr>

                                <th>STT</th>
                                <th>Mã Voucher</th>
                                <th>Số Lượng Giảm</th>
                                <th>Ngày Bắt Đầu</th>
                                <th>Ngày Kết thúc</th>
                                <th>số lượng</th>
                                <th class="text-end">Actions</th>
                                <!-- <th ">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($vouchers as $item) :
                           
                            ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->date_start }}</td>
                                <td>{{ $item->date_end }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="d-flex" style="margin-left: 35px;">
                                   
                                        
                                    <a href="{{ BASE_URL . 'admin/edit-voucher-'. $item->voucher_id }}"><button
                                        class="btn btn-warning" style="margin-left: 2px">Sửa</button></a>
                                    
                                    <a href="{{ BASE_URL . 'admin/voucher-delete/' . $item->voucher_id }}"><button
                                            class="btn btn-danger" style="margin-left: 2px"
                                            onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</button></a>
                                </td>
                            </tr>
                            <?php
                             $i++;
                             endforeach?>
                        </tbody>
                    </table>
                </div>
            @elseif (isset($_GET['category_id']))
                <h3 class="mt-3">Sửa danh mục</h3>
                <form action="" method="POST">
                    <input type="text" name="category_name" value="{{ $category[0]->category_name }}"
                        class="form-control">
                    <input type="text" name="id" value="{{ $category[0]->id }}" hidden> <br>
                    <button type="submit" class="btn btn-warning" style="margin-left: 0px">Sửa</button>
                </form>
            @endif
        </div>
    </div>
    @if (isset($number) && !empty($number))
        <div class="container text-center" id ="pagination">
            @for ($i = 1; $i <= $number; $i++)
                @if (isset($_GET['keyword']) && !empty($_GET['keyword']))
                    <a href = "{{ BASE_URL . $_GET['url'] . '?keyword=' . $_GET['keyword'] . '&page=' . $i }}">
                        <button class="btn btn-primary" id ='page' style="margin: 0px">
                            <p id="number" style="height: 5px; text-align:center ;margin-left: 3px">{{ $i }}
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
