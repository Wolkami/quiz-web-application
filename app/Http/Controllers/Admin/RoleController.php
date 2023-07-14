<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $permissions = Permission::pluck('title', 'id');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->validated());
        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('admin.roles.index')->with([
            'message' => 'Роль успешно добавлена',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::pluck('title', 'id');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request,Role $role): RedirectResponse
    {
        $role->update($request->validated());
        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('admin.roles.index')->with([
            'message' => 'Роль успешно обновлена',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with([
            'message' => 'Роль успешно удалена',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     * @return Response
     */
    public function massDestroy(Request $request): Response
    {
        Role::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
