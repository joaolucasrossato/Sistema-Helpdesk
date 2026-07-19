<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [

        'title',

        'description',

        'priority',

        'status',

        'category_id',

        'user_id',

        'technician_id'

    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function technician()
{
    return $this->belongsTo(User::class, 'technician_id');
}
}

