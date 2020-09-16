<?php

namespace App\Http\Controllers\Dashboard\LaratrustControllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Role_Permission\Permission;
use App\Http\Requests\CreatePermissionRequest;

class PermissionController extends Controller
{ /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
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

//        dd ($request);
//        $validated = $request->validated();
        $permission = Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

//        if($permission){
//            session()->flash('success', __('site.updated_permission_successfully'));
//            return response() -> json([
//                'status'=> true,
//                'msg'=> __('site.added_successfully'),
//            ]);
//        }
//        else{
//            session()->flash('fail', __('site.updated_fail'));
//
//            return response() -> json([
//                'status'=> false,
//                'msg'=> __('site.Error_add'),
//            ]);
//        }
        session()->flash('success', __('site.added_permission_successfully'));

        return redirect(route('dashboard.permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Permission $permission)
    {
        return view('dashboard.laratrust.permissions.show', compact('permission'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(CreatePermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);
        session()->flash('success', __('site.updated_permission_successfully'));
        return redirect(route('dashboard.permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Permission $permission)
//    {
//        $permission->delete();
//        return redirect(route('dashboard.permissions.index'));
//    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        session()->flash('success', __('site.deleted_successfully'));

//        return redirect(route('dashboard.permissions.index'));
    }
}
