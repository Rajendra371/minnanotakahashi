<style>
    .highcharts-credits{
    display:none;
    }
 </style>
 <div class="dashboard_sectin">
 <div class="row">
 <div class="col-md-9">
    <div class="overview_section">
       <h3>General</h3>
       <ul>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-user"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Person</h4>
                   <p>
                      <a href="#" class="btnviewed"><span>Total</span>{{ $data['total_person'][0]->cnt}}</a>
                      <a href="#" class="btnviewed"><span>Today</span>{{ $data['today_total_person'][0]->cnt}}</a>
                   </p>
                </div>
             </div>
          </li>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-stethoscope"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Examinaton</h4>
                   <p>
                      <a href="#" class="btnviewed"><span>Total</span>{{ $data['total_exam'][0]->cnt}}</a>
                      <a href="#" class="btnviewed"><span>Today</span>{{ $data['today_total_exam'][0]->cnt}}</a>
                   </p>
                </div>
             </div>
          </li>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-file-alt"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Total Report</h4>
                   <p>
                      <a href="#" class="btnviewed"><span>Total</span>{{ $data['total_report'][0]->totalcnt}}</a>
                      <a href="#" class="btnviewed"><span>Pending</span>{{ $data['total_report'][0]->pendingcnt}}</a>
                      <a href="#" class="btnviewed"><span>Complete</span>{{ $data['total_report'][0]->completecnt}}</a>
                   </p>
                </div>
             </div>
          </li>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-check-square"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Delivery</h4>
                   <p>
                      <a href="#" class="btnviewed"><span>Total</span>{{ $data['delivery_report'][0]->totalcnt}}</a>
                      <a href="#" class="btnviewed"><span>Pending</span>{{ $data['delivery_report'][0]->pendingcnt}}</a>
                      <a href="#" class="btnviewed"><span>Complete</span>{{ $data['delivery_report'][0]->completecnt}}</a>
                   </p>
                </div>
             </div>
          </li>
          <li>
            <div class="item_inner">
               <div class="icon-left">
                  <i class="fa fa-check-square"></i>
               </div>
               <div class="dashboard_list">
                  <h4>CheckUp</h4>
                  <p>
                     @if(!empty($data['checkup_type']))
                     @foreach($data['checkup_type'] as $chkty)
                     @php($chkcnt=!empty($chkty->cnt)?$chkty->cnt:'0')
                     <a href="#" class="btnviewed"><span>{{$chkty->chse_name}} </span>{{$chkcnt}} </a>
                     @endforeach
                     @endif
                  </p>
               </div>
            </div>
         </li>
         <li>
            <div class="item_inner">
               <div class="icon-left">
                  <i class="fa fa-check-square"></i>
               </div>
               <div class="dashboard_list">
                  <h4>Fit/ Unfit</h4>
                  <p>
                     @php($fit=!empty($data['fit_unit'][0]->Unfit) ? $data['fit_unit'][0]->Unfit:'0')
                     @php($unfit=!empty( $data['fit_unit'][0]->Fit) ? $data['fit_unit'][0]->Fit:'0')
                     <a href="#" class="btnviewed"><span>Fit </span>{{ $fit }}</a>
                     <a href="#" class="btnviewed"><span>Unfit</span>{{ $unfit }}</a>
                  </p>
               </div>
            </div>
         </li>
       </ul>
    </div>
    <div class="overview_section reference-section">
       <h3>Reference</h3>
       <ul>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-user"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Referrer</h4>
                   <p>
                      <a href="#" class="btnviewed"><span>Total</span>{{ $data['total_referrer'][0]->cnt}}</a>
                      <a href="#" class="btnviewed"><span>Today</span>{{ $data['today_total_referrer'][0]->cnt}}</a>
                   </p>
                </div>
             </div>
          </li>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-user"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Co-Referrer</h4>
                   <p>
                      <a href="#" class="btnviewed"><span>Total</span>{{ $data['total_co_referrer'][0]->cnt}}</a>
                      <a href="#" class="btnviewed"><span>Today</span>{{ $data['today_total_co_referrer'][0]->cnt}}</a>
                   </p>
                </div>
             </div>
          </li>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-user"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Self</h4>
                   <p>
                      <a href="#" class="btnviewed"><span>Total</span>{{ $data['total_self'][0]->cnt}}</a>
                      <a href="#" class="btnviewed"><span>Today</span>{{ $data['today_total_self'][0]->cnt}}</a>
                   </p>
                </div>
             </div>
          </li>
       </ul>
    </div>
    <div class="overview_section renevue-section">
       <h3>Revenue</h3>
       <ul>
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-user"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Cash In</h4>
                 <p>
                 <a href="#" class="btnviewed"><span>Total</span>@php($cash_in_total=!empty($data['cash_in_total'][0]->amtinttotal)?$data['cash_in_total'][0]->amtinttotal:'0'){{$cash_in_total}}</a>
                  <a href="#" class="btnviewed"><span>Today</span>@php($cash_in_today=!empty($data['cash_in_today'][0]->amtinttoday)?$data['cash_in_today'][0]->amtinttoday:'0'){{$cash_in_today}} </a>
                   </p>
                </div>
             </div>
          </li>
         
          <li>
             <div class="item_inner">
                <div class="icon-left">
                   <i class="fa fa-user"></i>
                </div>
                <div class="dashboard_list">
                   <h4>Cash Out</h4>
                   <p>
                    <a href="#" class="btnviewed"><span>Total</span>{{ !empty($data['cash_out_total'][0]->amt)?$data['cash_out_total'][0]->amt:'0' }}</a>
                  <a href="#" class="btnviewed"><span>Total</span>{{ !empty($data['cash_out_today'][0]->amt)?$data['cash_out_today'][0]->amt:'0' }}</a>
                      
                   </p>
                </div>
             </div>
          </li>
           <li>
            <div class="item_inner">
               <div class="icon-left">
                  <i class="fa fa-user"></i>
               </div>
               <div class="dashboard_list">
                  <h4>Credit Transaction</h4>
                  <p>
                    <a href="#" class="btnviewed"><span>Total</span>{{!empty($data['credit_tran_total'][0]->totalamt)?$data['credit_tran_total'][0]->totalamt:'0'}}</a>
                      <a href="#" class="btnviewed"><span>Today</span>{{!empty($data['credit_tran_today'][0]->totalamttoday)?$data['credit_tran_today'][0]->totalamttoday:'0'}}</a>
                  </p>
               </div>
            </div>
         </li>
       </ul>
    </div>
 
 </div>
 <div class="col-md-3">
   <div class="sidebar-content-right">
      <h2>Recent Activities</h2>
       <div class="recent-activities">
          <ul>
             <li>
                <div class="sidebar-item">
                   <div class="sidebar-left">
                      <figure>
                         <img src="https://cdn.japantimes.2xx.jp/wp-content/uploads/2019/03/n-medcert-a-20190311-870x580.jpg" />
                      </figure>
                   </div>
                   <div class="sidebar-right">
                      <h4><a href="#">Medical Title here</a></h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                   </div>
                </div>
             </li>
              <li>
                <div class="sidebar-item">
                   <div class="sidebar-left">
                      <figure>
                         <img src="https://cdn.japantimes.2xx.jp/wp-content/uploads/2019/03/n-medcert-a-20190311-870x580.jpg" />
                      </figure>
                   </div>
                   <div class="sidebar-right">
                      <h4><a href="#">Medical Title here</a></h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                   </div>
                </div>
             </li>
             <li>
                <div class="sidebar-item">
                   <div class="sidebar-left">
                      <figure>
                         <img src="https://cdn.japantimes.2xx.jp/wp-content/uploads/2019/03/n-medcert-a-20190311-870x580.jpg" />
                      </figure>
                   </div>
                   <div class="sidebar-right">
                      <h4><a href="#">Medical Title here</a></h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                   </div>
                </div>
             </li>
             <li>
                <div class="sidebar-item">
                   <div class="sidebar-left">
                      <figure>
                         <img src="https://cdn.japantimes.2xx.jp/wp-content/uploads/2019/03/n-medcert-a-20190311-870x580.jpg" />
                      </figure>
                   </div>
                   <div class="sidebar-right">
                      <h4><a href="#">Medical Title here</a></h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                   </div>
                </div>
             </li>
             <li>
                <div class="sidebar-item">
                   <div class="sidebar-left">
                      <figure>
                         <img src="https://cdn.japantimes.2xx.jp/wp-content/uploads/2019/03/n-medcert-a-20190311-870x580.jpg" />
                      </figure>
                   </div>
                   <div class="sidebar-right">
                      <h4><a href="#">Medical Title here</a></h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                   </div>
                </div>
             </li>
             <li>
                <div class="sidebar-item">
                   <div class="sidebar-left">
                      <figure>
                         <img src="https://cdn.japantimes.2xx.jp/wp-content/uploads/2019/03/n-medcert-a-20190311-870x580.jpg" />
                      </figure>
                   </div>
                   <div class="sidebar-right">
                      <h4><a href="#">Medical Title here</a></h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                   </div>
                </div>
             </li>
             <li>
                <div class="sidebar-item">
                   <div class="sidebar-left">
                      <figure>
                         <img src="https://cdn.japantimes.2xx.jp/wp-content/uploads/2019/03/n-medcert-a-20190311-870x580.jpg" />
                      </figure>
                   </div>
                   <div class="sidebar-right">
                      <h4><a href="#">Medical Title here</a></h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                   </div>
                </div>
             </li>
          </ul>
       </div>
   </div>
 </div>