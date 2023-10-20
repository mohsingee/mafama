@extends('layouts.main') 
@section('content')
<style>
  
.borderless tr td, .borderless tr th {
    border: none !important;
    text-align: left;
    
}
body {
    background: #B1EA86;
    padding: 30px 0
}
a {
    text-decoration: none;
}
.tooltip {
  position: relative;
  display: inline-block;
}
.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}
.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}
.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
a.copy-text {
    color: #000;
}
.clipboard {
  position: relative;
}
/* You just need to get this field */
.copy-input {
  max-width: 342px;
  width: 100%;
  cursor: pointer;
  background-color: #eaeaeb;
  border:none;
  color:#6c6c6c;
  font-size: 14px;
  border-radius: 5px;
  padding: 10px 45px 10px 15px;
  font-family: 'Montserrat', sans-serif;
 border: #da291c7a 1px solid !important
 /* box-shadow: 0 3px 15px #b8c6db;
 -moz-box-shadow: 0 3px 15px #b8c6db;
  -webkit-box-shadow: 0 3px 15px #b8c6db;*/
}
.copy-input:focus {
  outline:none;
}
.copy-btn {
  width:40px;
  background-color: #eaeaeb;
  font-size: 16px;
  padding: 6px 9px;
  border-radius: 5px;
  border:none;
  color:#6c6c6c;
  margin-left:-50px;
  transition: all .4s;
}
.copy-btn:hover {
  transform: scale(1.1);
  color:#1a1a1a;
  cursor:pointer;
}
.copy-btn:focus {
  outline:none;
}
.copied {
  font-family: 'Montserrat', sans-serif;
  width: 75px;
  display: none;
  position:absolute;
    bottom: 20px;
    left: 0;
    right: 0;
    margin: auto;
  color:#000;
  padding: 15px 15px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 3px 15px #b8c6db;
  -moz-box-shadow: 0 3px 15px #b8c6db;
  -webkit-box-shadow: 0 3px 15px #b8c6db;
}
</style>
<script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
<script type="text/javascript">
    $(function(){
  new Clipboard('.copy-text');
});
</script>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                   
                        <div class="" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4> Profile Information</h4>
                            </div>
                            @if(!empty($user->code) || !empty($user->sponsor_id) )
                                    <div class="row gy-4" style="padding-bottom:20px;">
                                        <div class="col-md-4">
                                            
                                            <div class="form-group">
                                                <label class="form-label">Affiliate Code</label>
                                                
                                                <span class="lbl_text">{{ isset($user->code)?$user->code:'' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            My Profile Link
                                        </label>
                                        
                                      <div class="clipboard">
                                        <input onclick="copy1()" class="copy-input " value="{{ $my_profile_link }}"  id="copyClipboard1" readonly>
                                        <button type="button" class="copy-btn" id="copyButton" onclick="copy1()"><i class="far fa-copy"></i></button>
                                        </div>
                                        <div id="copied-success1" class="copied">
                                          <span>Copied!</span>
                                        </div>    
                                           
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            My Referral Link
                                        </label>
                                         
                                        <div class="clipboard">
                                        <input onclick="copy()" class="copy-input " value="{{ $my_referral_link }}"  id="copyClipboard" readonly>
                                        <button type="button" class="copy-btn" id="copyButton" onclick="copy()"><i class="far fa-copy"></i></button>
                                        </div>
                                        <div id="copied-success" class="copied">
                                          <span>Copied!</span>
                                        </div>
                                    </div>
                                </div>
                                      
                                        
                                        
                                    </div>
                                    
                                    <div class="clearfix"></div>    
                                    <div class="divider"><!-- divider --></div> 
                                @endif  
                                   <div class="row gy-4" style="padding-bottom:20px;">
                                       
                                        
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">First Name</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->first_name:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->last_name:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Cell Phone</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->cellphone:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Business Telephone</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->business_telephone:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Religious Faith</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->religion:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->email:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Street Address</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->address:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Zip Code</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->zip_code:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for=""> City </label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->city:'' }}  </span>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Country</label>
                                                <span class="lbl_text">{{ isset($user->id)?$user->country:'' }}  </span>
                                            </div>
                                        </div>

                                        @if($user->commune!=NULL && $user->department!=NULL  && $user->arrondissement!=NULL)
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="">Commune</label>
                      <span class="lbl_text">{{ isset($user->id)?$user->commune:'' }}  </span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="">Department</label>
                      <span class="lbl_text">{{ isset($user->id)?showdepartmentName($user->department):'' }}  </span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="">Arrondissement </label>
                      <span class="lbl_text">{{ isset($user->id)?$user->arrondissement:'' }}  </span>
                      </div>
                    </div>
                    @endif
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">State/Province</label>
                                            <span class="lbl_text">{{ isset($user->id)?$user->state:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Business Category</label>
                                                <span class="lbl_text">{{ isset($user->id)?$business_category:'' }}  </span>
                                                  
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Business Category (Type)</label>
                                                <span class="lbl_text">{{ isset($user->id)?$lead_category:'' }}  </span>
                                                  
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Profile Picture</label>
                                                <img src="{{ asset('public/images/affiliates/'.$user->image) }}" class="img img-responsive" style="width: 40px">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            
                                            
                                        </div>
                                    </div>
                                     <div class="clearfix"></div>   
                                    <div class="divider"><!-- divider --></div> 
                                    <div class="row gy-4" style="padding-bottom:20px;">
                                        
                                        <div class="col-md-12 text-center" style="margin-top:20px;">
                                            <h6>Billing Information</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="">Street Address</label>
                                                
                                                <span class="lbl_text">{{ isset($user->id)?$user->billing_address:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="">Zip Code</label>
                                                
                                                <span class="lbl_text">{{ isset($user->id)?$user->billing_zip_code:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for=""> City </label>
                                                
                                                <span class="lbl_text">{{ isset($user->id)?$user->billing_city:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">Country</label>
                                                
                                                <span class="lbl_text">{{ isset($user->id)?$user->billing_country:'' }}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="">State/Province</label>
                                            
                                                <span class="lbl_text">{{ isset($user->id)?$user->billing_state:'' }}  </span>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                     <div class="clearfix"></div>   
    
                                    
                                        
                                    
                        </div>
                    
  
                </div>
            </div>
        </div>
    </div>
                              
                              
   
</section>
<script>
    
    function copy() {
  var copyText = document.getElementById("copyClipboard");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  $('#copied-success').fadeIn(800);
  $('#copied-success').fadeOut(800);
}
 function copy1() {
  var copyText = document.getElementById("copyClipboard1");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  $('#copied-success1').fadeIn(800);
  $('#copied-success1').fadeOut(800);
}
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied: " + copyText.value;
}
function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}
</script>
@endsection