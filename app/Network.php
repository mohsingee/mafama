<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Network extends Model
{
    //

     protected $fillable = [
        'user_id','sponsor_id','status',
    ];
    
   
     public static function get_user_sponsor_ship_list($sponsor_id){
         
        $data=Network::where(['networks.sponsor_id'=>$sponsor_id])
         ->join('users', 'users.id', '=', 'networks.user_id')
         ->select('networks.*','users.name','users.plan_id','users.team_members')
         ->get();
         return $data;
    
     }
    
    
     public static function get_user_profile_pic($user_id){
         $user=User::where('id',$user_id)->first();
        if($user->status !=2) 
        {
             if(!empty($user->image)){
                $img=asset('uploads/user/'.$user->image);
             }
             else
             {
               $img= asset('public/web_assets/img/default.jpg');
             }
        }else{
            
          $img= asset('public/web_assets/img/deleted-user.png');
        }
         
         return $img;
     }
    
     public static function get_user_point($user_id){ 
         $data=AccessMonitoring::where('user_id',$user_id)->first();
         if($data){
             return $data->earned_points;
         }else{
             return 0;
         }
        
       
     }
    public function user_details(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
     public static function user_tree_info($user_id){ 
        $html='';
        ob_start();
        $user=User::get_user_info($user_id);
        ?>
        <a href="javascript:void(0);"   class="tree_user badge-<?= User::get_user_info($user_id)->plan_id;?>"  >
             <?= $user->name?> <?php if($user->plan_id !=1 && $user->id!=1 ){ ?><span class="badge badge-success">PU</span> <?php } ?>
           </a>  <span class="lbl_txt">
            <?php if($user_id !==1)  { ?>
            | Level <?=User::get_user_info($user_id)->level ;?> 
            <?php } ?>
           | ID <?=$user_id;?> 
           | Balance <?=Balance_info::get_wallet_balance($user_id);?> 
           | Points <?=Network::get_user_point($user_id);?> 
           | <?=User::get_user_info($user_id)->team_members ;?> downlines members
           | <?=User::get_user_info($user_id)->direct_members ;?> direct members 
           
           </span>
        <?php
        $html =ob_get_clean();
        return $html;
     }
            
         
     public static function get_my_network($user_id,$sponsor_id=''){
        //   $start_date='2021-02-01';
        //   $end_date='2021-02-12';
        //   $cdate=date('Y-m-d');
        // if($cdate >=$start_date  && $cdate<= $end_date){  
        //   echo " ok"; 
            
        // }else{
        //     echo "not ok";
        // }
        // die;
        $html='';
        ob_start();
        if(!empty($sponsor_id) && $sponsor_id!=$user_id)
        {
           
          
        ?>
       
       <!-- <a href="" class="back-btn-c" onclick="return get_child(<?=Auth::user()->id;?>,<?=Auth::user()->id;?>)" > <i class="fa fa-arrow-left fa-3x"></i> </a>-->
        <?php } ?>
           <li id="main_id" data-id="<?=$user_id;?>">
         <?=Network::user_tree_info($user_id);?> 
         <?php   //level 1
         $networks=Network::get_user_sponsor_ship_list($user_id);
            if($networks->count() >0)
            {
            ?>
            <ul>                
            <?php
                 foreach($networks as $network){ 
                 ?>
               <li>  <?=Network::user_tree_info($network->user_id);?>     
               
               <?php   //level 2
              $networks1=Network::get_user_sponsor_ship_list($network->user_id);
               if($networks1->count() >0)
                {
                ?>
                <ul>                
                <?php
                     foreach($networks1 as $network1){ 
                     ?>
                   <li>     <?=Network::user_tree_info($network1->user_id);?>   
                       
                   
                        <?php   //level 3
                          $networks2=Network::get_user_sponsor_ship_list($network1->user_id);
                           if($networks2->count() >0)
                            {
                            ?>
                            <ul>                
                            <?php
                                 foreach($networks2 as $network2){ 
                                 ?>
                               <li> <?=Network::user_tree_info($network2->user_id);?>   
                                            
                                <?php if(Auth::user()->id==1){ ?>
                                 <?php   //level 4
                                  
                                  $networks3=Network::get_user_sponsor_ship_list($network2->user_id);
                                   if($networks3->count() >0)
                                    {
                                    ?>
                                    <ul>                
                                    <?php
                                         foreach($networks3 as $network3){ 
                                         ?>
                                       <li>  <?=Network::user_tree_info($network3->user_id);?>   
                                              <?php   //level 5
                                              $networks4=Network::get_user_sponsor_ship_list($network3->user_id);
                                               if($networks4->count() >0)
                                                {
                                                ?>
                                                <ul>                
                                                <?php
                                                     foreach($networks4 as $network4){ 
                                                     ?>
                                                   <li> <?=Network::user_tree_info($network4->user_id);?>   
                                                        <?php   //level 6
                                                          $networks5=Network::get_user_sponsor_ship_list($network4->user_id);
                                                           if($networks5->count() >0)
                                                            {
                                                            ?>
                                                            <ul>                
                                                            <?php
                                                                 foreach($networks5 as $network5){ 
                                                                 ?>
                                                               <li>  <?=Network::user_tree_info($network5->user_id);?>   </li>
                                                               <?php } ?>
                                                            </ul>
                                                          <?php 
                                                           } ?>
                                                   
                                                   </li>
                                                   <?php } ?>
                                                </ul>
                                              <?php 
                                               } ?>
                                       </li>
                                       <?php } ?>
                                    </ul>
                                  <?php 
                                   } ?>
                                   <?php } ?>
                               </li>
                               <?php } ?>
                            </ul>
                          <?php 
                           } ?>
                   
                   </li>
                   <?php } ?>
                </ul>
              <?php 
                 } ?>
               
               </li>
               <?php } ?>
            </ul>
          <?php 
             } ?>
          </li>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>       
 <script src="<?= asset('public/genealogy/tree_new.js');?>"></script>
       <?php  
       
       
           
    
       
       
        $html=ob_get_clean();
        return $html;
                                    
        
    }
    

    
    
}