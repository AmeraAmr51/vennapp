@extends('layouts.front')

@section('title'){{clean( trans('niva-backend.our_videos') , array('Attr.EnableID' => true))}} @endsection
@section('meta') {{clean( trans('niva-backend.our_videos') , array('Attr.EnableID' => true))}} @endsection

@section('styles')
    <link href="{{ asset('css/front/magnific.min.css')}}" type="text/css" rel="stylesheet">
@endsection

@section('content')

    <div class="breadcrumb-area">
        <h1 class="breadcrumb-title">{{clean( trans('niva-backend.our_videos') , array('Attr.EnableID' => true))}}</h1>
    </div>

    <div class="project-content vd-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="post-name">{{$video->name}}</h2>
                    <span class="venor-animate-border"></span>
                    {!!$video->description!!}
                </div>
                <div class="col-md-12">
                    <h4 class="post-name">{{clean( trans('niva-backend.promo_video') , array('Attr.EnableID' => true))}}</h4>
                    <span class="venor-animate-border"></span>

                    {!! $video->video !!}
                </div>
            </div>

            <div class="addd-order">
                <a style="color: whitesmoke" data-id="{{$video->id}}" data-toggle="modal" data-target="#report" class="report btn btn-primary btn-back" id="open">
                    Add Order
                </a>
            </div>
        </div>

    </div>
    <div class="project-content slider-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="post-name">Recomended Videos</h2>
                    <span class="venor-animate-border"></span>
                </div>
                <!--- Slider --->
                <div class="col-md-12">
                    <div class="slider">
                        <div class="slick">
                            <div>your content 1</div>
                            <div>your content 2</div>
                            <div>your content 3</div>
                            <div>your content 4</div>
                            <div>your content 5</div>
                            <div>your content 6</div>
                        </div>
                        <div class='slick-prevz'><i class="arrow left"></i></div>
                        <div class='slick-nextz'><i class="arrow right"></i></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--
{{--                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="open">Open Modal</button>--}}-->



            @include('orderModal')
<!--
{{--            <div class="gallery">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-md-6">--}}
{{--                        <div class="featured-image">--}}
{{--                            <a href="{{$video->image}}">--}}
{{--                                <img class="img-fluid lazy" src="/public/img/loading-blog.gif" data-src="{{$project->img_gal1}}">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <div class="featured-image">--}}
{{--                            <a href="{{$video->image}}">--}}
{{--                                <img class="img-fluid lazy" src="/public/img/loading-blog.gif" data-src="{{$project->img_gal2}}">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <div class="featured-image">--}}
{{--                            <a href="{{$video->img_gal3}}">--}}
{{--                                <img class="img-fluid lazy" src="/public/img/loading-blog.gif" data-src="{{$project->img_gal3}}">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            --}}

            </div>

        </div>-->





@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        jQuery(document).on('click','#open',function(e) {
            var video_id = $(this).data('id')
            $('#video_id').val(video_id)
        })
    </script>
    <script>
        jQuery(document).on('submit','.ajaxSubmit',function(e){
            e.preventDefault()
            var url = $(this).attr('action')

            jQuery('.alert-danger').hide();
            // $('#open').hide();
            // $('#report').modal('hide');
            $.ajax({
                url: url,
                method: 'post',
                data: new FormData($(this)[0]),
                _token: '{{csrf_token()}}',
                dataType:'json',
                processData: false,
                contentType: false,
                {{--success                    : function (response) {--}}
                {{--    toastr                 .success('{{__('web.created_successfully')}}')--}}
                //     location.href          = response.url;
                {{--},--}}
                success: function (data) {
                    $('#report').modal('hide');
                    location.href          = response.url;
                },
                error: function (xhr) {
                    // $('.error_meassages').remove();
                    $('#name input').removeClass('border-danger')
                    $('#email input').removeClass('border-danger')
                    $('#phone input').removeClass('border-danger')
                    $('#city input').removeClass('border-danger')
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        // $('#reason[name='+key+']').addClass('border-danger')
                        $('#name[name='+key+']').after('<small class="form-text error_meassages text-danger">'+value+'</small>');
                        $('#email[name='+key+']').after('<small class="form-text error_meassages text-danger">'+value+'</small>');
                        $('#phone[name='+key+']').after('<small class="form-text error_meassages text-danger">'+value+'</small>');
                        $('#city[name='+key+']').after('<small class="form-text error_meassages text-danger">'+value+'</small>');
                    });
                },

            });
        });
    </script>
    <!-- slider --->


    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js"></script> --}}
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        let prevz = document.querySelector(".slick-prevz");
        let nextz = document.querySelector(".slick-nextz");
        $('.slick').slick({
       /*  dots: true, */
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll : 3,
        autoplay : true,
        centerMode : true,
        initialSlide : 1,
        pauseOnFocus : false,
        pauseOnHover : false,
        prevArrow :prevz,
        nextArrow :nextz,
        responsive: [
            {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
            },
            {
            breakpoint: 800,
            settings: {
                slidesToShow: 2,
            }
            },
            {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
        });
    </script>


@endsection


