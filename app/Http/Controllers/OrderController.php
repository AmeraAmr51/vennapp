<?php
namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Order;
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


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['orders'] = Order::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        $data['lang_id'] = $lang_id;
        return view('order.order-index', $data, compact('langs'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\video  $video
     * @return \Illuminate\Http\Response
     */

    public function delete_order(Request $request, Video $video) {
        if(isset($request->delete_all) && !empty($request->checkbox_array)) {
            $orders = Order::findOrFail($request->checkbox_array);
            foreach ($orders as $order) {
                $order->delete();
            }
            return back()->with('orders_success','Order/s deleted successfully!');
        } else {
            return back();
        }
    }

    public function approve(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where(['id'=>$id])->update(['status'=> 'ACCEPTED']);
            return back()->with('flash_message_success','Order Status Updated Successfully!!!');
        }
    }

    public function reject(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where(['id'=>$id])->update(['status'=> 'REJECTED']);
            return back()->with('flash_message_success','Order Status Updated Successfully!!!');
        }
    }


}
