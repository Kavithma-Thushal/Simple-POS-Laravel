<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    // Specify the table associated with the model
    protected $table = 'order_details';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Allow mass assignment for these fields
    protected $fillable = ['orderId', 'itemCode', 'buyQty', 'total'];

    // Timestamps are not required if you're not using created_at and updated_at
    public $timestamps = false;
}
