<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'discount',
        'total_price'
    ];

    public function transactionProducts()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
