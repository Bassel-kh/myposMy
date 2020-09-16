<?php

namespace App\Http\Controllers\Dashboard\LaratrustControllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use DB;
use App\Models\Role_Permission\Permission;
use App\Http\Requests\CreatePermissionRequest;

class AjaxPermissionController extends Controller
{ /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
 */
    public function index()
    {
//        $permissions = Permission::latest()->paginate(5);
        $permissions = Permission::get()->all();
        return view('dashboard.laratrust.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.laratrust.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreatePermissionRequest $request)
    {
//        dd($request);
        if($request->id =="" or $request->id == null) {
             $request->validate([
                'name' => 'unique:permissions',
            ]);
        }
        $permission = Permission::updateOrCreate(['id' => $request->id],[
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        return response()->json(['code'=>200, 'message'=>'Permission Created successfully','data' => $permission], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $permission = Permission::find($id);

        return response()->json($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        return view('dashboard.laratrust.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePermissionRequest $request, int $id)
    {
////        dd($request);
//        $permission = Permission::find($id);
//        $permission-> name =$request->name;
//           $permission-> display_name= $request->display_name;
//           $permission-> description = $request->description;
//
//
//        return response()->json(['code'=>200, 'message'=>'Permission Created successfully','data' => $permission], 200);

    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Permission $permission)
//    {
//        $permission->delete();
//        return redirect(route('dashboard.permissions.index'));
//
//    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $permission = Permission::find($id)->delete();

        return response()->json(['success'=>'Permission Deleted successfully']);
    }
}
