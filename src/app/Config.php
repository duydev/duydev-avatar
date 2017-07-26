<?php

namespace DuyDev;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'key', 'value'
    ];
    public $timestamps = false;
}
