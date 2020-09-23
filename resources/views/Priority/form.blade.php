<?php
$priority = $priority ?? null;

?>
@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="card col-md-6">
            <h1>
                {{ $priority ? __('editTag') : __('createTag') }}
            </h1>
            <form action="{{ $priority ? route('priority.update',$priority) : route('priority.store') }}" method="post" class="card-body">
                @csrf
                @if($priority) @method('put') @endif

                <div class="form-group">
                    <label for="name" class="title">{{ __('labelTagName') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name',$priority->name ?? null) }}"
                           class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('enterNameTitle') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="num" class="title">{{ __('labelPriorityNum') }}</label>
                    <input type="number" id="num" name="num" value="{{ old('num',$priority->num ?? null) }}"
                           class="form-control @error('num') is-invalid @enderror" placeholder="{{ __('enterNum') }}">
                    @error('num')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="color" class="title">{{ __('labelPriorityColor') }}</label>
                    <input type="color" id="color" name="color" value="{{ old('color',$priority->color ?? null) }}"
                           class="form-control @error('color') is-invalid @enderror" placeholder="{{ __('enterColor') }}">
                    @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{ $priority ? __('update') : __('create')  }}</button>
                </div>

            </form>
        </div>
    </div>

@endsection
