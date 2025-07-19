@extends('layouts.app')
@section('title', 'Quản lý khuyến mãi')
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
    <h2 class="mb-4">Quản lý khuyến mãi</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-success mb-3">Thêm khuyến mãi</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Mã</th>
                    <th>Tên chương trình</th>
                    <th>Mô tả</th>
                    <th>Tiền giảm</th>
                    <th>% giảm</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotions as $promo)
                    <tr>
                        <td>{{ $promo->id }}</td>
                        <td>{{ $promo->code }}</td>
                        <td>{{ $promo->title }}</td>
                        <td>{{ $promo->description }}</td>
                        <td>{{ $promo->discount_amount ? number_format($promo->discount_amount, 0, ',', '.') . ' VNĐ' : '-' }}</td>
                        <td>{{ $promo->discount_percent ? $promo->discount_percent . '%' : '-' }}</td>
                        <td>{{ $promo->start_date }}</td>
                        <td>{{ $promo->end_date }}</td>
                        <td>
                            @if($promo->active)
                                <span class="badge bg-success">Kích hoạt</span>
                            @else
                                <span class="badge bg-secondary">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.promotions.edit', $promo->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                            <form action="{{ route('admin.promotions.destroy', $promo->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa khuyến mãi này?')">
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
@endsection 