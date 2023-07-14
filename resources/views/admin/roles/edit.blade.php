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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Редактировать роль')}}</h1>
                    <a href="{{ route('admin.permissions.index') }}"
                       class="btn btn-primary btn-sm shadow-sm">{{ config('constants.util.back_button_text') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">{{ __('Название') }}</label>
                        <input type="text" class="form-control" id="title" placeholder="{{ __('Введите название') }}" name="title"
                               value="{{ old('title', $role->title) }}"/>
                    </div>
                    <div class="form-group">
                        <label for="permissions">{{ __('Права (можно выбрать несколько)') }}</label>
                        <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple"
                                required>
                            @foreach($permissions as $id => $permission)
                                <option
                                    value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permission }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ config('constants.util.save_button_text') }}</button>
                </form>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection
