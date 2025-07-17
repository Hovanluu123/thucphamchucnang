<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'description', 'image', 'is_hot'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}