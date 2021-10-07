@extends('layouts.admin')

@section('content')

    @include('includes.tinyeditor')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{clean( trans('niva-backend.edit_video') , array('Attr.EnableID' => true))}}</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.create_video') , array('Attr.EnableID' => true))}}</h6>
            </div>
            <div class="card-body">

                <a href="{{route('page.index') . '?language=' . request()->input('language')}}" class="btn btn-primary btn-back">{{clean( trans('niva-backend.back_videos') , array('Attr.EnableID' => true))}}</a>

                @if ($message = Session::get('video_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif


                @include('includes.form-errors')

                <div class="row">

                    <div class="col-md-12">

                        <form action="{{route('video.update', $video->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('niva-backend.title') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="name" class="form-control" placeholder="" value="{{$video->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('niva-backend.link') , array('Attr.EnableID' => true))}}</strong>
                                                <div class="slug-container"><input type="text" name="video" class="form-control" placeholder="" value="{{$video->video}}"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <img class="img-fluid pb-4" width="100" height="100" src="{{$video->image ? '/public/images/video/' . $video->image : '/public/img/200x200.png'}}">
                                        <p><strong>{{clean( trans('niva-backend.photo') , array('Attr.EnableID' => true))}}</strong></p>
                                        <input type="file"  name="image" class="form-control-file"  id="photo_id">
                                    </div>

                                    <div class="form-group">
                                        <strong>{{clean( trans('niva-backend.body') , array('Attr.EnableID' => true))}}</strong>
                                        <textarea name="description" class="form-control" id="body" rows="5">{{clean( $video->description , array('Attr.EnableID' => true))}}</textarea>
                                    </div>

                                </div>




                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">{{clean( trans('niva-backend.update') , array('Attr.EnableID' => true))}}</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->




@endsection

