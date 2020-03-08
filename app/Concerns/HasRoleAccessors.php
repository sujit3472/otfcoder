<?php

namespace App\Concerns;

trait HasRoleAccessors
{
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
}