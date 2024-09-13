<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    // Specify the table associated with the model
    protected $table = 'order_details';

    // Define the primary key for the table
    protected $primaryKey = 'orderId';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Define the type of the primary key (string in this case)
    protected $keyType = 'string';

    // Allow mass assignment for these fields
    protected $fillable = ['orderId', 'itemCode', 'buyQty', 'total'];

    // Timestamps are not required if you're not using created_at and updated_at
    public $timestamps = false;
}
