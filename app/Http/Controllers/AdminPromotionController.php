<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminPromotionController extends Controller
{
    public function index(): View
    {
        $promotions = Promotion::orderByDesc('id')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create(): View
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:promotions,code',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $data['active'] = $request->has('active') ? 1 : 0;
        Promotion::create($data);
        return redirect()->route('admin.promotions.index')->with('success', 'Tạo khuyến mãi thành công!');
    }

    public function edit(int $id): View
    {
        $promotion = Promotion::findOrFail($id);
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $promotion = Promotion::findOrFail($id);
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:promotions,code,' . $promotion->id,
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $data['active'] = $request->has('active') ? 1 : 0;
        $promotion->update($data);
        return redirect()->route('admin.promotions.index')->with('success', 'Cập nhật khuyến mãi thành công!');
    }

    public function destroy(int $id): RedirectResponse
    {
        Promotion::findOrFail($id)->delete();
        return redirect()->route('admin.promotions.index')->with('success', 'Xóa khuyến mãi thành công!');
    }
} 