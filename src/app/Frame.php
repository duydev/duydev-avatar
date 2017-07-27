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

    public function realpath() {
        return public_path("uploads/$this->picture");
    }

    public function permalink() {
        return route('show_frame', [$this->slug]);
    }

    public function thumbnail() {
        $user_id = $this->user_id;
        $thumb_path = public_path("uploads/user-$user_id/thumb-$this->id.png");
        if( ! file_exists( $thumb_path ) ) {
            $thumb = imagecreatetruecolor( 300, 300 );
            $frame = imagecreatefrompng($this->realpath());
            $default_path = public_path("uploads/$this->default_picture");
            $ext = pathinfo( $default_path , PATHINFO_EXTENSION);
            if( $ext == 'jpg' ) {
                $default = imagecreatefromjpeg( $default_path );
            } else {
                $default = imagecreatefrompng( $default_path );
            }
            imagecopyresized( $thumb, $default, 0,0,0,0,300,300,imagesx($default),imagesy($default) );
            imagecopyresized( $thumb, $frame, 0,0,0,0,300,300,imagesx($frame),imagesy($frame) );
            imagepng($thumb, $thumb_path);
            imagedestroy($thumb);
            imagedestroy($default);
            imagedestroy($frame);
        }
        return asset("uploads/user-$user_id/thumb-$this->id.png");
    }

    public function removeImages() {
        $user_id = $this->user_id;
        $thumb_path = public_path("uploads/user-$user_id/thumb-$this->id.png");
        $default_path = public_path("uploads/$this->default_picture");
        unlink($thumb_path);
        unlink($this->realpath());
        unlink($default_path);
    }

}
