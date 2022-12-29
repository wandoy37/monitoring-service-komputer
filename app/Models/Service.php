<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function technical()
    {
        return $this->belongsTo(User::class, 'technical_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(ServiceActivity::class);
    }

    public function additionals()
    {
        return $this->hasMany(AdditionalItems::class);
    }

    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
}