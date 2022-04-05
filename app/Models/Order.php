<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','product_id','quantity','total','status','location'];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function cancelOrder()
    {
        if ($this->status == 'pending' || $this->status == 'processing') {
            $this->status = 'cancelled';
            $this->save();
        }
    }

    public function changeOrderStatus()
    {
        if($this->status == 'pending') {
            $this->status = 'processing';
        }
        elseif($this->status == 'processing') {
            $this->status = 'completed';
        }
        $this->save();
    }
}

