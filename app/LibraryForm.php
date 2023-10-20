<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class LibraryForm extends Model
{
    //
    protected $fillable = [
        'name','form_cat_id','business_cat_id','file_path','form_data','status',
    ];


 
 public static function get_library_forms($form_cat_id)
  {
      // $data=LabTest::where(['lab_tests.client_id'=>$client_id])
      //    ->join('users', 'users.id', '=', 'lab_tests.login_id')       
      //    ->select('lab_tests.*','users.email','users.name')
      //    ->orderBy('lab_tests.id','DESC')
      //    ->get();
       
       $data= LibraryForm::where(['library_forms.form_cat_id'=>$form_cat_id,'library_forms.status'=>1,'business_categories.is_medical'=>'yes'])
       ->join('business_categories', 'business_categories.id', '=', 'library_forms.business_cat_id')
       ->select('library_forms.*')
       ->orderBy('library_forms.name','asc')->get();
        return $data; 
  }




}
