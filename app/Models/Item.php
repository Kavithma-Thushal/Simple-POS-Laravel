<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Specify the table associated with the model
    protected $table = 'items';

    // Define the primary key for the table
    protected $primaryKey = 'code';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Define the type of the primary key (string in this case)
    protected $keyType = 'string';

    // Allow mass assignment for these fields
    protected $fillable = ['code', 'description', 'unitPrice', 'qtyOnHand'];

    // Timestamps are not required if you're not using created_at and updated_at
    public $timestamps = false;

    // Many-to-Many relationship: An item belongs to many orders
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'itemCode', 'orderId')
            ->withPivot('buyQty', 'total');
    }
}
