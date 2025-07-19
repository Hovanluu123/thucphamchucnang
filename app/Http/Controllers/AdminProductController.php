<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'url', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only('name', 'price', 'category_id', 'description');
        // Xử lý upload file ảnh
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = uniqid('product_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = 'uploads/' . $filename;
        } else {
            $data['image'] = $request->input('image');
        }
        $data['is_hot'] = $request->input('is_hot', false);
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'url', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($id);
        $data = $request->only('name', 'price', 'category_id', 'description');
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = uniqid('product_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = 'uploads/' . $filename;
        } else {
            $data['image'] = $request->input('image', $product->image);
        }
        $data['is_hot'] = $request->input('is_hot', false);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
    }
}