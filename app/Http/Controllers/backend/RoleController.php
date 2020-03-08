<?php

namespace App\Http\Controllers\backend;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();
        
        return view('Backend.role.index', compact('roles'));
    }
}
