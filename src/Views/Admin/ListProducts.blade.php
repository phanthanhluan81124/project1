@extends('layouts.master')

@section('content')
    <div class="content ">
        <div class="card mb-4" style="width: 100%;" id="searchCategory">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="true"
                    data-bs-target="#keywordsCollapseExample" role="button">
                    <div>Tìm kiếm sản phẩm</div>
                    <div class="bi bi-chevron-down"></div>
                </div>
                <div class="collapse show mt-4" id="keywordsCollapseExample">
                    <div class="input-group">
                        <form action="" method="get">
                            <input type="text" class="form-control" name="keyword" placeholder="tìm kiếm ......">
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

                <a href="{{ BASE_URL . 'admin/product-add' }}"> <button type="submit" class="btn btn-primary" style="margin: 0px">Thêm mới</button></a>

            </div>
            <!-- Button trigger modal -->

            <!-- Modal -->
        </div>
        <div class="table-responsive" style="width: 100%;" id="category">
            <table class="table table-custom table-lg mb-0">
                <thead>
                    <tr>

                        <th>ID</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh Sản Phẩm</th>
                        <th>Giá Gốc</th>
                        <th>Giá Khuyến Mãi</th>
                        <th class="text-end">Actions</th>
                        <!-- <th ">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td><img src="{{BASE_URL . 'upload/' .$item->product_image }}" alt="" width="50px"></td>
                            <td> {{ number_format($item->product_price, 0, ',', '.') . 'đ' }}</td>
                            <td>@if ($item->discounted_price == 0)
                               
                                {{ $item->discounted_price = "" }}
                                @else 
                                {{ number_format($item->discounted_price, 0, ',', '.') . 'đ' }}
                            @endif</td>
                            <td class="d-flex text-end" style="margin-left: 25px">
                                <a href="{{ BASE_URL . 'admin/product-edit-' . $item->id }}">
                                    <button class="btn btn-warning ">Sửa</button>
                                </a>
                               
                                <a href="{{ BASE_URL . 'admin/product-delete/' . $item->id }}">
                                    <button class="btn btn-danger" style="margin-left: 2px"
                                        onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</button>
                                    </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="container text-center mb-5" >
        @for ($i = 1; $i <= $number; $i++)
            @if (isset($_GET['keyword']) && !empty($_GET['keyword']))
                <a href = "{{ BASE_URL . $_GET['url'] .'?keyword='.$_GET['keyword']. '&page=' . $i }}">
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
    {{-- <script>
        const category = document.getElementById('category');
        const categoryNameRegex = /[^a-zA-Z0-9\s]/g;
        const queryString = new URLSearchParams(location.search);
        const btn = document.getElementById('add');
        const check = document.getElementById('check').innerText;

        const page = queryString.get('Page');
        if (page != null || check != "") {
            if (check != "") {
                document.getElementById('error').innerHTML = "Danh mục đã tồn tại";
            }
            category.hidden = true;
            document.getElementById('addNew').hidden = true;
            document.getElementById('searchCategory').hidden = true;


        } else {
            document.getElementById('form').hidden = true;
        }


        function checkCategory() {
            const newCategory = document.getElementById('category_name').value;
            const check = categoryNameRegex.test(newCategory);
            console.log(check);
            if (newCategory == "") {
                document.getElementById('error').innerHTML = "Vui lòng nhập tên danh mục";
                return false
            } else if (categoryNameRegex.test(newCategory)) {
                document.getElementById('error').innerHTML = "Tên danh mục không hợp lệ";
                return false
            } else {
                document.getElementById('error').innerHTML = "";
                return true;
            }
            return false;
        }
    </script> --}}
@endsection
