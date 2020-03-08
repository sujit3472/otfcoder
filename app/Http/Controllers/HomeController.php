<?php
namespace App\Http\Controllers;
use Flash;
use Auth;
use DB;
use App\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function fn_user_home() 
    {
        return view('home');   
    }

    /**
    * Function fn_change_status
    * used for change location status
    * @param $request : HTTP Request
    */
    public function fn_change_status(Request $request)
    {
        $requestData = $request->all();
       // dd($requestData);
        if(!empty($requestData))
        {   
            $this->int_id       = $requestData['int_id'];
            $this->changeStatus = $requestData['change_action'];
            $this->modelName    = $requestData['modelName'];
            if($this->changeStatus == "Active")
                $this->changeStatus = 1;
            else
                $this->changeStatus = 2;
            ##find the record
            try {
                $objCommon = $this->modelName::findOrFail($this->int_id);
            } catch (ModelNotFoundException $exception) {
                return 0;
            }
            
            ##if record not found 
            if(empty($objCommon))
                return 0;
            ##update the information
            DB::beginTransaction();
            try {
                $objCommon->status = $this->changeStatus;
               // print_r($this->changeStatus);
               $update_status = $objCommon->update();
            } catch (Exception $e) {
                DB::rollback();
                return 0;
            }
            DB::commit();
            return $this->changeStatus;
        } else {
            return 0;
        }
    }

    /**
    * function fn_change_passsword
    * Change paaword.
    **/
    public function fn_change_passsword()
    {
        $arrInput = request()->all();
        $this->validate(request(), [
            'password' => 'required|confirmed|min:6|max:20',            
        ]);
        try {
            Auth::user()->password = bcrypt ($arrInput['password']);
            Auth::user()->save();
            Flash::success(trans('label.passwordupdate'))->important();
        } catch (Exception $e) {
            Flash::error(trans('label.database_error'))->important();
            return redirect()->back();
        }
        return redirect('/home');
    }
}
