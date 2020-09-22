<?php

namespace App\Http\Controllers\Dashboard\LaratrustControllers;

use App\Models\Role_Permission\Permission;
use Hash;
use App\Models\Role_Permission\Role;
use App\Models\Role_Permission\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\DB;

class UserLaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $users = User::latest()->paginate(10);
        return view('dashboard.laratrust.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::with('permissions')->latest()->get();
        $teams = Team::latest()->get();
        $permissions = Permission::get()->all();
        return view('dashboard.laratrust.users.create', compact('permissions','roles', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(CreateUserRequest $request)
    {
//        dd($request);
        $request_data = $request->except(['roles', 'permissions', 'password']);
        $request_data['password'] = bcrypt($request->password);
        $user = User::create($request_data);
//        $user = User::create([
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
        if($request->has('permissions') ) {
            $user->syncPermissions($request->permissions);
        }
        if($request->has('roles') ) {
            $roles = Role::find($request->roles);
            $user->syncRoles($roles);
        }

        return redirect(route('dashboard.usersLara.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        dd($user);
        return view('dashboard.laratrust.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        dd($user);
//        $user =  User::where('id',$user->id);
        $userT = User::findOrFail($user->id);
        dd($userT);
//        return view('dashboard.laratrust.users.edit', ['user' => User::findOrFail($user->id)]);

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $roles = $user->roles;

        foreach ($roles as $key => $value) {
            $user->detachRole($value);
        }

        $role = Role::find($request->input('role'));
        $user->attachRole($role);

        return redirect(route('dashboard.usersLara.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $roles = $user->roles;
        $permissions = $user->permissions;

        foreach ($permissions as $key => $value) {
            $user->detachPermission($value);
        }
        foreach ($roles as $key => $value) {
            $user->detachRole($value);
        }
        $user->delete();
        return redirect(route('dashboard.usersLara.index'));
    }
}
