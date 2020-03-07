<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Image extends Model
{
    use SoftDeletes;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'files';

	/**
	* The database primary key value.
	*
	* @var string
	*/
	protected $primaryKey = 'id';

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['file_name'];
    
    /**
    * Function to define the image & banner relation
    */ 
    public function fn_banner() {
        return $this->hasOne('App\Model\Banner');
    }

     /**
    * Function scopeStoreImages
    * scope query to store Images details
    * @param array $request 
    * @param int $int_id 
    */
    public function scopeStoreFile($query, $request, $folder_name=null,$int_id = null)
    {
        $request_data = request()->all();        
        try {
            if ($int_id != null){
                $uploadimage_obj = $this->find($int_id);
                if (isset($uploadimage_obj) && !empty($uploadimage_obj)){
                    $strPath = storage_path().'/app/public/'.$folder_name.'/'.$uploadimage_obj->image;
                        if (file_exists($strPath))
                            unlink($strPath);
                }                    
            }         
            DB::beginTransaction();
                $response = $this->updateOrCreate(['id' => $int_id],$request);
            } catch (PDOException $e) {
                DB::rollback();
                return 0;
            }
        DB::commit();
        return $response->id;
    }
}
