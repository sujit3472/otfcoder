<?php

namespace App\Concerns;
use App\Model\Image;
trait HasUserAccessors
{
    /**
     * Full name accessor
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    /**
     * Get company Status
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusNameAttribute($value)
    {   
        return ($this->status == 1) ? 'Active' : 'Inactive';
    }

    /**
     * Function getStatusClassAttribute
     * getar model method to retrive class depends on db status value
     * @return [statusClass]
     */
    public function getStatusClassAttribute()
    {
        $statusClass = ($this->attributes['status'] == "1") ? "label-inverse" : "label-danger";
        return $statusClass;
    }

    /*
	* get user profile image		
	*/
    public function getAvatarAttribute()
    {             

        if (isset($this->profile_pic_id) && !empty($this->profile_pic_id)) {
            $image_name =  Image::find($this->profile_pic_id);            
            if (is_null($image_name))
                return asset('storage/uploads/test.png');
            $value = asset('storage/uplaod-images').'/'.$image_name->file_name;
        } else{
            $value = '';
        }        
        return $value;
    }
}