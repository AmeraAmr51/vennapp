@extends('layouts.front')

@section('title'){{clean( trans('niva-backend.our_videos') , array('Attr.EnableID' => true))}} @endsection
@section('meta') {{clean( trans('niva-backend.our_videos') , array('Attr.EnableID' => true))}} @endsection

@section('content')


    <div class="breadcrumb-area">
        <h1 class="breadcrumb-title">{{clean( trans('niva-backend.our_videos') , array('Attr.EnableID' => true))}}</h1>
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">{{clean( trans('niva-backend.home') , array('Attr.EnableID' => true))}}</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{clean( trans('niva-backend.our_videos') , array('Attr.EnableID' => true))}}</li>
        </ul>
    </div>

    <div class="portfolio-section-filters">
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="filters">
                        <h4>{{clean( trans('niva-backend.sort_by') , array('Attr.EnableID' => true))}}</h4>
                        <div class="filter active" data-filter="all"><span>{{clean( trans('niva-backend.all') , array('Attr.EnableID' => true))}}</span></div>
                        @foreach($videos as $video)
                            <div class="filter" data-filter="{{$video->name}}"><span>{{$video->name}}</span></div>
                        @endforeach
                    </div>
                </div>

{{--                <div class="col-md-9">--}}
{{--                    <div class="projects projects-page row">--}}

{{--                        @foreach($videos as $video)--}}
{{--                            <div class="project col-md-6" data-filter="{{$video->name}}">--}}
{{--                                <div class="project-inner">--}}
{{--                                    <div class="project-thumbnail">--}}
{{--                                        <a href="" title=""><img width="400" height="250" src="{{$video->image ? '/images/video/' . $video->image : '/img/200x200.png'}}"  class="img-fluid" alt="{{$video->name}}"></a>--}}
{{--                                    </div>--}}
{{--                                    <h4 class="entry-details-title">{{$video->descriptio}}</h4>--}}
{{--                                    <h5 class="project-category">{{$video->name}}</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-md-9">
                    <div class="projects projects-page row">

                        @foreach($videos as $video)
                            <div class="project col-md-6" data-filter="{{$video->name}}">
                                <div class="project-inner">
                                    <div class="project-thumbnail">
                                        <a href="{{url('/video-details/'.$video->id)}}" title=""><img width="400" height="250" src="{{$video->image ? '/images/video/' . $video->image : '/img/200x200.png'}}"  class="img-fluid" alt="{{$video->name}}"></a>
                                    </div>
                                    <h4 class="entry-details-title"> <a href="{{url('/video-details/'.$video->id)}}">{{$video->name}}</a></h4>
                                    <h5 class="project-category">{{strip_tags($video->description)}}</h5>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection





