<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $tabel = 'properties';
    protected $fillable = [
        'title',
        'price',
        'image',
        'beds',
        'bath',
        'area_sqft',
        'home_type',
        'year_built',
        'price_sqft',
        'more_info',
        'location',
        'city',
        'agent_name',
        'type',
    ];
}
