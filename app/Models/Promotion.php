<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'code', 'title', 'description', 'discount_amount', 'discount_percent', 'start_date', 'end_date', 'active'
    ];
} 