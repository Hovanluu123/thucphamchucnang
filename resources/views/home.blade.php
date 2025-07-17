@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <header>
        <div class="header-top">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="logo">
                    <img src="https://via.placeholder.com/150x50?text=Logo" alt="Logo">
                </div>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-3" action="#">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <button class="btn btn-outline-primary me-2"><i class="fas fa-shopping-cart"></i> Giỏ hàng</button>
                    <button class="btn btn-outline-primary me-2"><i class="fas fa-user"></i> Tài khoản</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-warning"><i class="fas fa-cog"></i> Quản trị</a>
                </div>
            </div>
        </div>
        <nav class="header-bottom navbar navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100 justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sản phẩm
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($categories as $category)
                                    <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ưu đãi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="banner">
        <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1200x400?text=Banner+1" class="d-block w-100" alt="Banner 1">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400?text=Banner+2" class="d-block w-100" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400?text=Banner+3" class="d-block w-100" alt="Banner 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="offers py-5">
        <div class="container">
            <h2 class="text-center mb-4">Ưu đãi đặc biệt</h2>
            <div class="row">
                @foreach($offers as $offer)
                    <div class="col-md-4 mb-4">
                        <div class="card offer-card">
                            <img src="{{ $offer->image }}" class="card-img-top" alt="{{ $offer->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $offer->title }}</h5>
                                <p class="card-text">{{ $offer->description }}</p>
                                <a href="#" class="btn btn-primary">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="hot-products py-5">
        <div class="container">
            <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
            <div class="row">
                @if ($hotProducts->isEmpty())
                    <div class="col-12 text-center">
                        <p class="text-muted">Không có sản phẩm nổi bật nào để hiển thị.</p>
                    </div>
                @else
                    @foreach($hotProducts as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card product-card">
                                <img src="{{ $product->image ?? 'https://via.placeholder.com/200x200?text=Không+có+ảnh' }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                                    <button class="btn btn-primary quick-view-btn" data-bs-toggle="modal" data-bs-target="#productModal" data-id="{{ $product->id }}">Xem nhanh</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <footer class="footer text-center">
        <div class="container">
            <p>© 2025 Thực phẩm chức năng. All rights reserved.</p>
            <p>Liên hệ: contact@thucphamchucnang.vn | Hotline: 0123 456 789</p>
        </div>
    </footer>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Chi tiết sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="modalProductImage" src="" alt="Product Image">
                        </div>
                        <div class="col-md-6">
                            <h4 id="modalProductName"></h4>
                            <p id="modalProductPrice"></p>
                            <p id="modalProductDescription"></p>
                            <button class="btn btn-success">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.querySelectorAll('.quick-view-btn').forEach(button => {
            button.addEventListener('click', async () => {
                const productId = button.dataset.id;
                const response = await fetch('{{ route("quick-view", ":id") }}'.replace(':id', productId));
                const product = await response.json();
                document.getElementById('modalProductName').textContent = product.name;
                document.getElementById('modalProductPrice').textContent = product.price + ' VNĐ';
                document.getElementById('modalProductDescription').textContent = product.description;
                document.getElementById('modalProductImage').src = product.image;
            });
        });
    </script>
@endsection