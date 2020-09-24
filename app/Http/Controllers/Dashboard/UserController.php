<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        // create update delete read
        $this->middleware('auth');
        $this->middleware('permission:users_create')->only('create');
        $this->middleware('permission:users_read')->only('index');
        $this->middleware('permission:users_update')->only('update');
        $this->middleware('permission:users_delete')->only('destroy');


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')
                ->when($request->search , function ($q) use ($request){
                        return $q   ->where('first_name','like','%'.$request->search.'%')
                                    ->orwhere('last_name','like','%'.$request->search.'%')
                                    ->orwhere('email','like','%'.$request->search.'%');
//                })->get();
                })->latest()->paginate(5);




        return view('dashboard.users.index' ,compact('users'));

    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return  view('dashboard.users.create');

    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
//        dd($request->all());
        // validate data before insert to database
        // make para: array , validation roles, message
        $roles = $this -> getRoles();
        $request->validate($roles);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions']);
        $request_data['password'] = bcrypt($request->password);

        if($request->image){
           $img = Image::make($request->image)->resize(320, null, function ($constraint) {
                $constraint->aspectRatio();
            });// to use save method the folder where the file will save in it mustn't link with storage (*_~)
            $img->stream(); // <-- Key point
//
//            //dd();
            $fileName = $request->image->hashName();
            Storage::disk('public_uploads')->put('userImages'.'/'.$fileName, $img, 'public');

            $request_data['image']= $request->image->hashName();
//            Storage::disk('local')->put($request->image, 'Contents');
        } // end of if

//
//        if ($request->hasFile('image')) {
//            $image      = $request->file('image');
//            $fileName   = time() . '.' . $image->getClientOriginalExtension();
//            $fileName = $request->image->hashName();
//
//            $img = Image::make($image->getRealPath());
//            $img->resize(120, 120, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//
//            $img->stream(); // <-- Key point
//
//            //dd();
//            Storage::disk('public_uploads')->put('userImages'.'/'.$fileName, $img, 'public');
//        }

//        dd($request_data);

        $user = User::create($request_data);
        $user->attachRole('admin');
        if($request->has('permissions') ) {
            $user->syncPermissions($request->permissions);
        }


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
//
//
//        return 'Save successfully';
    }



protected function  getRoles(){
    return [
        'first_name'=> 'required',
        'last_name'=> 'required',
        'email'=> 'required|unique:users',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password'=> 'required|confirmed',
        'permissions' =>'required|min:1',
    ];
}


protected  function  getMessages(){
    return [
        'first_name.required' => __('messages.first_name required'),
        'last_name.required' =>__('messages.last_name required'),
        'email.required' => __('messages.email required'),
    ];
}


/**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(User $user)
    {
//        dd($user);
        return view('dashboard.users.edit', compact('user'));

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
//        dd($request->all());
        $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=>[
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

//        $request_data = $request->except(['permissions']);
        $request_data = $request->only(['first_name','last_name', 'email']);
        if ( $request->image) {
            if( $request->imga != 'default.png' ){
                Storage::disk('public_uploads')->delete('userImages/'.$user->image);
            }

           $img = Image::make($request->image)->resize(320, null, function ($constraint) {
                  $constraint->aspectRatio();
              });// to use save method the folder where the file will save in it mustn't link with storage (*_~)
            $img->stream(); // <-- Key point
//
//            //dd();
            $fileName = $request->image->hashName();
            Storage::disk('public_uploads')->put('userImages'.'/'.$fileName, $img, 'public');

            $request_data['image']= $request->image->hashName();
        }

        $user->update($request_data);
        if($request->has('permissions') ) {

            $user->syncPermissions($request->permissions);

            session()->flash('success', __('site.updated_permission_successfully'));
            return redirect()->route('dashboard.users.index');
//
        }

//        session()->flash('fail', __('site.update_fail'));
        return redirect()->route('dashboard.users.index');

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Delete File from Public Storage Folder

        // method 1:
        // 1: Using File System
            //dd($user->image);
//            if(\File::exists(public_path('uploads/userImages/'.$user->image))){
//                \File::delete(public_path('uploads/userImages/'.$user->image));
//            }else{
//                dd('File does not exists.');
//            }




        // method 2:
        // 2: Using Storage System
//
//           if( Storage::disk('public_uploads')->exists('userImages/'.$user->image)){
//               Storage::disk('public_uploads')->delete('userImages/'.$user->image);
//           }else{
//               dd('File does not exists.');
//           }



        // method 3:
        // 3:  Using Core PHP Functions

        if(file_exists(public_path('uploads/userImages/'.$user->image))){
            unlink(public_path('uploads/userImages/'.$user->image));
        }else{
            dd('File does not exists.');
        }


//        dd($user->image);
//       $disk = Storage::disk('public');
//       dd($disk);
//        $visibility = Storage::getVisibility(public_path('uploads/3.jpeg'));
////        $directories = Storage::directories(public_path());
//        dd($visibility);
//        Storage::disk('uploads')->delete('3.jpeg');

//        Storage::makeDirectory('test');
//        Storage::disk('public_uploads')->delete('userImages/4.png');

//        Storage::deleteDirectory('test');
//        Storage::disk('uploads')->put('public/uploads/2.jpeg', $content);
//        Storage::delete('public/uploads/userImages/vvEXVeEmMNeetOWTZk52EzmCvemAVNmwanT9DTGv.jpeg');
//        Storage::disk('public')->delete('\555.jpeg');
//        dd($user->image);
//        if($user->image != 'default.png'){

//            Storage::disk('public_uploads')->delete('userImages/'.$user->image);
//            555.jpeg



//        } // end of if

        $user->delete();

        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    } // end of destroy

} // end controller
