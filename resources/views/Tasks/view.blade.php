@extends('layouts.app')


@section('content')
    <div class="d-flex flex-column align-items-center">
        <div class="card-body card col-md-9">
            <div>
                <h1>{{ __('task') }}:{{ $task->name }}</h1>
                <div class="d-flex mb-3">
                    <div >
                        {{ __('Autor') }}:{{ $task->user->name }}
                    </div>
                    <div class="ml-auto">
                        {{ __('Created Time') }}:{{ $task->created_at->diffForHumans() }}
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

                @if($task->description)
                    <div>
                        <label>{{ __('description') }}:{{ $task->description }}</label>
                    </div>
                @endif

            </div>
            <div class="d-flex ml-auto">
                <a class="btn btn-info mr-2"  href="{{ route('tasks') }}">
                    {{ __('back') }}
                </a>
                @can('update',$task)
                    <div class="d-flex justify-content-end">
                        <form method="post" action="{{ route('tasks.toggle',$task) }}">
                            @csrf
                            <button href="#" class="btn @if($task->isReady)  btn-success @else btn-danger @endif ">
                                {{ __('ready') }}: {{ $task->isReady ? __('isReady') : __('isNotReady') }}
                            </button>
                        </form>
                    </div>
                @else
                    <div>
                        <button  class="btn @if($task->isReady)  btn-success @else btn-danger @endif ">
                            {{ __('ready') }}: {{ $task->isReady ? __('isReady') : __('isNotReady') }}
                        </button>
                    </div>
            @endauth
            </div>

        </div>
    </div>
@endsection
