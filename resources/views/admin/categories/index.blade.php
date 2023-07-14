@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Категории вопросов') }}</h6>
                <div class="ml-auto">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ config('constants.util.create_button_text') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        class="table table-bordered table-striped table-hover {{ !$categories->isEmpty() ? 'datatable datatable-category' : '' }}"
                        cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            @if(!$categories->isEmpty())
                                <th width="10"></th>
                            @endif
                            <th>{{ __('№') }}</th>
                            <th>{{ __('Название') }}</th>
                            <th>{{ __('Действие') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr data-entry-id="{{ $category->id }}">
                                <td>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                           class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form
                                            onclick="return confirm('{{ config('constants.util.confirm_delete_single_element_text') }}')"
                                            class="d-inline"
                                            action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST">
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
    @include('partials.datatable', ['elements_type' => 'categories', 'datatable_selector' => 'datatable-category'])
@endpush
