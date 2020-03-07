<?php

namespace App\Http\Controllers\backend;

use Flash;
use App\User;
use App\Model\Role;
use App\Model\Image;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = User::excludeAdmin()->get();

        return view('Backend.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        //get all role
        $role = Role::select('id','name')->pluck('name','id')->toArray();
        
        return view('Backend.user.create', compact('role', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  CreateUserRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $requestData = $request->all();
        try{
            
            if(isset($requestData['password']) && !empty($requestData['password']))
                $requestData['password'] = bcrypt($requestData['password']);
            
            $requestData['status'] = '1';

            $user = User::create($requestData);
            Flash::success("User added successfully!")->important();
            return redirect('user');
        } catch (PDOException $e) {
            if(isset($request['debug']) && $request['debug'] == true)
                return $e;
            return redirect()->back()->withInput(request()->all());
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {   
        $role = Role::select('id','name')->pluck('name','id')->toArray();
        return view('Backend.user.edit', compact('user', 'role', 'company', 'arrCompanyUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  User $user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        if(empty($user)){
            Flash::error("No record found!")->important();
            return redirect('user');
        }
        
        $requestData = $request->all();
        try{
            
            if(isset($requestData['password']) && !empty($requestData['password']))
                $requestData['password'] = bcrypt($requestData['password']);
              
            $requestData = array_filter($requestData);
            $user = $user->update($requestData);
            Flash::success("User updated successfully!")->important();
            return redirect('user');
        } catch (PDOException $e) {
           
            if(isset($request['debug']) && $request['debug'] == true)
                return $e;
            return redirect()->back()->withInput(request()->all());
        }
    }
    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(empty($user)){
            Flash::error("No record found!")->important();
            return redirect('user');
        }

        User::destroy($id);
        Flash::success("User deleted successfully!")->important();
        return redirect('user');
    }
}