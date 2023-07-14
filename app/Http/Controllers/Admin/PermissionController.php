<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::get();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @return RedirectResponse
     */
    public function store(StorePermissionRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Permission::create($request->validated());

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'Права успешно добавлены',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return View
     */
    public function edit(Permission $permission): View
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(UpdatePermissionRequest $request,Permission $permission): RedirectResponse
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->update($request->validated());

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'Права успешно обновлены',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'Права успешно удалены',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request): \Illuminate\Http\Response
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
