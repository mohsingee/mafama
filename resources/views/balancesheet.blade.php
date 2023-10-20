@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Financial Management / Balance Sheet</h4>
                        </div>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                        <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                        <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily
                            Briefing</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>

                    <div class="col-md-12">
                        <div class="tab-content margin-top-10" style="">
                            <div class="col-md-12 margin-bottom-40 margin-top-20 padding-0 shadow-boxx">
                                <div class="col-md-12 padding-0 text-center margin-top-20">
                                    <h4 style="font-size: 30px; margin-bottom: 0px;">Balance Sheet</h4>
                                </div>
                                <div class="clearfix"></div>
                                <div class="divider divider-center divider-short margin-top-10 margin-bottom-10">
                                    <!-- divider -->
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="col-md-6 margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="col-md-12 padding-0 margin-top-20">
                                            <h4>Assets</h4>
                                            <table class="table margin-bottom-10" style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;">
                                                            <b>Current Assets : </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Checking Account :</td>
                                                        <td>5,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Saving Account :</td>
                                                        <td>1,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Petty Cash :</td>
                                                        <td>500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Accounts Receivable :</td>
                                                        <td>22,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Inventory :</td>
                                                        <td>15,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prepaid Insurance :</td>
                                                        <td>6,000</td>
                                                    </tr>
                                                    <tr class="total-tr">
                                                        <td><b>Total Current Assets : </b></td>
                                                        <td><b>49,500</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"
                                                            style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;">
                                                            <b>Non-current Assets : </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Accumulated Depreciation :</td>
                                                        <td>-4,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Computer, Office Equipments :</td>
                                                        <td>7,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Building :</td>
                                                        <td>65,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Land :</td>
                                                        <td>60,000</td>
                                                    </tr>
                                                    <tr class="total-tr">
                                                        <td><b>Total Non-current Assets : </b></td>
                                                        <td><b>127,500</b></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: left;"><b>Total Assets : </b></td>
                                                        <td><b>177,000</b></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="col-md-12 padding-0 margin-top-20">
                                            <h4>Liabilities & Equity</h4>
                                            <table class="table margin-bottom-10" style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;">
                                                            <b>Liabilities : </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" style="text-align: left; color: #da291c;">
                                                            <b>Current Liabilities : </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Account Payable :</td>
                                                        <td>12,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Line of Credit :</td>
                                                        <td>20,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payroll Liabilities :</td>
                                                        <td>7,000</td>
                                                    </tr>
                                                    <tr class="total-tr">
                                                        <td><b>Total Current Liabilities : </b></td>
                                                        <td><b>39,000</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2" style="text-align: left; color: #da291c;">
                                                            <b>Non-current Liabilities : </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Long Term Debt(loan) :</td>
                                                        <td>48,000</td>
                                                    </tr>
                                                    <tr class="total-tr">
                                                        <td><b>Total Non-current Liabilities : </b></td>
                                                        <td><b>48,000</b></td>
                                                    </tr>
                                                    <tr class="total-tr">
                                                        <td style="text-align: left;"><b>Total Liabilities : </b></td>
                                                        <td><b>87,000</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"
                                                            style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;">
                                                            <b>Equity : </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Owners Capital :</td>
                                                        <td>35,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Retained Earnings :</td>
                                                        <td>55,000</td>
                                                    </tr>
                                                    <tr class="total-tr">
                                                        <td><b>Total Equity : </b></td>
                                                        <td><b>90,000</b></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: left;"><b>Total Liabilities & Equity : </b>
                                                        </td>
                                                        <td><b>177,000</b></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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
@endsection
