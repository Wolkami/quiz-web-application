@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ config('constants.verify.header') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ config('constants.verify.success_message_text') }}
                            </div>
                        @endif

                        {{ __('Перед тем как продолжить, пожалуйста, проверьте электронную почту и перейдите по ссылке подтверждения регистрации.') }}
                        {{ __('Если вы не получили письмо') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите здесь для повторной отправки') }}</button>
                            .
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
