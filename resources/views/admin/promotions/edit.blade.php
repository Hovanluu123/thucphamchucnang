@extends('layouts.app')
@section('title', 'Chỉnh sửa khuyến mãi')
@section('content')
<div class="sidebar">
    <h4 class="text-center">Admin Panel</h4>
    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Trang chủ</a>
    <a href="{{ route('admin.products.index') }}"><i class="fas fa-box"></i> Quản lý sản phẩm</a>
    <a href="{{ route('admin.promotions.index') }}" class="active"><i class="fas fa-gift"></i> Quản lý khuyến mãi</a>
    <a href="#"><i class="fas fa-shopping-cart"></i> Quản lý đơn hàng</a>
    <a href="#"><i class="fas fa-list"></i> Quản lý danh mục</a>
    <a href="#"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
</div>
<div class="main-content">
    <h2 class="mb-4">Chỉnh sửa khuyến mãi</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Mã giảm giá</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $promotion->code) }}" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Tên chương trình</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $promotion->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $promotion->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="discount_amount" class="form-label">Số tiền giảm (VNĐ)</label>
            <input type="number" class="form-control" id="discount_amount" name="discount_amount" value="{{ old('discount_amount', $promotion->discount_amount) }}">
        </div>
        <div class="mb-3">
            <label for="discount_percent" class="form-label">Phần trăm giảm (%)</label>
            <input type="number" class="form-control" id="discount_percent" name="discount_percent" value="{{ old('discount_percent', $promotion->discount_percent) }}" min="0" max="100">
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Ngày bắt đầu</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $promotion->start_date) }}">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Ngày kết thúc</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $promotion->end_date) }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ old('active', $promotion->active) ? 'checked' : '' }}>
            <label class="form-check-label" for="active">Kích hoạt</label>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection 