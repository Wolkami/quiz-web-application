@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Пользователи') }}
                </h6>
                <div class="ml-auto">
                    @can('user_create')
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                            <span class="text">{{ config('constants.util.create_button_text') }}</span>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover {{ !$users->isEmpty() ? 'datatable datatable-User' : '' }}"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            @if(!$users->isEmpty())
                                <th width="10"></th>
                            @endif
                            <th>{{ __('№') }}</th>
                            <th>{{ __('Имя') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Роли') }}</th>
                            <th>{{ __('Действие') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $key => $role)
                                        <span class="badge badge-info">{{ $role->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form onclick="return confirm('{{ config('constants.util.confirm_delete_single_element_text') }}')" class="d-inline"
                                              action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"
                                                    style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ config('constants.util.no_data_text') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection

@push('script-alt')
    @include('partials.datatable', ['elements_type' => 'users', 'datatable_selector' => 'datatable-User'])
@endpush
