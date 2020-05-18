<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class EmpHealth extends Model{


    use Sortable;
    protected $table = 'emp_health';
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'emp_health_id' => '',
        'emp_no' => '',
        'fullname' => '',
        'department_text' => '',
        'position' => '',
        'contact_no' => '',
        'address' => '',
        'birthday' => null,
        'sex' => '',
        'civil_status' => '',
        'height' => '',
        'weight' => '',
        'philhealth_no' => '',
        'bloodtype' => '',
        'family_doctor' => '',
        'contact_person' => '',
        'travel_history' => '',
        'is_has_sick_history' => false,
        'is_has_sick_history_hos_visited' => '',
        'is_has_sick_history_condition' => '',
        'is_has_fever_history' => false,
        'is_has_fever_history_condition' => '',
        'is_smoking' => false,
        'is_smoking_packs_per_day' => '',
        'is_drinking_alcohol' => false,
        'is_drinking_alcohol_how_often' => '',
        'is_taking_drugs' => false,
        'is_taking_drugs_specific' => '',
        'is_taking_vitamins' => false,
        'is_taking_vitamins_specific' => '',
        'is_wearing_eyeglass' => false,
        'is_wearing_eyeglass_va' => '',
        'is_exercising' => false,
        'is_exercising_how_often' => '',
        'is_treating_medical_condition' => false,
        'is_treating_medical_condition_medicines' => '',
        'is_has_chronic_illness' => false,
        'is_has_chronic_illness_details' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    /** RELATIONSHIPS **/
    public function empHealthMedHistory() {
        return $this->hasMany('App\Models\EmpHealthMedHistory','emp_health_id','emp_health_id');
    }



}
