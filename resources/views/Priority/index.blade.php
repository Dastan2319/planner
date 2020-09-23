@extends('layouts.app')

@section('content')

    <div class="col-md-9 d-flex flex-column container">
        @can('create' , \App\Models\Priority::class)
            <div class="d-flex mb-4">
                <a href="{{ route('priority.create') }}" class="btn btn-success ml-auto">{{ __('createNewPriority') }}</a>
            </div>
        @endcan
        @if($priorities->isNotEmpty())
            <div class="d-flex flex-row flex-wrap">

                @foreach($priorities as $priority)
                    <div class="card card-body col-md-3 mr-2 mt-2" style="background-color:@if($priority->color) {{$priority->color}} @else white @endif" >
                        <span>{{ __('name') }}:{{ $priority->name }}</span>
                        <span>{{ __('priority') }}:{{ $priority->num }}</span>
                        <div class="d-flex ml-auto">
                            @can('update',$priority)
                                <a href="{{ route('priority.edit',$priority) }}" class="btn btn-info">
                                    <label style="font-size: 12px" class="material-icons btn-icon">create</label>
                                </a>
                            @endcan
                            @can('delete',$priority)
                                <form action="{{ route('priority.destroy',$priority) }}" method="post" class="ml-2">
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
