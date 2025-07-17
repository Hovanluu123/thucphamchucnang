<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Thực phẩm chức năng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
 
    <style>
        .header-top { background-color: #f8f9fa; padding: 10px 0; }
        .header-bottom { background-color: #28a745; }
        .header-bottom .nav-link { color: white; }
        .header-bottom .nav-link:hover { color: #f8f9fa; }
        .dropdown-menu { background-color: #28a745; }
        .dropdown-menu .dropdown-item { color: white; }
        .dropdown-menu .dropdown-item:hover { background-color: #218838; }
        .carousel-item img { width: 100%; height: 400px; object-fit: cover; }
        .offer-card img { height: 150px; object-fit: cover; }
        .product-card { transition: transform 0.3s; }
        .product-card:hover { transform: scale(1.05); }
        .product-card img { height: 200px; object-fit: cover; }
        .quick-view-btn { display: none; position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); }
        .product-card:hover .quick-view-btn { display: block; }
        .modal-body img { width: 100%; height: 300px; object-fit: cover; }
        .footer { background-color: #343a40; color: white; padding: 20px 0; }
        .sidebar { width: 250px; background-color: #343a40; color: white; padding: 20px; position: fixed; height: 100%; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; margin: 5px 0; }
        .sidebar a:hover { background-color: #495057; border-radius: 5px; }
        .main-content { margin-left: 250px; padding: 20px; width: calc(100% - 250px); }
        .product-table img { width: 50px; height: 50px; object-fit: cover; }
    </style>
    @yield('styles')
</head>
<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>