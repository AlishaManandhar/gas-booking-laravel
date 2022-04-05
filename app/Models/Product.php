<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image','status'];


    public function toggleStatus()
    {
        $this->status == "active" ? $this->update(['status' => 'inactive']) : $this->update(['status' => 'active']);
    }
}
