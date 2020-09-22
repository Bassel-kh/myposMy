<?php

namespace App\Http\Controllers\Dashboard\LaratrustControllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserTestAjaxController extends Controller
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

        if ($request->ajax()) {
            $modelsKeys = array_keys(Config::get('laratrust.user_models'));
            $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
            $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
            if (!$userModel) {
                abort(404);
            }
            $data = $userModel::latest()->get();
//            dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $action = '
                                <a href="javascript:void(0)" data-id='.$row->id.' onclick="editUser(event.target)" class="btn btn-info btn-sm"><i class="fa fa-edit" data-id='.$row->id.'></i></a>
                                <a href="javascript:void(0)" data-id='.$row->id.' onclick="show_delete_model(event.target)" class="btn btn-danger btn-sm"><i class="fa fa-trash"  data-id='.$row->id.'></i></a>';

                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
        if (!$userModel) {
            abort(404);
        }
        $roles = Role::with('permissions')->get();
        $teams = Team::latest()->get();
        $permissions = Permission::get()->all();
        $users = $userModel::latest()->paginate(5);
//        dd($users);
        return view('dashboard.laratrust.users.indexAjax', compact('users', 'roles', 'permissions', 'teams','modelsKeys', 'modelKey'));
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
     * @return \Illuminate\Http\JsonResponse
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
        return response()->json(['code'=>200, 'message'=>'User Created successfully'], 200);




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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit( Request $request, $id)
    {

        $modelKey = $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
        if (!$userModel) {
            abort(404);
        }
        if ($userModel) {
            $user = $userModel::findOrFail($id);

//            $roles = Role::with('permissions')->get();
            $user_roles = $user->roles()->get()->pluck('name')->toArray();

//            $permissions = Permission::get()->all();
            $user_permissions = $user->permissions()->get()->pluck('name')->toArray();

            return response()->json(['code'=>200, 'message'=>'User get successfully','user'=>$user, 'user_roles'=>$user_roles, 'user_permissions'=>$user_permissions, 'model'=>$modelKey], 200);

//            return view('dashboard.laratrust.users.edit', compact('user', 'roles', 'user_roles', 'permissions', 'user_permissions', 'modelKey'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */

    public function update(UpdateUserRequest $request, $id)
    {
//        dd($request);
        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $modelKey = $request->get('model');
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;
        if (!$userModel) {
            abort(404);
        }
        $email_role = 'required |';
        foreach($modelsKeys as $key){
            if($key !== $modelKey) {
                $email_role .= 'unique:' . $key.'|';
            }
        }
//        dd($email_role);
         $request->validate(['email' => $email_role,]);
        if ($userModel) {
            $user = $userModel::findOrFail($id);
            $request_data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ];
            if( strcmp($user->email, $request->email) !== 0   ) {
                $request_data['email'] = $request->email;
            }
//            dd($request_data);
//            if($request->edit_password) {
//                dd($request);
                if (strcmp($request->edit_password, 'edit_password') == 0) {
                    $request->validate(['password' => 'required|min:1|max:32|confirmed']);
                    $request_data['password'] = bcrypt($request->password);
                }



            $user->update($request_data);

//            dd($user);
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
//                    echo "good";
                }
            }

            // Permissions attach
            if ($request->input('permissions')) {
                if ($request->input('permissions')) {
                    $user->syncPermissions($request->input('permissions'));
//                    echo "good";
                }
            }
        }
        return response()->json(['code'=>200, 'message'=>'User update successfully'], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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
        $user->delete();

        return response()->json(['code'=>200, 'message'=>'User Deleted successfully'], 200);

//        session()->flash('success', __('site.deleted_successfully'));
//        return redirect(route('dashboard.userTest.index'));
    }
}
