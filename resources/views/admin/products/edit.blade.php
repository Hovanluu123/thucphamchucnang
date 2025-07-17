@extends('layouts.app')
@section('title', 'Chỉnh sửa sản phẩm')
@section('content')
    <div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Trang chủ</a>
        <a href="{{ route('admin.products.index') }}" class="active"><i class="fas fa-box"></i> Quản lý sản phẩm</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Quản lý đơn hàng</a>
        <a href="#"><i class="fas fa-list"></i> Quản lý danh mục</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="main-content">
        <h2 class="mb-4">Chỉnh sửa sản phẩm</h2>
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
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="productName" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="productName" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá (VNĐ)</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="productPrice" name="price" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh mục</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="productCategory" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô tả</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="productDescription" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">URL ảnh</label>
                <input type="url" class="form-control @error('image') is-invalid @enderror" id="productImage" name="image" value="{{ old('image', $product->image) }}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection