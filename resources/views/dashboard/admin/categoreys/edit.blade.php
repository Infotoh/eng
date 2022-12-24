@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('categoreys.categoreys')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.welcome') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('categoreys.categoreys')  </li>
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('dashboard.admin.categorys.update', $category->id) }}">
                    @csrf
                    @method('put')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('categoreys.number')<span class="text-danger">*</span></label>
                        <input type="text" name="number" class="form-control @error('name') is-invalid @enderror" value="{{ old('number', $category->number) }}" required autofocus  readonly>

                    </div>
                    
                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('categoreys.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required autofocus  readonly>

                    </div>
                    
                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('categoreys.consulation')<span class="text-danger">*</span></label>
                        <textarea type="text" name="consulation" rows="5" class="form-control @error('consulation') is-invalid @enderror"  required autofocus  readonly>{{$category->consultion  }}</textarea>

                    </div>
                    
                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('categoreys.comment')<span class="text-danger">*</span></label>
                        <textarea type="text" name="comment" class="form-control @error('comment') is-invalid @enderror " required autofocus  >{{ $category->comment }} </textarea>
                    </div>

                    

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

