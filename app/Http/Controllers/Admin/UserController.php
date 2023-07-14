<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated() + ['password' => bcrypt($request->password)]);
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('admin.users.index')->with([
            'message' => 'Пользователь успешно добавлен',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        $roles = Role::pluck('title', 'id');

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated() + ['password' => bcrypt($request->password)]);
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('admin.users.index')->with([
            'message' => 'Пользователь успешно обновлен',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'message' => 'Пользователь успешно удален',
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
        User::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
