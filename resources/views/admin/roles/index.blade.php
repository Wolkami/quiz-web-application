@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Роли пользователей') }}
                </h6>
                <div class="ml-auto">
                    @can('role_create')
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
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
                    <table class="table table-bordered table-striped table-hover {{ !$roles->isEmpty() ? 'datatable datatable-Role' : '' }}"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            @if(!$roles->isEmpty())
                                <th width="10"></th>
                            @endif
                            <th>{{ __('№') }}</th>
                            <th>{{ __('Название') }}</th>
                            <th>{{ __('Права') }}</th>
                            <th>{{ __('Действие') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->title }}</td>
                                <td>
                                    @foreach($role->permissions as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form onclick="return confirm('{{ config('constants.util.confirm_delete_single_element_text') }}')" class="d-inline"
                                              action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
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
    @include('partials.datatable', ['elements_type' => 'roles', 'datatable_selector' => 'datatable-Role'])
@endpush
