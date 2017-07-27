<?php

namespace DuyDev;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fb_id', 'fb_token', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('DuyDev\Role');
    }

    public function frames() {
        return $this->hasMany('DuyDev\Frame');
    }

    public function avatar() {
        $url = '';
        if( $this->fb_id ) {
            $url = "http://graph.facebook.com/$this->fb_id/picture?type=square";
        }
        return $url;
    }
}
