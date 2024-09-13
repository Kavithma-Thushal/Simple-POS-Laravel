<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Specify the table associated with the model
    protected $table = 'customers';

    // Define the primary key for the table
    protected $primaryKey = 'id';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Define the type of the primary key (string in this case)
    protected $keyType = 'string';

    // Allow mass assignment for these fields
    protected $fillable = ['id', 'name', 'address', 'salary'];

    // Timestamps are not required if you're not using created_at and updated_at
    public $timestamps = false;

    // One-to-Many relationship: A customer has many orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'customerId', 'id');
    }
}
