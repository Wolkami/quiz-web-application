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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Добавить результаты тестирования') }}</h1>
                    <a href="{{ route('admin.results.index') }}"
                       class="btn btn-primary btn-sm shadow-sm">{{ config('constants.util.back_button_text') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.results.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question">{{ __('Вопросы (можно выбрать несколько)') }}</label>
                        <select class="form-control" name="questions[]" multiple id="question">
                            @foreach($questions as $id => $question)
                                <option value="{{ $id }}">{{ $question }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_points">{{ __('Баллы') }}</label>
                        <input type="number" class="form-control" id="total_points"
                               placeholder="{{ __('Укажите общее количество баллов') }}" name="total_points"
                               value="{{ old('total_points') }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ config('constants.util.create_button_text') }}</button>
                </form>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection
