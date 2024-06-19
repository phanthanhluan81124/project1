
<div class="sidebar" id="search">
    <div class="sidebar-header">
        Search
        <button data-sidebar-close>
            <i class="bi bi-arrow-right"></i>
        </button>
    </div>
    <div class="sidebar-content">
        <form class="mb-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" aria-describedby="button-search-addon">
                <button class="btn btn-outline-light" type="button" id="button-search-addon">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <h6 class="mb-3">Last searched</h6>
        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="avatar avatar-sm me-3">
                    <span class="avatar-text rounded-circle">
                        <i class="bi bi-search"></i>
                    </span>
                </a>
                <a href="#" class="flex-fill">Reports for 2021</a>
                <a href="#" class="btn text-danger btn-sm" data-bs-toggle="tooltip" title="Remove">
                    <i class="bi bi-x"></i>
                </a>
            </div>
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="avatar avatar-sm me-3">
                    <span class="avatar-text rounded-circle">
                        <i class="bi bi-search"></i>
                    </span>
                </a>
                <a href="#" class="flex-fill">Current users</a>
                <a href="#" class="btn" data-bs-toggle="tooltip" title="Remove">
                    <i class="bi bi-x"></i>
                </a>
            </div>
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="avatar avatar-sm me-3">
                    <span class="avatar-text rounded-circle">
                        <i class="bi bi-search"></i>
                    </span>
                </a>
                <a href="#" class="flex-fill">Meeting notes</a>
                <a href="#" class="btn" data-bs-toggle="tooltip" title="Remove">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </div>
        <h6 class="mb-3">Recently viewed</h6>
        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="avatar avatar-secondary avatar-sm me-3">
                    <span class="avatar-text rounded-circle">
                        <i class="bi bi-check-circle"></i>
                    </span>
                </a>
                <a href="#" class="flex-fill">Todo list</a>
                <a href="#" class="btn" data-bs-toggle="tooltip" title="Remove">
                    <i class="bi bi-x"></i>
                </a>
            </div>
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="avatar avatar-warning avatar-sm me-3">
                    <span class="avatar-text rounded-circle">
                        <i class="bi bi-wallet2"></i>
                    </span>
                </a>
                <a href="#" class="flex-fill">Pricing table</a>
                <a href="#" class="btn" data-bs-toggle="tooltip" title="Remove">
                    <i class="bi bi-x"></i>
                </a>
            </div>
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="avatar avatar-info avatar-sm me-3">
                    <span class="avatar-text rounded-circle">
                        <i class="bi bi-gear"></i>
                    </span>
                </a>
                <a href="#" class="flex-fill">Settings</a>
                <a href="#" class="btn" data-bs-toggle="tooltip" title="Remove">
                    <i class="bi bi-x"></i>
                </a>
            </div>
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="avatar avatar-success avatar-sm me-3">
                    <span class="avatar-text rounded-circle">
                        <i class="bi bi-person-circle"></i>
                    </span>
                </a>
                <a href="#" class="flex-fill">Users</a>
                <a href="#" class="btn" data-bs-toggle="tooltip" title="Remove">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-action">
        <a href="#" class="btn btn-danger">All Clear</a>
    </div>
</div>
<!-- ../ search sidebar -->

<!-- ../ sidebars -->

<!-- menu -->
<div class="menu">
    {{-- <div class="menu-header" style="background-color:#004dda; margin: 20px ; border-radius:20px">
        <a href="{{ BASE_URL . 'admin' }}" class="menu-header-logo ">
            <img src="../assets/img/logo.svg" alt="logo" style="margin-left: 80px">
        </a>
        <a href="{{ BASE_URL . 'admin' }}" class="btn btn-sm menu-close-btn">
            <i class="bi bi-x"></i>
        </a>
    </div> --}}
    <div class="menu-body mt-3" >
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown">
                <div class="avatar me-3">
                    <img src="{{BASE_URL .'upload/'.$_SESSION['user'][0]->avatar}}" class="rounded-circle" alt="avt">
                </div>
                <div>
                    <div class="fw-bold">{{$_SESSION['user'][0]->fullname}}</div>
                    <small class="text-muted">{{$_SESSION['user'][0]->role}}</small>
                </div>
            </a>
            {{-- <div class="dropdown-menu dropdown-menu-end">
                <a href="#" class="dropdown-item d-flex align-items-center">
                    <i class="bi bi-person dropdown-item-icon"></i> Thông tin tài khoản
                </a>
                <a href="login.html" class="dropdown-item d-flex align-items-center text-danger" target="_blank">
                    <i class="bi bi-box-arrow-right dropdown-item-icon"></i> Đăng xuất
                </a>
            </div> --}}
        </div>
        <ul>
            <li class="menu-divider">E-Commerce</li>
            <li>
                <a class="active" href="{{ BASE_URL . 'admin' }}">
                    <span class="nav-link-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ BASE_URL . 'admin/category' }}">
                    <span class="nav-link-icon">
                        <img src="{{ BASE_URL . 'upload/icons8-category-50.png' }}" alt="" width="30px">
                    </span>
                    <span>Danh Mục</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-receipt"></i>
                    </span>
                    <span>Đơn Hàng</span>
                </a>
                <ul>
                    <li>
                        <a href="{{BASE_URL . 'admin/orders'}}">Danh Sách Đơn Hàng</a>
                    </li>
                    <li>
                        <a href="{{BASE_URL . 'admin/orders-today'}}">Danh Sách Đơn Hàng Hôm Nay</a>
                    </li>
                    <li>
                        <a href="{{BASE_URL . 'admin/orders-pending'}}">Danh Sách Đơn Hàng Chờ Xử Lý</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-truck"></i>
                    </span>
                    <span>Sản Phẩm</span>
                </a>
                <ul>
                    <li>
                        <a href="{{BASE_URL . 'admin/products'}}">Danh Sách Sản Phẩm</a>
                    </li>
                    <li>
                        <a href="{{BASE_URL . 'admin/product-add'}}">Thêm Mới Sản Phẩm</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="menu-divider">Trang</li> --}}
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-person-circle"></i>
                    </span>
                    <span>Tài Khoản</span>
                </a>
                <ul>
                    <li><a href="{{BASE_URL . 'admin/accounts'}}">Danh Sách Tài Khoản</a></li>
                    <li><a href="{{BASE_URL . 'admin/accounts-add'}}">Thêm Mới Tài Khoản</a></li>
                </ul>
            </li>
            <li>
                <a href="{{BASE_URL . 'admin/list-bill-payment'}}">
                    <span class="nav-link-icon">
                        <i class="bi bi-person-circle"></i>
                    </span>
                    <span>Hóa Đơn</span>
                </a>

            </li>
            <li>
                <a href="{{BASE_URL . 'admin/list-voucher'}}">
                    <span class="nav-link-icon">
                        <i class="bi bi-person-circle"></i>
                    </span>
                    <span>Mã Giảm Giá</span>
                </a>
            </li>
            {{-- <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-lock"></i>
                    </span>
                    <span>Authentication</span>
                </a>
                <ul>
                    <li>
                        <a href="login.html" target="_blank">Login</a>
                    </li>
                    <li>
                        <a href="register.html" target="_blank">Register</a>
                    </li>
                    <li>
                        <a href="reset-password.html" target="_blank">Reset Password</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="settings.html">
                    <span class="nav-link-icon">
                        <i class="bi bi-gear"></i>
                    </span>
                    <span>Settings</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
<!-- ../  menu -->

<!-- layout-wrapper -->
<!-- ../ Header mobile buttons -->
</div>
