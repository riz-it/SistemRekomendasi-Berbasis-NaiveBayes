<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    protected $fillable = [
        'data_to',
        'stock_name',
        'first_stock',
        'stock_in',
        'stock_out',
        'last_stock'
    ];
    use HasFactory;
}
