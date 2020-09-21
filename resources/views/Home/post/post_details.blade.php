@extends('welcome')
@section('content')
        <h2 style="margin: 0;position: inherit;font-size: 22px" class="title text-center">{{$meta_title}}</h2>

        <div class="product-image-wrapper" style="border: none">
            @foreach($post as $key=>$value)
                <div class="single-products" style="margin: 10px 0;padding: 2px">
                    {!! $value->posts_content !!}
                </div>
                        <div class="clearfix"></div>

            @endforeach
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!!$post->links()!!}
                    </ul>
                </div>
        </div>
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>
            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach($related as $key=>$value_related)
                            <a href="{{URL::to('/post-details/'.$value_related->posts_slug)}}">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{URL::to('style/uploads/post/'.$value_related->posts_image)}}" alt="" />
                                                <h2>{!!$value_related->posts_description !!}</h2>
                                                <p>{{$value_related->posts_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div><!--/recommended_items-->



@endsection
