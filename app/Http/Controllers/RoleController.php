<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\PermissionAccess;
use App\User;
use App\CmsNotification;
use Illuminate\Support\Facades\Hash;
use Session;

class RoleController extends Controller
{
    //
    public function admin_roles()
    {
        if(permission_access('admin_roles_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
         $data['roles']=PermissionAccess::get() ;
       return view('admin.access_role.admin_roles',$data);
    }

    public function add_new_role($id="")
    {
        if(permission_access('admin_roles_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
           
           if(permission_access('admin_roles_edit')!=1  &&  $id !='')
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }  
           
        $data['mrole']=$data['permit']='';
        if($id !=''){
         $data['mrole']=PermissionAccess::find($id);
         $data['permit'] = json_decode($data['mrole']->permission);
         }
         $data['roles']=PermissionAccess::get() ;
      
       return view('admin.access_role.add_new_role',$data);
    }


    public function admin_list()
    {
        if(permission_access('admin_list_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
         $data['users']=User::where('users.role','admin')->where('users.id','!=',1)
                               ->leftJoin('permission_accesses','permission_accesses.id', '=','users.admin_per_id') 
                               ->select('users.*','permission_accesses.admin_role')
                               ->orderBy('users.id','desc')
                               ->get()
                               ;
       return view('admin.access_role.admin_list',$data);
    }

    public function add_new_admin($id="")
    {
         if(permission_access('admin_list_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
           
           if(permission_access('admin_list_edit')!=1  &&  $id !='')
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }  
        $data['admin']='';
        if($id !=''){
         $data['admin']=User::find($id);
        $data['permit'] = json_decode($data['admin']->permission);
         }
         $data['roles']=PermissionAccess::get() ;
      
       return view('admin.access_role.add_new_admin',$data);
    }



// manage project 
  
    public function manageAdminAccount(Request $request)
    {   
      //  echo "<pre>";
    //  print_r($request->all());die();
        $success = false;
        $message = "";
        $url = "";
      //  $check=User::where('username',$request->username)->count(); 
        

        if(isset($request->permission)){
         $permission = json_encode($request->permission,JSON_UNESCAPED_UNICODE);

        }else{
         $permission = json_encode($request->permission,JSON_UNESCAPED_UNICODE);
         $message = "Please select atleast one permission.";
        }
        
        
  
        if(empty($request->id))  
        {
          $check1=User::where('email',$request->email)->count();   
         if($check1>0){
           $message= "Email already available";
          }else{
              $data['name']=$request->name;
              $data['email']=$request->email;
              $data['phone']=$request->phone;
              $data['zip_code']=$request->zip_code;
              $data['address']=$request->address;
              $data['city']=$request->city;
              $data['show_pass']=$request->password;
              $data['password']=Hash::make($request->password);
              $data['admin_per_id']=$request->role_id;
              $data['permission']=$permission;
              $data['permission1']=$request->permission1;
              $data['role']='admin';
             
               $q1=User::insert($data);            
                if($q1)
                {
                    $success = true;
                    $message = "admin added successfully";
                    $url = url("admin/admin-list");
                }
                else{
                    $message= "Some Problem Occur try after sometime";
                }
          }
        
       }else{
         $check1=User::where('email',$request->email)->where('id','!=',$request->id)->count();   
         if($check1>0){
           $message= "Email already available";
          }else{  
          $data['name']=$request->name;
           $data['email']=$request->email;
            $data['phone']=$request->phone;
              $data['zip_code']=$request->zip_code;
              $data['address']=$request->address;
              $data['city']=$request->city;
           $data['admin_per_id']=$request->role_id; 
           $data['permission']=$permission;      
           $data['permission1']=$request->permission1;
           if(!empty($request->password))
           {
             $data['password']=Hash::make($request->password);
              $data['show_pass']=$request->password;
           }
          
         $q1=User::where('id',$request->id)->update($data);            
            if($q1)
            {
                $success = true;
                $message = "admin updated successfully";
                $url = url("admin/admin-list");
            }
            else{
                $message= "Some Problem Occur try after sometime";
            }
          }
       }
           
       
               
        echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
         ));


    }


// manage project 
  
    public function manageAdminRole(Request $request)
    {   
      //  echo "<pre>";
    //  print_r($request->all());die();
        $success = false;
        $message = "";
        $url = "";
         if(isset($request->permission)){
         $permission = json_encode($request->permission,JSON_UNESCAPED_UNICODE);

          }else{
        $message = "Please select atleast one permission.";
        }
          $data['admin_role']=$request->role_name;  
          $data['permission']=$permission;  
          $data['status']=1;  
          $role=$request->role_name;
        if(empty($request->id))  
        {
        if (isset($permission)){
           $q1=PermissionAccess::create($data);            
            if($q1)
            {
                $success = true;
                $message = "$role added successfully";
                $url = url("admin/admin-roles");
            }
            else{
                $message= "Some Problem Occur try after sometime";
            }
        }
       }else{

         $q1=PermissionAccess::where('id',$request->id)->update($data);            
            if($q1)
            {
                $success = true;
                $message = "$role updated successfully";
                $url = url("admin/admin-roles");
            }
            else{
                $message= "Some Problem Occur try after sometime";
            }

       }
           
       
               
        echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
         ));


    }



 public function notifications_cms($id="")
    {

       
        $data['i']=1;
        $data['form']="";
        if(!empty($id)){
            $data['form']=CmsNotification::find($id);
        }
        $data['action_list'] = getAllActionList();
        $data['notifications'] = CmsNotification::get();
        return view('admin.notifications')->with($data);
    }



    public function add_edit_notification_cms(Request $request)
    {

        $values = array('action_id' => $request->action_id,'message' => $request->message);
        if(empty($request->id))
        {
            $check=CmsNotification::where('action_id', $request->action_id)->first();
            if(empty($check))
            {
                CmsNotification::create($values);
            }else{
                CmsNotification::where('action_id', $request->action_id)->update($values);
            }

            Session::flash('success', "Success!");
            return redirect('admin/notification-cms')->with('status',"Message added successfully");
        }else{
            CmsNotification::where('id',$request->id)->update($values);
            Session::flash('success', "Success!");
            return redirect('admin/notification-cms')->with('status',"Message updated successfully");
        }


     }





}
