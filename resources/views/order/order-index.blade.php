@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{clean( trans('niva-backend.all_orders') , array('Attr.EnableID' => true))}}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.all_orders') , array('Attr.EnableID' => true))}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="row">

                    <div class="col-lg-6 text-right">
                        @if (!empty($langs))
                        <select name="language" class="form-control language-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>{{clean( trans('niva-backend.select_language') , array('Attr.EnableID' => true))}}</option>
                            @foreach ($langs as $lang)
                            <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>


                @if ($message = Session::get('video_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif


                <form action="{{route('delete.order')}}" method="POST" class="form-inline">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <select name="checkbox_array" id="" class="form-control">
                            <option value="">{{clean( trans('niva-backend.delete') , array('Attr.EnableID' => true))}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="delete_all" class="btn btn-primary">
                    </div>



                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="options"></th>
                            <th scope="col">{{clean( trans('niva-backend.username') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.phone') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.email') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.city') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.video') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.status') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.action') , array('Attr.EnableID' => true))}}</th>
                        </tr>
                        </thead>
                        <!--<tfoot>
                        <tr>
                            <th><input type="checkbox" id="options1"></th>
                            <th scope="col">{{clean( trans('niva-backend.username') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.phone') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.email') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.city') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.video') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.status') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('niva-backend.action') , array('Attr.EnableID' => true))}}</th>
                        </tr>
                        </tfoot>-->
                        <tbody>
                        @if($orders)
                        @foreach($orders as $order)
                        <tr>
                            <td><input class="checkboxes" type="checkbox" name="checkbox_array[]" value="{{$order->id}}"></td>
                            <td class="page-title" >{{$order->user ? $order->user->name : '-'}}</td>
                            <td class="page-title" >{{$order->user ? $order->user->phone : '-'}} </td>
                            <td class="body-project" >{{$order->user ? $order->user->email : '-'}} </td>
                            <td class="body-project" >{{$order->user ? $order->user->city : '-'}} </td>
                            <td class="body-project" >{{$order ? $order->video->name : '-'}} </td>
                            <td class="body-project" >{{$order ? $order->status : '-'}} </td>
                            <td>
                                <form class="btn-group" action="{{route('approve',$order->id)}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success btn-mini">Accepted</button>
                                </form>

                                <form class="btn-group" action="{{route('reject',$order->id)}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-mini">Rejected</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif



                        </tbody>
                    </table>

                </form>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@stop

