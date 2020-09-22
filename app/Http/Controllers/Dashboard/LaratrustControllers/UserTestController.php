<?php

namespace App\Http\Controllers\Dashboard\LaratrustControllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Role_Permission\Team;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Models\Role_Permission\Permission;
use App\Models\Role_Permission\Role;
use Illuminate\Support\Facades\Hash;

class UserTestController extends Controller
{
    protected $rolesModel;
    protected $permissionModel;
    protected $assignPermissions;

    public function __construct()
    {
        $this->rolesModel = Config::get('laratrust.models.role');
        $this->permissionModel = Config::get('laratrust.models.permission');
        $this->assignPermissions = Config::get('laratrust.panel.assign_permissions_to_user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
        if (!$userModel) {
            abort(404);
        }
//        dd($modelsKeys);
//        dd($modelKey);
//        dd($userModel);
        $roles = Role::with('permissions')->get();
        $users = $userModel::latest()->paginate(5);
//        dd($users);
        return view('dashboard.laratrust.users.index', compact('users', 'roles', 'modelsKeys', 'modelKey'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $roles = Role::with('permissions')->latest()->get();
        $teams = Team::latest()->get();
        $permissions = Permission::get()->all();
        return view('dashboard.laratrust.users.create', compact('permissions','roles', 'teams', 'modelsKeys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
        if (!$userModel) {
            abort(404);
        }

        $request_data = $request->only(['email', 'first_name', 'last_name']);
        $request_data['password'] = bcrypt($request->password);
        $user = $userModel::create($request_data);
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
        session()->flash('success', __('site.added_successfully'));
        $model = $modelKey;
        return redirect(route('dashboard.userTest.index',compact('model')));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('dashboard.laratrust.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit( Request $request, $id)
    {

        $modelKey = $request->get('model');
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
        if (!$userModel) {
            abort(404);
        }
        if ($userModel) {
            $user = $userModel::findOrFail($id);

            $roles = Role::with('permissions')->get();
            $user_roles = $user->roles()->get()->pluck('id')->toArray();

            $permissions = Permission::get()->all();
            $user_permissions = $user->permissions()->get()->pluck('id')->toArray();

            return view('dashboard.laratrust.users.edit', compact('user', 'roles', 'user_roles', 'permissions', 'user_permissions', 'modelKey'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */

    public function update(Request $request, $id)
    {
//        dd($request);
        $modelKey = $request->get('model');
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
        if (!$userModel) {
            abort(404);
        }
        if ($userModel) {
            $user = $userModel::findOrFail($id);
            $request_data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ];
            if ($request->edit_password == 'edit_password') {
                $request_data['password'] = bcrypt($request->password);
            }
            $user->update($request_data);


            // Roles
            $roles = $user->roles;
            $user->detachRoles($roles);
//                dd($roles);
            // Permissions
            $permissions = $user->permissions;
            $user->detachPermissions($permissions);

            // Roles attach
            if ($request->input('roles')) {
                if (count($request->input('roles')) > 0) {
                    $user->attachRoles($request->input('roles'));
                    echo "good";
                }
            }

            // Permissions attach
            if ($request->input('permissions')) {
                if ($request->input('permissions')) {
                    $user->syncPermissions($request->input('permissions'));
                    echo "good";
                }
            }
        }
        session()->flash('success', __('site.updated_successfully'));
            $model = $modelKey;
            return redirect(route('dashboard.userTest.index',compact('model')));
//            return redirect(route('dashboard.userTest.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request,int $id)
    {
//        dd($user);
//        dd($request->model);
        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
//        dd($userModel);
        if (!$userModel) {
            abort(404);
        }
//        dd($id);
        $user = $userModel::findOrFail($id);
//        dd($user);
        // Roles
//        $roles = $user->roles;
//        $user->detachRoles($roles);
////                dd($roles);
//        // Permissions
//        $permissions = $user->permissions;
//        $user->detachPermissions($permissions);
//        $user->delete();

        return response()->json(['success'=>'Permission Deleted successfully']);
//        session()->flash('success', __('site.deleted_successfully'));
//        return redirect(route('dashboard.userTest.index'));
    }
}
