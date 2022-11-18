<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceActivity extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function technical()
    {
        return $this->belongsTo(User::class, 'technical_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
