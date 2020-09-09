<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaratrustController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
//        $users = User::all();
        return view('dashboard.laratrust.index');

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

        // validate data before insert to database
        // make para: array , validation roles, message
        $roles = $this -> getRoles();
//$request->validate($roles); // get error messages from validation en/ar
//        $messages = $this -> getMessages();
////        $validator = Validator::make($request -> all(),$roles, $messages);
        $validator = Validator::make($request -> all(),$roles);

        if($validator -> fails()){
//            return  $validator -> errors();
            return  redirect() ->back() -> withErrors($validator)->withInputs($request -> all());
        }
        $request_data = $request->except('password');
        $request_data['password'] = bcrypt($request->password);

        $user = User::create($request_data);
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
        'email'=> 'required',
        'password'=> 'required|confirmed'
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
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

} // end controller
