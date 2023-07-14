@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Общее количество баллов: ') . $result->total_points }}
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('admin.results.index') }}" class="btn btn-primary">
                        <span class="text">{{ config('constants.util.back_button_text') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>{{ __('Категория') }}</th>
                            <th>{{ __('Текст вопроса') }}</th>
                            <th>{{ __('Баллы') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($result->questions as $question)
                            <tr>
                                <td>{{ $question->category->name }}</td>
                                <td>{{ $question->question_text }}</td>
                                <td>{{ $question->pivot->points }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection
