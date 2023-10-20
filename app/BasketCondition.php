<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketCondition extends Model
{
    //

    protected $fillable = [
        'active_affiliates','plus_users','from_date','to_date','closest_contacts','categories','place_basket','basket_id','status',
    ];  



 public static function get_categories_list($category_data){

   $data='';
    $category_data=explode(',',$category_data);
    $cat_name=array();
    if(!empty($category_data))
    {
        foreach ($category_data as $cat_id) {
        $data=LeadsCategory::find($cat_id);
        $cat_name[]=$data->category;
       }
       $data=implode(',', $cat_name);
    }
    

    return $data;

    }







}
