@extends('admin_layout')
@section('content')
    <section class="panel">
        <header class="panel-heading">
            Category
        </header>
        <div class="position-center">
            @foreach($edit_category as $key=>$value_category)
            <form action="{{URL::to('/update-category/'.$value_category->category_id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">CategoryName</label>
                    <input type="text" name="category_name" data-validation="length" required="" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$value_category->category_name}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">CategorySlug</label>
                    <input type="text" name="category_slug" data-validation="length" required="" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$value_category->category_slug}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="category_description" data-validation="length" required="" data-validation-length="min3" rows="8" class="form-control" id="ckEditor5">{{$value_category->category_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Parent</label>
                </div>
                <select name="category_parent" class="form-control input-sm m-bot15">
                    <option value="0">-----------Category parent-------------</option>
                    @foreach($category as $key => $value)
                            @if($value->category_parent == 0)
                                <option {{$value->category_id == $value_category->category_id ? 'selected' : ''}} value="{{$value->category_id}}">{{$value->category_name}}</option>
                            @endif
                        @foreach($category as $key => $value2)
                            @if($value2->category_parent == $value->category_id)
                                <option {{$value2->category_id == $value_category->category_id ? 'selected' : ''}} value="{{$value2->category_id}}">{{$value2->category_name}}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keywords</label>
                    <textarea name="meta_keywords" data-validation="length" required="" data-validation-length="min3" rows="8" class="form-control" id="ckEditor9">{{$value_category->meta_keywords}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Action</label>
                </div>
                <input type="submit" name="update_category" value="Update" class="btn btn-info">
            </form>
            @endforeach
        </div>
    </section>
@endsection
