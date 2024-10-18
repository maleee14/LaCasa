<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $fillable = [
        'property_id',
        'agent_name',
        'user_id',
        'name',
        'email',
        'phone',
    ];
}
