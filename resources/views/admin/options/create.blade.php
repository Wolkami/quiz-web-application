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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Добавить вариант ответа') }}</h1>
                    <a href="{{ route('admin.options.index') }}"
                       class="btn btn-primary btn-sm shadow-sm">{{ config('constants.util.back_button_text') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.options.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question">{{ __('Вопрос') }}</label>
                        <select class="form-control" name="question_id" id="question">
                            @foreach($questions as $id => $question)
                                <option value="{{ $id }}">{{ $question }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="option_text">{{ __('Текст ответа') }}</label>
                        <input type="text" class="form-control" id="option_text" placeholder="{{ __('Введите текст ответа') }}"
                               name="option_text" value="{{ old('option_text') }}"/>
                    </div>
                    <div class="form-group">
                        <label for="points">{{ __('Баллы') }}</label>
                        <input type="number" class="form-control" id="points" placeholder="{{ __('Количество баллов за ответ') }}"
                               name="points" value="{{ old('points') }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ config('constants.util.create_button_text') }}</button>
                </form>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection
