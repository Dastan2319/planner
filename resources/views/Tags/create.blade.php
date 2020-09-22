<?php
$tag = $tag ?? null;

 ?>
@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="card col-md-6">
                <h1>
                    {{ $tag ? __('editTag') : __('createTag') }}
                </h1>
            <form action="{{ $tag ? route('tags.update',$tag) : route('tags.store') }}" method="post" class="card-body">
                @csrf
                @if($tag) @method('put') @endif

                <div class="form-group">
                    <label for="name" class="title">{{ __('labelTagName') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name',$tag->name ?? null) }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('enterNameTitle') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{ $tag ? __('update') : __('create')  }}</button>
                </div>

            </form>
        </div>
    </div>

@endsection
