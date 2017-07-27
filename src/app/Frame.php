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

    public function picture() {
        return asset("uploads/$this->picture");
    }

    public function default_picture() {
        return asset("uploads/$this->default_picture");
    }

}
