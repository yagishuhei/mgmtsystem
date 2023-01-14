<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'address',
        'ip',
        'dm_id',
        'customer',
        'place',
        'purpose',
        'memo',
        'status',
        'deleted_at',
    ];
}
