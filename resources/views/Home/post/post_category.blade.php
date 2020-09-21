@extends('welcome')
@section('content')

    <h2 class="title text-center">{{$meta_title}}</h2>
    <div class="product-image-wrapper">
        @foreach($post as $key=>$value)
            <div class="single-products style=margin: 10px 0">
                <div class="text-center">

                    <img style="float: left;width: 30%;padding: 5px;" src="{{asset('style/uploads/post/'.$value->posts_image)}}" height="150px"/>

                    <h4 style="color: #000;padding: 5px;">{{$value->posts_name}}</h4>
                    <p>{!!$value->posts_description!!}</p>
                </div>
                <div class="text-right">
                    <a href="{{url('post-details/'.$value->posts_slug)}}" class="btn btn-default btn-sm">Details</a>
                </div>
                @endforeach
            </div>
    </div>
@endsection
