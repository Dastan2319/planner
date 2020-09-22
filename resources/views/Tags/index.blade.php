@extends('layouts.app')

@section('content')

    <div class="col-md-9 d-flex flex-column container">
        @can('create' , \App\Models\Tags::class)
            <div class="d-flex mb-4">
                <a href="{{ route('tags.create') }}" class="btn btn-success ml-auto">{{ __('createNewTag') }}</a>
            </div>
        @endcan
        @if($tags->isNotEmpty())
            <div class="d-flex flex-row flex-wrap">

                @foreach($tags as $tag)
                    <div class="card card-body col-md-3 mr-2 mt-2">
                        <span>{{ $tag->name }}</span>
                        <div class="d-flex ml-auto">
                            @can('update',$tag)
                                    <a href="{{ route('tags.edit',$tag) }}" class="btn btn-info">
                                        <label style="font-size: 12px" class="material-icons btn-icon">create</label>
                                    </a>
                            @endcan
                            @can('delete',$tag)
                                    <form action="{{ route('tags.destroy',$tag) }}" method="post" class="ml-2">
                                        @csrf @method('delete')
                                        <button class="btn btn-danger btn-icon">
                                            <label style="font-size: 12px" class="material-icons">delete</label>
                                        </button>
                                    </form>
                            @endcan
                        </div>
                    </div>
                @endforeach

            </div>

            @else
            <div class="alert text-center border-danger">
                {{ __('nothingToShow') }}
            </div>
        @endif
    </div>

@endsection
