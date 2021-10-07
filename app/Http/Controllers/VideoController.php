<?php
namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\ProjectSetting;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\VideoRequest;
use App\Http\Requests\VideoEditRequest;
use App\Models\HeaderFooterSetting;
use App\Models\Setting;
use DB;
use Illuminate\Support\Facades\Auth;
use View;
use App\Models\Language;


class VideoController extends Controller
{
    public function index(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['videos'] = Video::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);
//        $data['video'] = Video::findOrFail($lang->id);
//        dd($data['video']);
        $data['lang_id'] = $lang_id;
        return view('video.video-index', $data, compact('langs'));
    }


    public function create(Request $request)
    {

        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;

        return view('video.video-create', compact('langs', 'lang_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {


        $input = $request->all();
        $user = Auth::user();

        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/video/', $name);
            $photo = Video::create(['image'=>$name]+ $input);
            $input['image'] = $photo;
        }

        return back()->with('video_success','Video created successfully!');
    }



    public function edit(Video $video)
    {
        return view('video.video-edit',compact('video'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(VideoEditRequest $request, Video $video)
    {
        $input = $request->all();

        if ($file = $request->file('image')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images/video/', $name);

            $photo = Video::create(['image'=>$name]);

            $input['image'] = $photo->image;
        }

        $video->update($input);

        return back()->with('video_success','Video updated successfully!');
    }

    public function delete_video(Request $request, Video $video) {
        if(isset($request->delete_all) && !empty($request->checkbox_array)) {
            $videos = Video::findOrFail($request->checkbox_array);
            foreach ($videos as $video) {
                $video->delete();
            }
            return back()->with('videos_success','Video/s deleted successfully!');
        } else {
            return back();
        }

        $videos = Video::findOrFail($request->checkbox_array);
        foreach ($videos as $video) {
            $video->delete();
        }

        return back();
        //return 'works';
    }


}
