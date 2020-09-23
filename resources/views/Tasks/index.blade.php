@extends('layouts.app')

@section('content')

    <div class="col-md-9 d-flex flex-column container">
        @can('create' , \App\Models\Tasks::class)
            <div class="d-flex mb-4">
                <a href="{{ route('tasks.create') }}" class="btn btn-success ml-auto">{{ __('createNewTask') }}</a>
            </div>
        @endcan
        @if($tasks->isNotEmpty())
            <div class="d-flex flex-column align-items-center ">

                @foreach($tasks as $task)
                    <div class="card card-body col-md-9 mr-2 mt-2"
                         style="border: 3px solid @if($task->priority->color) {{ $task->priority->color }} @else white @endif ">
                        <div class="d-flex">
                            <span>
                                <a href="{{ route('tasks.show',$task) }}">{{ __('name') }}:{{ $task->name }}</a>
                            </span>
                            <div class="d-flex   ml-auto">
                                @can('update',$task)
                                    <a href="{{ route('tasks.edit',$task) }}" class="btn btn-info">
                                        <label style="font-size: 12px" class="material-icons btn-icon">create</label>
                                    </a>
                                @endcan
                                @can('delete',$task)
                                    <form action="{{ route('tasks.destroy',$task) }}" method="post" class="ml-2">
                                        @csrf @method('delete')
                                        <button class="btn btn-danger btn-icon">
                                            <label style="font-size: 12px" class="material-icons">delete</label>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <div>
                            <label>{{ __('timeToReady') }}:{{ $task->timeToReady }}</label>
                        </div>
                        <div>
                            <label>{{ __('priority') }}:{{ $task->priority->name }}</label>
                        </div>
                        <div>
                            <label>{{ __('tag') }}:{{ $task->tags->name }}</label>
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
