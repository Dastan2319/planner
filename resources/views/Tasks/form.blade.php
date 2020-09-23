<?php
$task = $task ?? null;

?>
@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="card col-md-6">
            <h1>
                {{ $task ? __('editTask') : __('createTask') }}
            </h1>
            <form action="{{ $task ? route('tasks.update',$task) : route('tasks.store') }}" method="post" class="card-body">
                @csrf
                @if($task) @method('put') @endif

                <div class="form-group">
                    <label for="name" class="title">{{ __('labelName') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name',$task->name ?? null) }}"
                           class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('enterNameTitle') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="description" class="title">{{ __('labelDescription') }}</label>
                    <textarea
                        class="form-control"
                        name="description" id="description"
                        cols="30"
                        rows="10" placeholder="{{ __('placeholderTextArea') }}">{{old('description' ,$task->description ?? null)}}</textarea>

                </div>
                <div class="form-group">
                    <label for="timeToReady" class="title">{{ __('labelTimeToReady') }}</label>
                    <input type="date" id="timeToReady" name="timeToReady" value="{{ old('timeToReady',$task->timeToReady ?? null) }}"
                           min="{{ \Carbon\Carbon::now()->format('YYYY-MM-DD') }}"
                           class="form-control @error('timeToReady') is-invalid @enderror" placeholder="{{ __('enterTimeToReady') }}">
                    @error('timeToReady')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="tags_id">{{ __('labelTags') }}</label>
                    <select name="tags_id" id="tags_id" class="form-control">
                        @foreach($tags as $item)
                            <option  {{ old('tags_id',$post->category_id ?? null) == $item->id ? 'selected': '' }} value="{{$item->id}}">
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('tags_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="priority_id">{{ __('labelPriority') }}</label>
                    <select name="priority_id" id="priority_id" class="form-control">
                        @foreach($priority as $item)
                            <option style="color:@if($item->color) {{$item->color}} @else black @endif"  {{ old('priority_id',$item->priority_id ?? null) == $item->id ? 'selected': '' }} value="{{$item->id}}">
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('priority_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                </div>

                <div>
                    <input type="hidden" id="isReady" name="isReady" value="{{ old('isReady',$task->isReady ?? 0) }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{ $task ? __('update') : __('create')  }}</button>
                </div>

            </form>
        </div>
    </div>

@endsection
