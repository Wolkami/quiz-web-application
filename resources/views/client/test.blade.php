@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(session('status'))
                <div class="col">
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                </div>
            @elseif($errors->has("questions.*"))
                <div class="col">
                    <div class="alert alert-danger" role="alert">Для получения результатов тестирования необходимо ответить на <strong>все</strong> вопросы.</div>
                </div>
            @else
                <div class="col">
                    <div class="alert alert-info" role="alert">На каждый вопрос можно дать только один ответ. Удачи!</div>
                </div>
            @endif

            <form method="POST" action="{{ route('client.test.store') }}">
                @csrf

                @if(!$categories->isEmpty())
                    <div class="row">
                        <div class="col-8">
                            <div class="accordion scrollspy mb-4" id="quizCategories" data-bs-spy="scroll" data-bs-target="#categories-list" data-bs-smooth-scroll="true" tabindex="0">
                                {{-- Категории --}}
                                @foreach($categories as $category)
                                    <div class="accordion-item" id="category-block-{{ $category->id }}">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#category-{{ $category->id }}"
                                                    aria-expanded="true"
                                                    aria-controls="category-{{ $category->id }}">
                                                Категория {{ $loop->iteration }}: {{ $category->name }}
                                            </button>
                                        </h2>
                                        <div id="category-{{ $category->id }}" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                {{-- Вопросы --}}
                                                @foreach($category->categoryQuestions->sortBy('id') as $question)
                                                    <div class="question-block {{ !$loop->last ? 'mb-3' : '' }}">
                                                        <h3>{{ $loop->iteration }}. {{ $question->question_text }}</h3>
                                                        <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                                        {{-- Варианты ответа --}}
                                                        @if($errors->has("questions.$question->id"))
                                                            <div class="alert alert-danger mb-3" role="alert">Необходимо выбрать вариант ответа.</div>
                                                        @endif
                                                        <ul class="list-group">
                                                            @foreach($question->questionOptions->sortBy('id') as $option)
                                                                <li class="list-group-item">
                                                                    <input class="form-check-input me-1"
                                                                           type="radio"
                                                                           name="questions[{{ $question->id }}]"
                                                                           value="{{ $option->id }}"
                                                                           id="option-{{ $option->id }}"
                                                                        {{ old("questions.$question->id") == $option->id ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="option-{{ $option->id }}">{{ $option->option_text }}</label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-4">
                            <div id="categories-list" class="list-group sticky-top">
                                @foreach($categories as $category)
                                    <a class="nav-item list-group-item list-group-item-action" href="#category-block-{{ $category->id }}">
                                        Категория {{ $loop->iteration }}: {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Вопросы не найдены.</h4>
                        <p>Вы видите это сообщение потому, что в приложении отсутствует список категорий. Чтобы создать новую категорию вопросов перейдите в <a class="alert-link" target="_blank" href="{{ route('admin.categories.index') }}">панель управления</a>*.</p>
                        <hr>
                        <p class="mb-0">* Доступ в панель управления есть только у пользователей с правами администратора.</p>
                    </div>
                @endif

                @if(!$categories->isEmpty())
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">{{ __('Отправить') }}</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
