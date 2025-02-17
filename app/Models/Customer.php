<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',
        'date_time_added',
        'poc_email',
        'phone_number',
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'date_time_added' => 'datetime',
    ];

    // Define the relationship with the WorkOrder model
    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}