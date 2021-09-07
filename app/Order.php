<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    const  STATUS_TYPES = [
        [
            'code' => '0',
            'name' => 'новый'
        ],
        [
            'code' => '10',
            'name' => 'подтвержден'
        ],
        [
            'code' => '20',
            'name' => 'завершен'
        ],

    ];
    protected $fillable = [
        'status',
        'client_email',
        'partner_id',
        'delivery_dt'
    ];

    public static function getStatusName($code)
    {
        $name = '';
        switch ($code) {
            case 0:
                $name = 'новый';
                break;
            case 10:
                $name = 'подтвержден';
                break;
            case 20:
                $name = 'завершен';
                break;
        }
        return $name;
    }

    public static function getTotal($order)
    {
        $total = 0;

        foreach ($order->products as $product) {
            $total += $product->pivot->quantity * $product->price;
        }

        return $total;
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity');
    }

}
