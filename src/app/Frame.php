<?php

namespace DuyDev;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $fillable = [
        'title', 'description', 'slug', 'count', 'view', 'active', 'user_id', 'picture', 'default_picture',
    ];

    public function user() {
        return $this->belongsTo('DuyDev\User');
    }
}
