<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Customer;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\Contracts\HasApiTokens;
class Order extends Model
{use  HasFactory, Notifiable;
    protected $fillable = ['order_status',
       'order_number',

            'customer_id' ,
            'order_date',
            'order_status',
            'customer_name',
             'customer_phone',
           'customer_email',
            'customer_email' ,
            'customer_address' ,
            'total' ,
            'order_items' ,

];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function customer(){


        return $this->belongsTo(Customer::class);
    }

}
