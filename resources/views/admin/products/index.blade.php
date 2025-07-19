@extends('layouts.app')
@section('title', 'Quản lý sản phẩm')
@section('content')
    <div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Trang chủ</a>
        <a href="{{ route('admin.products.index') }}" class="active"><i class="fas fa-box"></i> Quản lý sản phẩm</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Quản lý đơn hàng</a>
        <a href="#"><i class="fas fa-list"></i> Quản lý danh mục</a>
        <a href="{{ route('admin.promotions.index') }}"><i class="fas fa-gift"></i> Quản lý khuyến mãi</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="main-content">
        <h2 class="mb-4">Quản lý sản phẩm</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="btn btn-success btn-add-product" data-bs-toggle="modal" data-bs-target="#productModal">Thêm sản phẩm</button>
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Danh mục</th>
                        <th>Ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                            <td>{{ $product->category->name }}</td>
                            <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="height: 180px; width: auto; object-fit: cover;"></td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="productName" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="productName" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Giá (VNĐ)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="productPrice" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Danh mục</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="productCategory" name="category_id" required>
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="productDescription" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productImageFile" class="form-label">Upload ảnh</label>
                            <input type="file" class="form-control" id="productImageFile" name="image_file" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">URL ảnh (nếu không upload)</label>
                            <input type="url" class="form-control @error('image') is-invalid @enderror" id="productImage" name="image" value="{{ old('image') }}">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection