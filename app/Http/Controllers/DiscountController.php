<?php

namespace App\Http\Controllers;

use App\AffiliateRegistration;
use App\Discount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function apply_on_acc(Request $request)
    {
        // return $request;
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }

        // $exist1 = \DB::table('revenue_account')->where('uid', $uid)->where('account_name', $request->acc)->first();
        $exist1 = \DB::table('revenue_account')->where('uid', $uid)->get();

        if (empty($exist1)) {
            return 123;
        }



        foreach ($exist1 as $exi) {

            if ($exi->amount == null) {
                $exi->amount = 0;
            }

            if ($request->val < 1) {
                $new_val = round(($exi->amount)*(1+$request->val),0);
            } else {
                $new_val = round(($exi->amount)+($request->val),0);
            }

            $values = array(
                'amount'   => $new_val
            );

            \DB::table('revenue_account')->where('uid', $uid)->where('account_name', $exi->account_name)->update($values);

        }





    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disc = new Discount();
        $disc->per_1 = $request->per_1;
        $disc->per_2 = $request->per_2;
        $disc->per_3 = $request->per_3;
        $disc->per_4 = $request->per_4;
        $disc->per_5 = $request->per_5;
        $disc->flat_1 = $request->flat_1;
        $disc->flat_2 = $request->flat_2;
        $disc->flat_3 = $request->flat_3;
        $disc->flat_4 = $request->flat_4;
        $disc->flat_5 = $request->flat_5;

        $disc->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function email_invoice(Request $request)
    {
        $uemail = "";
        if((Auth::user()->role) == "affiliate"){
            $uemail = Auth::user()->email;
        }
        else{
            $uemail = Auth::user()->affiliate_user_email;
        }


        $client = \DB::table('client_appointment_lists')->where('email', $request->client_id)->first();


        $id = explode(',', $request->invoice_id);
        $bill = 0;
        $discount = 0;
        $tax = 0;
        $date = null;
        $acc = null;
        $shipping = 0;
        $total = 0;
        $amount_paid = 0;
        $balance = 0;
        $arr = [];
        $list = \DB::table('revenue_record')->whereIn('id', $id)->get();
        foreach ($list as $value) {
            $bill = $bill + $value->bill;
            $discount = $discount + $value->discount;
            $tax = $tax + $value->tax;
            $shipping = $shipping + $value->shipping;
            $total = $total + $value->total;
            $amount_paid = $amount_paid + $value->amount_paid;
            $balance = $balance + $value->balance;
            $date = date("d F Y", strtotime($value->transaction_date));
            $acc = $value->account_description;

        }

        $data2 = array(
            'email'       =>   $request->client_id,
            'date'       =>   $date,
            'acc'       =>   $acc,
            'bill'       =>   $bill,
            'name'       =>   $client->first_name." ".$client->last_name,
            'phone'       =>   $client->cell_phone,
            'address'       =>   $client->address,
            'company'       =>   $client->company,
            'work_phone'       =>   $client->work_phone,
            'discount'       =>   $discount,
            // 'after'       =>   $request->after,
            'tax'       =>   $tax,
            'shipping'       =>   $shipping,
            'total'       =>    $total,
            'amt'       =>   $amount_paid,
            'blnc'       =>   $balance,
            'banner' => \DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first()
        );


    // Mail::to('muhammadrehanj@gmail.com')->send(new InvoiceMail($data2));
    Mail::to($request->client_id)->send(new InvoiceMail($data2));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $uid = Auth::id();
        // dd($uid);
        $disc = Discount::where('uid',$uid)->first();

        if (empty($disc)) {
            $disc = new Discount();
            $disc->uid = $uid;
            $disc->per_1 = $request->per_1;
            $disc->per_2 = $request->per_2;
            $disc->per_3 = $request->per_3;
            $disc->per_4 = $request->per_4;
            $disc->per_5 = $request->per_5;
            $disc->flat_1 = $request->flat_1;
            $disc->flat_2 = $request->flat_2;
            $disc->flat_3 = $request->flat_3;
            $disc->flat_4 = $request->flat_4;
            $disc->flat_5 = $request->flat_5;

            $disc->save();

            return back();
        } else {
            $disc->uid = $uid;
            $disc->per_1 = $request->per_1;
            $disc->per_2 = $request->per_2;
            $disc->per_3 = $request->per_3;
            $disc->per_4 = $request->per_4;
            $disc->per_5 = $request->per_5;
            $disc->flat_1 = $request->flat_1;
            $disc->flat_2 = $request->flat_2;
            $disc->flat_3 = $request->flat_3;
            $disc->flat_4 = $request->flat_4;
            $disc->flat_5 = $request->flat_5;

            $disc->update();

            return back()->with("status", "Discount Setting is updated successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function discount_apply(Request $request)
    {
        $discount = $request->discount;
        // $disc = Discount::first();
        $uid = Auth::id();
        $disc = Discount::where('uid', $uid)->first();


        $apply_disc = [];

        if ($discount == "Member Reciprocal Discount") {
            if ($disc->per_1 != null) {
                $apply_disc['value'] = $disc->per_1;
                $apply_disc['type'] = "percentage";
            } else {
                $apply_disc['value'] = $disc->flat_1;
                $apply_disc['type'] = "flat";
            }
        }

        if ($discount == "Military Discount") {
            if ($disc->per_2 != null) {
                $apply_disc['value'] = $disc->per_2;
                $apply_disc['type'] = "percentage";
            } else {
                $apply_disc['value'] = $disc->flat_2;
                $apply_disc['type'] = "flat";
            }
        }

        if ($discount == "Student Discount") {
            if ($disc->per_3 != null) {
                $apply_disc['value'] = $disc->per_3;
                $apply_disc['type'] = "percentage";
            } else {
                $apply_disc['value'] = $disc->flat_3;
                $apply_disc['type'] = "flat";
            }
        }

        if ($discount == "Senior Citizen Discount") {
            if ($disc->per_4 != null) {
                $apply_disc['value'] = $disc->per_4;
                $apply_disc['type'] = "percentage";
            } else {
                $apply_disc['value'] = $disc->flat_4;
                $apply_disc['type'] = "flat";
            }
        }

        if ($discount == "Welcome Discount") {
            if ($disc->per_5 != null) {
                $apply_disc['value'] = $disc->per_5;
                $apply_disc['type'] = "percentage";
            } else {
                $apply_disc['value'] = $disc->flat_5;
                $apply_disc['type'] = "flat";
            }
        }
        return $apply_disc;
    }

    public function phone(Request $request)
    {
        $request->validate([
            'phone' => ['required']
         ]);

        $phone = $request->phone;


        // $aff = User::where('phone',$phone)->first();
        $aff = AffiliateRegistration::where('cellphone', $phone)->orWhere('business_telephone', $phone)->first();
        // $aff = AffiliateRegistration::where('cellphone', $phone)->first();


        $busi = "---";
        // affiliate_registrations
        if (!empty($aff)) {
            // $affiliate_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
            $business = \DB::table('affiliate_banner')->where('affiliate_email', $aff->email)->first();
            if($business->business_name != ''){
                $busi = $business->business_name;
            } elseif(!empty($aff->company)){
                $busi = $aff->company;
            }
        }

        // return $business;




        // $disc = Discount::first();
        $uid = Auth::id();
        $disc = Discount::where('uid', $uid)->first();

        if(empty($disc)){
            return '123';
        }

        $disc1 = $disc->per_1;
        $disc2 = $disc->per_2;
        $disc3 = $disc->per_3;
        $disc4 = $disc->per_4;
        $disc5 = $disc->per_5;

        if ($disc1 == null) {
            $disc1 = 0;
        }

        if ($disc2 == null) {
            $disc2 = 0;
        }

        if ($disc3 == null) {
            $disc3 = 0;
        }

        if ($disc4 == null) {
            $disc4 = 0;
        }

        if ($disc5 == null) {
            $disc5 = 0;
        }
        if ($aff != null) {
            echo '
            <div class="row">
                <div class="col-md-7" style="float:right !important; padding-bottom: 15px; display:flex">
                    <input class="form-control" type="text" name="" id="phone_number" placeholder="Enter Member,s Phone Number">
                    <a class="btn btn-sm btn-info" style="margin-left: 5px" href="" onclick="find()">Find</a>
                </div>

                <div class="col-md-6" style="margin-bottom: 10px; margin-top: 10px; padding-bottom: 8px; padding-top: 8px; display:flex; border: 1px solid red">
                    <div>
                        <div>
                            <b style="color:#0f838e">Country of Residence : </b>'.$aff->country.'
                        </div>

                        <div>
                            <b style="color:#0f838e">State/Province/Commune : </b>'.$aff->state .'
                        </div>
                        <div>
                            <b style="color:#0f838e">First Name : </b>'.$aff->first_name.'
                        </div>

                        <div>
                            <b style="color:#0f838e">Last Name : </b>'.$aff->last_name.'
                        </div>

                        <div>
                            <b style="color:#0f838e">Business Name : </b>'.$busi.'
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <img src="./public/images/'.$aff->image.'" style="height: 250px" />
                </div>

                <div class="col-md-7">
                    <h5 style="font-size: 16px; margin-bottom: 14px;">Discount Types</h5>
                    <div class="d-flex padding-bottom-10" id="disc_m">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" checked value="Member Reciprocal Discount"/>
                                <i></i>
                                Member Reciprocal Discount
                            </label>
                        </div>
                    </div>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Military Discount"/>
                                <i></i>
                                Military Discount
                            </label>
                        </div>
                    </div>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Student Discount"/>
                                <i></i>
                                Student Discount
                            </label>
                        </div>
                    </div>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Senior Citizen Discount"/>
                                <i></i>
                                Senior Citizen Discount
                            </label>
                        </div>
                    </div>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Welcome Discount"/>
                                <i></i>
                                Welcome Discount
                            </label>
                        </div>
                    </div>
                </div>
                <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                    <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                        <h5 style="font-size: 16px; margin-bottom: 14px;">%age</h5>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc1.' %">
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc2.' %">
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc3.' %">
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc4.' %">
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc5.' %">
                            </div>
                        </div>
                    </div>

                    <div style="padding-left:0px !important;padding-right:0px !important" class="col-md-2">

                        <h5 style="font-size: 16px; margin-bottom: 14px;">OR</h5>

                    </div>

                    <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                        <h5 style="font-size: 16px; margin-bottom: 14px;">Flat</h5>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_1.'>
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_2.'>
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_3.'>
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_4.'>
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_5.'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        } else{
            echo '
            <div class="row" id="not_found">
                <div class="col-md-7" style="float:right !important; padding-bottom: 15px; display:flex">
                    <input class="form-control" type="text" name="" id="phone_number" placeholder="Enter Member,s Phone Number">
                    <a class="btn btn-sm btn-info" style="margin-left: 5px" href="" onclick="find()">Find</a>
                </div>
                <div class="col-md-7">
                    <h5 style="font-size: 16px; margin-bottom: 14px;">Discount Types</h5>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Military Discount"/>
                                <i></i>
                                Military Discount
                            </label>
                        </div>
                    </div>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Student Discount"/>
                                <i></i>
                                Student Discount
                            </label>
                        </div>
                    </div>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Senior Citizen Discount"/>
                                <i></i>
                                Senior Citizen Discount
                            </label>
                        </div>
                    </div>

                    <div class="d-flex padding-bottom-10">
                        <div>
                            <label class="radio margin-left-0 margon-top-0">
                                <input type="radio" name="mem_discount" value="Welcome Discount"/>
                                <i></i>
                                Welcome Discount
                            </label>
                        </div>
                    </div>
                </div>
                <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                    <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                        <h5 style="font-size: 16px; margin-bottom: 14px;">%age</h5>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc2.' %">
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc3.' %">
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc4.' %">
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="'.$disc5.' %">
                            </div>
                        </div>
                    </div>

                    <div style="padding-left:0px !important;padding-right:0px !important" class="col-md-2">

                        <h5 style="font-size: 16px; margin-bottom: 14px;">OR</h5>

                    </div>

                    <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                        <h5 style="font-size: 16px; margin-bottom: 14px;">Flat</h5>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_2.'>
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_3.'>
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_4.'>
                            </div>
                        </div>
                        <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                            <div class="">
                                <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value='.$disc->flat_5.'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }
}
