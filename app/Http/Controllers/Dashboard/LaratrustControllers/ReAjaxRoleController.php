<?php

namespace App\Http\Controllers\Dashboard\LaratrustControllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Role_Permission\Role;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Models\Role_Permission\Permission;
use App\Http\Requests\CreatePermissionRequest;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class ReAjaxRoleController extends Controller
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
 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
 */
    public function index(Request $request)
    {
        $permissions = $this->permissionModel::orderBy('display_name', 'ASC')->get();
        if ($request->ajax()) {
            $data = $this->rolesModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $action = '
                                <a href="javascript:void(0)" data-id='.$row->id.' onclick="editRole(event.target)" class="btn btn-info btn-sm"><i class="fa fa-edit" data-id='.$row->id.'></i></a>
                                <a href="javascript:void(0)" data-id='.$row->id.' onclick="show_delete_model(event.target)" class="btn btn-danger btn-sm"><i class="fa fa-trash"  data-id='.$row->id.'></i></a>';

                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.laratrust.roles.IndexAjax', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.laratrust.Roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateRoleRequest $request)
    {
//        dd($request);
        if($request->post_id =="" or $request->post_id == null) {
             $request->validate([
                'name' => 'unique:roles',
            ]);
        }
        $role = $this->rolesModel::updateOrCreate(['id' => $request->post_id],[
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        $permissions = $role->permissions;
        if($permissions) {
            $role->detachPermissions($permissions);
            if($request->has('permissions') ) {
                $role->syncPermissions($request->permissions);
            }
        }


        return response()->json(['code'=>200, 'message'=>'Role Created successfully','data' => $role], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $role = $this->rolesModel::find($id);
        $role_permissions = $role->permissions()->get()->pluck('name')->toArray();
//        dd($role_permissions);
        return response()->json(['code'=>200, 'message'=>'Role get successfully','role'=>$role,'role_permissions'=>$role_permissions], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Role $role)
    {
//        return view('dashboard.laratrust.roles.edit', compact('role'));
//        if ($this->rolesModel) {
//            $role = $this->rolesModel::findOrFail($role->id);

            $role_permissions = $role->permissions()->get()->pluck('id')->toArray();
                dd($role_permissions);
//            return response()->json(['code'=>200, 'message'=>'User get successfully','role'=>$role,'role_permissions'=>$role_permissions], 200);

//            return view('dashboard.laratrust.users.edit', compact('user', 'roles', 'user_roles', 'permissions', 'user_permissions', 'modelKey'));
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRoleRequest $request, int $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
//        $role = $this->rolesModel::where('id',$id);


        $role = $this->rolesModel::findOrFail($id);
        $role->users()->sync([]);
        $role->permissions()->sync([]);
        $role->delete();
        return response()->json(['success'=>'Role Deleted successfully']);
    }
}
