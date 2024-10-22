<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status', 'shipping_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function updateTotals()
    {
        $total = $this->orderItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Agregamos el shipping_cost si existe
        if ($this->shipping_cost) {
            $total += $this->shipping_cost;
        }

        $this->total_price = $total;
        $this->save();
    }
}
