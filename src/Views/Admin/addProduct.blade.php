@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="">Thêm Sản Phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="product_name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Giá Sản Phẩm(Giá Gốc)</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="product_price">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Giá Sản Phẩm(Giá Khuyến Mãi)</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="discounted_price">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Danh Mục Sản Phẩm</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Mô Tả Sản Phẩm</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="product_describe"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Ảnh Đại Diện Sản Phẩm</label>
                        <input type="file" class="form-control" id="exampleFormControlInput1" name="product_image">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Ảnh Sản Phẩm</label>
                        <input class="form-control" type="file" id="formFileMultiple" name="product_images[]" multiple
                            accept="image/*">
                        {{-- <input type="file" class="form-control" id="image" name="image" multiple>
                        <input type="text" class="form-control" id="images" name="product_images"  hidden> --}}
                    </div>
                    <div class="mb-3">
                        <div id="variants-container">
                            <div class="variant">
                                <label for="size">
                                    <h5>Kích Thước</h5>
                                </label>
                                <input class="form-control mb-3" type="text" aria-label="default input example"
                                    placeholder="size" name="size[]" required>
                                <!-- <input type="text" name="size[]" required><br><br> -->

                                <label for="variantQuantity">
                                    <h5>Số Lượng</h5>
                                </label>
                                <input class="form-control" type="text" aria-label="default input example"
                                    placeholder="quantity" name="variantQuantity[]" required> <br>
                                <!-- <input type="number" name="variantQuantity[]" required><br><br> -->
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="add-variant">Thêm biến thể</button> <br><br><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md3">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <a href="{{ BASE_URL . 'admin/products' }}"><button type="button" class="btn btn-primary">Danh
                            Sách</button></a>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementById("add-variant").addEventListener("click", function() {
            var variantsContainer = document.getElementById("variants-container");
            var newVariant = document.querySelector(".variant").cloneNode(true);
            variantsContainer.appendChild(newVariant);
        })
    </script>
@endsection
