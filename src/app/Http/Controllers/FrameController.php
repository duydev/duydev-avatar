<?php

namespace DuyDev\Http\Controllers;

use Illuminate\Http\Request;
use DuyDev\Repositories\FramesRepository as Frame;
use Illuminate\Support\Facades\Validator;

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
            $path_frame = $req->file('picture')->storeAs("user-$user_id", "frame-$frame->id", 'uploads');
            $path_default =  $req->file('picture')->storeAs("user-$user_id", "default-$frame->id", 'uploads');
            $frame->picture = $path_frame;
            $frame->default_picture = $path_default;
            $frame->save();
            return redirect()->back()->with('success',true)->with('message','Thêm thành công.');
        }
        return redirect()->back()->with('success',false)->with('message','Gặp lỗi trong lúc lưu. Vui lòng thử lại.');
    }
}
