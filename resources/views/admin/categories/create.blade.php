@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Добавить категорию') }}</h1>
                    <a href="{{ route('admin.categories.index') }}"
                       class="btn btn-primary btn-sm shadow-sm">{{ config('constants.util.back_button_text') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Название') }}</label>
                        <input type="text" class="form-control" id="name" placeholder="{{ __('Название категории') }}" name="name"
                               value="{{ old('name') }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ config('constants.util.create_button_text') }}</button>
                </form>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection
