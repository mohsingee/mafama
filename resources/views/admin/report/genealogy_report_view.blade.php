<div class="tab-pane active" id="tabItem11">
<div class=" heading-dotted margin-bottom-10 text-center">
   <h5>Yearly Genealogy</h5>
</div>
<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
   <thead>
      <tr  class="nk-tb-item nk-tb-head">
         <th class="nk-tb-col"><span class="sub-text">Name</th>
         @for($i=1;$i<=6;$i++)
         <th class="nk-tb-col"><span class="sub-text">Level {{$i}} </th>
         @endfor
         <th class="nk-tb-col"><span class="sub-text">Total </th>
      </tr>
   </thead>
   <tbody>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>Affiliates (Paid)</span>
         </td>
         @php
         $country='US';
         $total_paid=0;
         @endphp
         @for($i=1;$i<=6;$i++)
         @php
         $paid=getPaidAffiliates($i,$year,$month,$country);
         $total_paid +=$paid;
         @endphp
         <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(0,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
            <span>{{$paid}}</span>
         </td>
         @endfor
         <td class="nk-tb-col" onclick="getYearlyGenealogyRecord(0,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
            <span>{{$total_paid}}</span>
         </td>
      </tr>
      @php
      $total=0;
      $total=$total_paid;
      $array=array();
      @endphp
      @foreach($ranks as $rank)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$rank->assign_position}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @for($i=1;$i<=6;$i++)
         @php
         $mTotal=getGeanologyUserYearly($i,$rank->id,$year,$month,$country);
         $m_sub += $mTotal;
         $total +=$mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(<?=$rank->id;?>,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
            <span>{{$mTotal}}</span>
         </td>
         @endfor
         <td class="nk-tb-col" onclick="getYearlyGenealogyRecord(<?=$rank->id;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      <tr class="nk-tb-item tr-border-red">
         <td class="nk-tb-col">
            <span>Total</span>
         </td>
         @for($i=1;$i<=6;$i++)
         @php
         $paid=getPaidAffiliates($i,$year,$month,$country);
         $tot=getGeanologyUserYearlyTotal($i,$year,$month,$country);
         $tolal_sub=$paid+$tot;
         @endphp
         <td class="nk-tb-col">
            <span>{{$tolal_sub}}</span>
         </td>
         @endfor
         <td class="nk-tb-col">
            <span>{{$total}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
   </tbody>
</table>
</div>
<div class="tab-pane" id="tabItem21">
<div class=" heading-dotted margin-bottom-10 text-center">
   <h5 >Affiliates Monthly Genealogy</h5>
</div>
<div class="row" style="margin-bottom:20px;"></div>
<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
   <thead>
      <tr class="nk-tb-item nk-tb-head">
         <th class="nk-tb-col"><span class="sub-text">Rank</span></th>
         @foreach(getMonthsName() as $m)
         <th class="nk-tb-col"><span class="sub-text">{{ date("M", mktime(0, 0, 0, $m, 10)) }}</span></th>
         @endforeach
         <th class="nk-tb-col"><span class="sub-text">Total</span></th>
      </tr>
   </thead>
   <tbody>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>Affiliates (Paid)</span>
         </td>
         @php

         $total_paid=0;
         @endphp
         @foreach(getMonthsName() as $month)
         @php
         $paid=getPaidAffiliatesMonthly($month,$year,$country);
         $total_paid +=$paid;
         @endphp
         <td class="nk-tb-col" onclick="getMonthlyGenealogy(0,<?=$year?>,<?=$month?>,'<?=$country?>') ">
            <span>{{$paid}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col">
            <span>{{$total_paid}}</span>
         </td>
      </tr>
      @php
      $total=0;
      $total=$total_paid;
      $array=array();
      @endphp
      @foreach($ranks as $rank)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$rank->assign_position}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @foreach(getMonthsName() as $month)
         @php
         $mTotal=getGeanologyUserMonthly($month,$rank->id,$year,$country);
         $m_sub += $mTotal;
         $total +=$mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getMonthlyGenealogy(<?=$rank->id?>,<?=$year?>,<?=$month?>,'<?=$country?>') ">
            <span>{{$mTotal}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      <tr class="nk-tb-item">
         <th class="nk-tb-col">
            <span>Total</span>
         </th>
         @foreach(getMonthsName() as $month)
         @php
         $paid=getPaidAffiliatesMonthly($month,$year,$country);
         $tot=getGeanologyUserMonthlyTotal($month,$year,$country);
         $tolal_sub=$paid+$tot;
         @endphp
         <td class="nk-tb-col">
            <span>{{$tolal_sub}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col tb-col-md">
            <span>{{$total}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
   </tbody>
</table>
</div>
<div class="tab-pane" id="tabItem31">
<div class=" heading-dotted margin-bottom-10 text-center">
   <h5 >Affiliates Quarterly Genealogy</h5>
</div>
<div class="row" style="margin-bottom:20px;"></div>
<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
   <thead>
      <tr class="nk-tb-item nk-tb-head">
         <th class="nk-tb-col"><span class="sub-text">Rank/Quarterly</span></th>
         <th class="nk-tb-col"><span class="sub-text">Jan-Mar</span></th>
         <th class="nk-tb-col"><span class="sub-text">Apr-Jun</span></th>
         <th class="nk-tb-col"><span class="sub-text">Jul-Sep</span></th>
         <th class="nk-tb-col"><span class="sub-text">Oct-Dec</span></th>
         <th class="nk-tb-col"><span class="sub-text">Total</span></th>
      </tr>
   </thead>
   <tbody>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>Affiliates (Paid)</span>
         </td>
         @php

         $total_paid=0;
         @endphp
         @foreach($quarters as $qtr)
         @php
         $start_date=$qtr['start_date'];
         $end_date=$qtr['end_date'];
         $paid=getPaidAffiliatesQuarterly($qtr['start_date'],$qtr['end_date'],$month,$country);
         $total_paid +=$paid;
         @endphp
         <td class="nk-tb-col" onclick="getQuaterlyGenealogy(0,'<?=$start_date?>','<?=$end_date?>',<?=$month?>,'<?=$country?>')">
            <span>{{$paid}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col">
            <span>{{$total_paid}}</span>
         </td>
      </tr>
      @php
      $total=0;
      $total=$total_paid;
      $array=array();
      @endphp
      @foreach($ranks as $rank)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$rank->assign_position}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @foreach($quarters as $qtr)
         @php
         $start_date=$qtr['start_date'];
         $end_date=$qtr['end_date'];
         $mTotal=getGeanologyUserQuarterly($qtr['start_date'],$qtr['end_date'],$rank->id);
         $m_sub += $mTotal;
         $total +=$mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getQuaterlyGenealogy(<?=$rank->id?>,'<?=$start_date?>','<?=$end_date?>',<?=$month?>,<?=$country?>)">
            <span>{{$mTotal}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      <tr class="nk-tb-item">
         <th class="nk-tb-col">
            <span>Total</span>
         </th>
         @foreach($quarters as $qtr)
         @php
         $paid=getPaidAffiliatesQuarterly($qtr['start_date'],$qtr['end_date'],$month,$country);
         $tot=getGeanologyUserQuarterlyTotal($qtr['start_date'],$qtr['end_date'],$month,$country);
         $tolal_sub=$paid+$tot;
         @endphp
         <td class="nk-tb-col">
            <span>{{$tolal_sub}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col tb-col-md">
            <span>{{$total}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
   </tbody>
</table>
</div>
<div class="tab-pane" id="tabItem4">
<div class=" heading-dotted margin-bottom-10 text-center">
   <h5 >Yearly Members</h5>
</div>
<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
   <thead  class="thead-light">
      <tr  class="nk-tb-item nk-tb-head">
         <th class="nk-tb-col"><span class="sub-text">Name</th>
         @for($i=1;$i<=6;$i++)
         <th class="nk-tb-col"><span class="sub-text">Level {{$i}} </th>
         @endfor
         <th class="nk-tb-col"><span class="sub-text">Total </th>
      </tr>
   </thead>
   <tbody>
      @php
      $total=0;
      $array=array();
      @endphp
      @foreach($plans as $plan)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$plan->name}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @for($i=1;$i<=6;$i++)
         @php
         $mTotal=getMemberUserYearly($i,$plan->id,$year,$month,$country);
         $m_sub += $mTotal;
         $total +=$mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getYearlyMemberbylevel(<?=$plan->id?>,<?=$i;?>,<?=$year;?>,'<?=$country;?>')">
            <span>{{$mTotal}}</span>
         </td>
         @endfor
         <td class="nk-tb-col">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      <tr class="nk-tb-item tr-border-red">
         <td class="nk-tb-col">
            <span>Total</span>
         </td>
         @for($i=1;$i<=6;$i++)
         @php
         $tot=getMemberUserYearlyTotal($i,$year,$month,$country);
         $tolal_sub=$tot;
         @endphp
         <td class="nk-tb-col">
            <span>{{$tolal_sub}}</span>
         </td>
         @endfor
         <td class="nk-tb-col">
            <span>{{$total}}</span>
         </td>
      </tr>
</table>
</div>
<div class="tab-pane" id="tabItem5">
<div class=" heading-dotted margin-bottom-10 text-center">
   <h5 > Monthly Members</h5>
</div>
<div class="row" style="margin-bottom:20px;"></div>
<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
   <thead>
      <tr class="nk-tb-item nk-tb-head">
         <th class="nk-tb-col"><span class="sub-text">Plan</span></th>
         @foreach(getMonthsName() as $m)
         <th class="nk-tb-col"><span class="sub-text">{{ date("M", mktime(0, 0, 0, $m, 10)) }}</span></th>
         @endforeach
         <th class="nk-tb-col"><span class="sub-text">Total</span></th>
      </tr>
   </thead>
   <tbody>
      @php
      $total=0;
      $array=array();
      @endphp
      @foreach($plans as $plan)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$plan->name}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @foreach(getMonthsName() as $month)
         @php
         $mTotal=getMemberMonthly($month,$plan->id,$year,$country);
         $m_sub += $mTotal;
         $total +=$mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getMonthlyMember(<?=$month?>,<?=$plan->id?>,<?=$year?>,'<?=$country?>')">
            <span>{{$mTotal}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      <tr class="nk-tb-item">
         <th class="nk-tb-col">
            <span>Total</span>
         </th>
         @foreach(getMonthsName() as $month)
         @php
         $tot=getMemberMonthlyTotal($month,$year,$country);
         $tolal_sub=$tot;
         @endphp
         <td class="nk-tb-col">
            <span>{{$tolal_sub}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col tb-col-md">
            <span>{{$total}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
   </tbody>
</table>
</div>
<div class="tab-pane" id="tabItem6">
<div class=" heading-dotted margin-bottom-10 text-center">
   <h5 > Quarterly Members</h5>
</div>
<div class="row" style="margin-bottom:20px;"></div>
<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
   <thead>
      <tr class="nk-tb-item nk-tb-head">
         <th class="nk-tb-col"><span class="sub-text">Plan/Quarterly</span></th>
         <th class="nk-tb-col"><span class="sub-text">Jan-Mar</span></th>
         <th class="nk-tb-col"><span class="sub-text">Apr-Jun</span></th>
         <th class="nk-tb-col"><span class="sub-text">Jul-Sep</span></th>
         <th class="nk-tb-col"><span class="sub-text">Oct-Dec</span></th>
         <th class="nk-tb-col"><span class="sub-text">Total</span></th>
      </tr>
   </thead>
   <tbody>
      @php
      $total=0;
      $array=array();
      @endphp
      @foreach($plans as $plan)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$plan->name}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @foreach($quarters as $qtr)
         @php
         $start_date=$qtr['start_date'];
         $end_date=$qtr['end_date'];
         $mTotal=getMemberQuarterly($qtr['start_date'],$qtr['end_date'],$plan->id,$month,$country);
         $m_sub += $mTotal;
         $total +=$mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getQuarterlyMember(<?=$plan->id?>,'<?=$start_date?>','<?=$end_date?>','<?=$country?>')">
            <span>{{$mTotal}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      <tr class="nk-tb-item">
         <th class="nk-tb-col">
            <span>Total</span>
         </th>
         @foreach($quarters as $qtr)
         @php
         $tot=getMemberQuarterlyTotal($qtr['start_date'],$qtr['end_date'],$month,$country);
         $tolal_sub=$tot;
         @endphp
         <td class="nk-tb-col">
            <span>{{$tolal_sub}}</span>
         </td>
         @endforeach
         <td class="nk-tb-col tb-col-md">
            <span>{{$total}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
   </tbody>
</table>
</div>
<div class="tab-pane " id="tabItem7">
<div class=" heading-dotted margin-bottom-10 text-center">
   <h5>Network Total</h5>
</div>
<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
   <thead>
      <tr  class="nk-tb-item nk-tb-head">
         <th class="nk-tb-col"><span class="sub-text">Name</th>
         @for($i=1;$i<=6;$i++)
         <th class="nk-tb-col"><span class="sub-text">Level {{$i}} </th>
         @endfor
         <th class="nk-tb-col"><span class="sub-text">Total </th>
      </tr>
   </thead>
   <tbody>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>Affiliates (Paid)</span>
         </td>
         @php

         $total_paid=0;
         @endphp
         @for($i=1;$i<=6;$i++)
         @php
         $paid=getPaidAffiliates($i,$year,$month,$country);
         $total_paid +=$paid;
         @endphp
         <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(0,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
            <span>{{$paid}}</span>
         </td>
         @endfor
         <td class="nk-tb-col">
            <span>{{$total_paid}}</span>
         </td>
      </tr>
      @foreach($ranks as $rank)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$rank->assign_position}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @for($i=1;$i<=6;$i++)
         @php
         $mTotal=getGeanologyUserYearly($i,$rank->id,$year,$month,$country);
         $m_sub += $mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(<?=$rank->id;?>,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
            <span>{{$mTotal}}</span>
         </td>
         @endfor
         <td class="nk-tb-col">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      @foreach($plans as $plan)
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span>{{$plan->name}}</span>
         </td>
         @php
         $m_sub=0;
         @endphp
         @for($i=1;$i<=6;$i++)
         @php
         $mTotal=getMemberUserYearly($i,$plan->id,$year,$month,$country);
         $m_sub += $mTotal;
         $total +=$mTotal;
         @endphp
         <td class="nk-tb-col" onclick="getYearlyMemberbylevel(<?=$plan->id?>,<?=$i;?>,<?=$year;?>,'<?=$country;?>')">
            <span>{{$mTotal}}</span>
         </td>
         @endfor
         <td class="nk-tb-col">
            <span>{{$m_sub}}</span>
         </td>
      </tr>
      <!-- .nk-tb-item  -->
      @endforeach
      <tr class="nk-tb-item tr-border-red" >
         <td class="nk-tb-col">
            <span>Total</span>
         </td>
         @php
         $net_pay=0;
         @endphp
         @for($i=1;$i<=6;$i++)
         @php
         $paid=getPaidAffiliates($i,$year,$month,$country);
         $mem=getMemberUserYearlyTotal($i,$year,$month,$country);
         $tot=getGeanologyUserYearlyTotal($i,$year,$month,$country);
         $tolal_sub=$paid+$tot+$mem;
         $net_pay +=$tolal_sub;
         @endphp
         <td class="nk-tb-col">
            <span>{{$tolal_sub}}</span>
         </td>
         @endfor
         <td class="nk-tb-col">
            <span>{{$net_pay}}</span>
         </td>
      </tr>
   </tbody>
</table>
</div>