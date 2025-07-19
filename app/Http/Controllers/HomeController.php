<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        $offers = Offer::all();
        return view('home', compact('categories', 'products', 'offers'));
    }

    public function quickView(int $id): JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => number_format($product->price, 0, ',', '.'),
            'description' => $product->description ?? 'Không có mô tả',
            'image' => $product->image,
            'category' => $product->category->name ?? 'Chưa phân loại',
        ]);
    }
}