<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Image;
use Config;
use App\User;
use App\Model\Image as ImageModel;
use Illuminate\Http\Request;

class ImageMediaController extends Controller
{

    /**
     * Function fn_uploadimages
     * store the registry images.
     * @param $request
     * @return $response
     */
    public function fn_uploadimages()
    {
        $request = request()->all();
        $str_file_name = store_file('uplaod-images', $request['image']);
        /* Store the image name in upload image table for registry*/
        try {
            $response = ImageModel::create([
                'file_name' => $str_file_name
            ]);
            $arr_image_details = ['img_name' =>$response->file_name, 'id'=>$response->id, "image_path" =>  asset('storage/uplaod-images/'.$str_file_name) ];
            
            return $arr_image_details;
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function fn_removeimage(Request $request) {
        $requestData = $request->all();
        if(empty($requestData))
            return 0;

        try {
            if(!empty($requestData['user_id'])) {
                $user = User::find($requestData['user_id']);
                $user->profile_pic_id = null;
                $user->save();
            }
            
            $file = ImageModel::find($requestData['profile_pic_id']);

            $strPath = storage_path().'/app/public/uplaod-images/'.$file->file_name;
            if (file_exists($strPath)){
                unlink($strPath);
                $file->delete();
                return 1; 
            } 
        } catch (Exception $e) {
            return 0;
        }
    }
}