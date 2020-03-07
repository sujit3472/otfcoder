<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Flash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(Auth::user()->id);   
        if(empty($user))
            return redirect('/home');
        
        return view('admin.admin-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProfileUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $requestData   = $request->all();
        $user = User::find($id);
        if(empty($user))
            return redirect()->back();
        
        try {
            if(isset($requestData['password']) && !empty($requestData['password']))
                $requestData['password'] = bcrypt($requestData['password']);
                    
            $requestData = array_filter($requestData);
            $user = $user->update($requestData);                
            
            Flash::success(trans('label.profile')." ".trans('label.update_success'))->important();
            return redirect('profile');
        } catch (Exception $e) {
            if(isset($request['debug']) && $request['debug'] == true)
                return $e;
            return redirect()->back()->withInput(request()->all());
        }
    }
}
