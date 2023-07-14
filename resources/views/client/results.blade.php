@extends('layouts.client')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead class="table-light">
            <tr>
                <td>{{ __('Категория') }}</td>
                <td>{{ __('Текст вопроса') }}</td>
                <td>{{ __('Баллы') }}</td>
            </tr>
            </thead>
            <tbody>
            @foreach($result->questions as $question)
                <tr>
                    <td>{{ $question->category->name }}</td>
                    <td>{{ $question->question_text }}</td>
                    <td><span class="badge bg-{{ $question->pivot->points ? 'success' : 'danger' }} text-bg-{{ $question->pivot->points ? 'success' : 'danger' }}">{{ $question->pivot->points }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p><strong>{{ __('Всего баллов: ') }}</strong>{{ $result->total_points }}</p>
        <a class="btn btn-primary" href="{{ route('client.test') }}">{{ config('constants.util.back_button_text') }}</a>
    </div>
@endsection
