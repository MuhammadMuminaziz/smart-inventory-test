<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function updateStock($type, $qty)
    {
        if ($type == TransactionType::IN) {
            $this->stock = $this->stock + $qty;
        } else {
            if ($this->stock == 0) return false;
            if ($this->stock < $qty) return false;
            $this->stock = $this->stock - $qty;
        }

        $this->save();
        return true;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
