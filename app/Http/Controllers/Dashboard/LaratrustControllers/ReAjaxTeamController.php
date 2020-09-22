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

class ReAjaxTeamController extends Controller
{
    protected $rolesModel;
    protected $permissionModel;
    protected $assignPermissions;
    protected $teamsModel;


    public function __construct()
    {
        $this->rolesModel = Config::get('laratrust.models.role');
        $this->permissionModel = Config::get('laratrust.models.permission');
        $this->assignPermissions = Config::get('laratrust.panel.assign_permissions_to_user');
        $this->teamsModel = Config::get('laratrust.models.team');

    }

    /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
 */
    public function index(Request $request)
    {
        $teams = $this->teamsModel::orderBy('display_name', 'ASC')->get();

        if ($request->ajax()) {
            $data = $this->teamsModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $action = '
                                <a href="javascript:void(0)" data-id='.$row->id.' onclick="editTeam(event.target)" class="btn btn-info btn-sm"><i class="fa fa-edit" data-id='.$row->id.'></i></a>
                                <a href="javascript:void(0)" data-id='.$row->id.' onclick="show_delete_model(event.target)" class="btn btn-danger btn-sm"><i class="fa fa-trash"  data-id='.$row->id.'></i></a>';

                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.laratrust.teams.IndexAjax', compact('teams'));
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
                'name' => 'unique:teams',
            ]);
        }
        $team = $this->teamsModel::updateOrCreate(['id' => $request->post_id],[
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        return response()->json(['code'=>200, 'message'=>'Team Created successfully','data' => $team], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $team = $this->teamsModel::find($id);

        return response()->json(['code'=>200, 'message'=>'Role get successfully','team'=>$team], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $team = $this->teamsModel::findOrFail($id);
        $team->users()->sync([]);
        $team->users()->sync([]);
        $team->delete();

        return response()->json(['success'=>'Team Deleted successfully']);
    }
}
