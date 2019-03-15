<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopOrderExpress extends Model
{

    //
    protected $table = "shop_order_express";

    const CREATED_AT = 'add_time';
    const UPDATED_AT = 'update_time';

    public function shopOrder()
    {

        return $this->belongsTo(ShopOrder::class, 'order_id', 'id');
    }
}
