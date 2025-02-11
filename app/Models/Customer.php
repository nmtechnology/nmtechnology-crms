<?php
// filepath: /app/Models/Customer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date_time_added', 'poc_email', 'phone_number'];

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}