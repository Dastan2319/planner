@extends('layouts.app')

@section('content')

    <div class="col-md-9 d-flex flex-column container">
        @can('create' , \App\Models\Tasks::class)
            <div class="d-flex mb-4">
                <a href="{{ route('tasks.create') }}" class="btn btn-success ml-auto">{{ __('createNewTask') }}</a>
            </div>
        @endcan
        <div class="d-flex flex-column align-items-center justify-content-center">
            <form action="{{ route('tasks') }}" class="card card-body col-md-10 d-flex flex-wrap  flex-row justify-content-end align-items-center">
                <div class="form-group mr-2 mb-0 col-sm-">
                    <select name="tags_id" id="tags_id" class="form-control">
                        <option value="0" selected="selected">{{ __('selectValue') }} {{ __('tags') }}</option>
                        @foreach($tags as $item)
                            <option {{ request('tags_id',$item->tags_id ?? null) == $item->id ? 'selected': '' }} value="{{$item->id}}">
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group mb-0">
                    <select name="priority_id" id="priority_id" class="form-control">
                        <option value="0" selected="selected">{{ __('selectValue') }} {{ __('priority') }}</option>
                        @foreach($priority as $item)
                            <option {{ request('priority_id',$item->priority_id ?? null) == $item->id ? 'selected': '' }} style="color:@if($item->color) {{$item->color}} @else black @endif"   value="{{$item->id}}">
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-0 ml-2">
                    <select name="isReady" id="isReady" class="form-control">
                        <option value="-1" selected="selected">{{ __('selectValue') }} {{ __('ready') }}</option>
                        <option {{ request('isReady') == 0 ? 'selected': '' }}  value="0">
                            {{ __('isNotReady') }}
                        </option>
                        <option {{ request('isReady') == 1 ? 'selected': '' }}  value="1">
                            {{ __('isReady') }}
                        </option>
                    </select>
                </div>
                <div class="ml-2">
                    <button class="btn btn-success">{{ __('submit') }}</button>
                </div>
                <div class="ml-2">
                    <a href="{{ route('tasks') }}" class="btn btn-danger">
                            <label style="font-size: 12px" class="material-icons">delete</label>
                    </a>
                </div>
            </form>
        </div>
        @if($tasks->isNotEmpty())
            <div class="d-flex flex-column align-items-center justify-content-center">
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
