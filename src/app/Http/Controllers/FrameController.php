<?php

namespace DuyDev\Http\Controllers;

use Illuminate\Http\Request;
use DuyDev\Repositories\FramesRepository as Frame;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Slugify;

class FrameController extends Controller
{
    private $frame;

    /**
     * FrameController constructor.
     * @param $frame
     */
    public function __construct(Frame $frame)
    {
        $this->frame = $frame;
    }


    public function formCreate() {
        return view('forms.create_frame');
    }

    public function add(Request $req) {
        $input = $req->except('_token');
        $validator = Validator::make($input,[
            'title' => 'required|string|min:6|max:255',
            'description' => 'sometimes|nullable|string',
            'slug' => 'required|string|min:6|max:255|unique:frames',
            'picture' => 'required|file|image|mimes:png',
            'default_picture' => 'required|file|image|mimes:jpeg,png',
        ]);
        $validator->validate();

        $user_id = auth()->id();
        if( ! $user_id ) {
            abort(403);
        }

        $frame = $this->frame->create([
            'user_id' => $user_id,
            'title' => $input['title'],
            'description' => $input['description'],
            'slug' => $input['slug'],
            'picture' => '',
            'default_picture' => '',
        ]);

        if( $frame ) {
            $frame_name = "frame-$frame->id.".$req->file('picture')->getClientOriginalExtension();
            $default_name = "default-$frame->id.".$req->file('default_picture')->getClientOriginalExtension();
            $path_frame = $req->file('picture')->storeAs("user-$user_id", $frame_name, 'uploads');
            $path_default =  $req->file('default_picture')->storeAs("user-$user_id", $default_name, 'uploads');
            $frame->picture = $path_frame;
            $frame->default_picture = $path_default;
            $frame->save();
            return redirect()->route('show_frame', [$input['slug']])->with('success',true)->with('message','Thêm thành công.');
        }
        return redirect()->back()->with('success',false)->with('message','Gặp lỗi trong lúc lưu. Vui lòng thử lại.');
    }

    public function slug(Request $req) {
        $slug = '';
        if( $req->has('title') ) {
            $slug = Slugify::slugify($req->title);
            $_slug = $slug;
            $num = 0;
            while ( $this->frame->findBy('slug', $_slug) ) {
                $_slug = sprintf('%s_%s', $slug, $num);
                $num++;
            }
            $slug = $_slug;
        }
        return response()->json(compact('slug'));
    }

    public function showFrame($slug) {
        $frame = $this->frame->findBy('slug', $slug);
        if( ! $frame ){
            abort(404);
        }

        $frame->view++;
        $frame->save();

        return view('pages.show_frame', compact('frame'));
    }

    public function processImage($slug, Request $req) {
        $frame = $this->frame->findBy('slug', $slug);
        if( ! $frame ) {
            return response()->json(['success'=>false,'message'=>'Không tồn tại khung này.']);
        }

        $frame->count++;
        $frame->save();

        $input = $req->except('_token');
        $validator = Validator::make($input,[
            'image' => 'required|file|image|mimes:png'
        ]);

        if( $validator->fails() ) {
            return response()->json(['success'=>false,'message'=> $validator->getMessageBag()->first('image') ]);
        }

        $cropped_image = imagecreatefrompng( $req->file('image')->getRealPath() );
        $frame_image = imagecreatefrompng( $frame->realpath() );
        if( $cropped_image && $frame_image ) {
            $oW = imagesx( $frame_image );
            $oH = imagesy( $frame_image );
            $merge_image = imagecreatetruecolor( $oW, $oH );
            imagecopyresized( $merge_image, $cropped_image, 0, 0, 0, 0, $oW, $oH, imagesx( $cropped_image ), imagesy( $cropped_image ) );
            imagecopy( $merge_image, $frame_image, 0, 0, 0, 0, $oW, $oH );
            ob_start();
            imagepng($merge_image);
            $image_data = sprintf('data:image/png;base64,%s', base64_encode( ob_get_clean() ));
            imagedestroy( $merge_image );
            imagedestroy( $cropped_image );
            imagedestroy( $frame_image );
            return response()->json(['success'=>true,'message'=>'Tạo thành công.','image'=>$image_data]);
        }

        return response()->json(['success'=>false,'message'=>'Lỗi trong quá trình xử lý ảnh.']);
    }

    public function delete($slug){
        $frame = $this->frame->findBy('slug', $slug);
        if( ! $frame ) {
            return redirect()->back()->with('success',false)->with('message','Khung này không tồn tại.');
        }

        $this->frame->delete($frame->id);
        return redirect()->back()->with('success',true)->with('message','Xóa thành công.');
    }

}
