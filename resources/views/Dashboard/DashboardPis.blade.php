<div class="dashboard_sectin">
   <div class="row">
      <div class="col-md-9">
         <div class="overview_section">
            <ul>
               <li>
                  <div class="item_inner">
                     <div class="icon-left">
                        <i class="fa fa-user"></i>
                     </div>
                     <div class="dashboard_list">
                        <h4>Employee</h4>
                        <p>
                           <a href="#" class="btnviewed"><span>Total</span>@if(!empty($data['total_staff'])) {{$data['total_staff']}} @else {{0}} @endif</a>
                           
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
                        <h4>Attendance</h4>
                        <p>
                           <a href="#" class="btnviewed available-btn"><span>Present</span>@if(!empty($data['total_present'])) {{$data['total_present']}} @else {{0}} @endif</a>
                           <a href="#" class="btnviewed available-btn"><span>On time</span>@if(!empty($data['total_ontime'])) {{$data['total_ontime']}} @else {{0}} @endif</a>
                           <a href="#" class="btnviewed limited-btn"><span>Late In</span>@if(!empty($data['total_latetime'])) {{$data['total_latetime']}} @else {{0}} @endif</a>
                           <a href="#" class="btnviewed outofstock-btn"><span>Absent</span>@if(!empty($data['total_absent'])) {{$data['total_absent']}} @else {{0}} @endif</a>
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
                        <h4>Leave</h4>
                        <p>
                            <a href="#" class="btnviewed outofstock-btn"><span>On Leave</span>@if(!empty($data['total_present'])) {{$data['total_present']}} @else {{0}} @endif</a>
                           <a href="#" class="btnviewed available-btn"><span>Request</span>@if(!empty($data['total_ontime'])) {{$data['total_ontime']}} @else {{0}} @endif</a>
                           <a href="#" class="btnviewed limited-btn"><span>Approved</span>@if(!empty($data['total_latetime'])) {{$data['total_latetime']}} @else {{0}} @endif</a>
                           <a href="#" class="btnviewed outofstock-btn"><span>Unapproved</span>@if(!empty($data['total_absent'])) {{$data['total_absent']}} @else {{0}} @endif</a>

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
                        <h4>Field Visit</h4>
                        <p>
                           <a href="#" class="btnviewed"><span>Total</span>0</a>
                           
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
                        <h4>Devices</h4>
                        <p>
                           <a href="#" class="btnviewed"><span>Total</span>0</a>
                           <a href="#" class="btnviewed"><span>Active</span>0</a>
                           <a href="#" class="btnviewed"><span>Inactive</span>0</a>
                           
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
                        <h4>Employeer</h4>
                        <p>
                           <a href="#" class="btnviewed"><span>Total</span>0</a>
                           <a href="#" class="btnviewed"><span>Total</span>0</a>
                        </p>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
      <div class="col-md-3">
         <div class="overview_notices">
            <h2>Recent Activities</h2>
            <ul>
               <li>
                  <div class="notices_item">
                     <figure>
                        <img src="http://xelwel.com.np/hrm/uploads/IMG_20180922_125126.jpg" alt="" />
                     </figure>
                     <div class="notice_detail">
                        <h3>Rakesh Shrestha. <small>2 days ago</small></h3>
                        <p>Update Theme Settings<a href="#">read more<i class="fa  fa-angle-double-right"></i></a></p>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="notices_item">
                     <figure>
                        <img src="http://xelwel.com.np/hrm/uploads/IMG_20180922_125126.jpg" alt="" />
                     </figure>
                     <div class="notice_detail">
                        <h3>Rakesh Shrestha. <small>2 days ago</small></h3>
                        <p>Update Theme Settings<a href="#">read more <i class="fa  fa-angle-double-right"></i></a></p>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="notices_item">
                     <figure>
                        <img src="http://xelwel.com.np/hrm/uploads/IMG_20180922_125126.jpg" alt="" />
                     </figure>
                     <div class="notice_detail">
                        <h3>Rakesh Shrestha. <small>2 days ago</small></h3>
                        <p>Update Theme Settings<a href="#">read more <i class="fa  fa-angle-double-right"></i></a></p>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="chart-section mt-20 mb-20">
    <div class="row">
        <div class="col-md-4">
            <div class="xw-card">
                <div class="xw-card-title">
                    <h3>Recent Activities</h3>
                </div>
                <div class="xw-card-body">
                <div id="chartContainer_one" style="height: 200px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="xw-card">
                <div class="xw-card-title">
                    <h3>Recent Activities</h3>
                </div>
                <div class="xw-card-body">
                <div id="chartContainer_two" style="height: 200px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="xw-card">
                <div class="xw-card-title">
                    <h3>Recent Activities</h3>
                </div>
                <div class="xw-card-body">
                <div id="chartContainer_three" style="height: 200px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>


// function chartload()
// {
//     var chart = new CanvasJS.Chart("chartContainer_one", {
// 	animationEnabled: true,
// 	theme: "dark2",
	
// 	axisY:{
// 		includeZero: false
// 	},
// 	data: [{        
// 		type: "line",       
// 		dataPoints: [
// 			{ y: 450 },
// 			{ y: 414},
// 			{ y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
// 			{ y: 460 },
// 			{ y: 450 },
// 			{ y: 500 },
// 			{ y: 480 },
// 			{ y: 480 },
// 			{ y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
// 			{ y: 500 },
// 			{ y: 480 },
// 			{ y: 510 }
// 		]
//     }]
// });

// chart.render();
// }


// setTimeout(function() {
//     chartload();
// }, 2000);
</script>

<script>


setTimeout(function() {
    piechartload();
}, 2000);
</script>

{{-- <script>
function linechartload()
{
    var chart = new CanvasJS.Chart("chartContainer_three", {
	animationEnabled: true,
	theme: "dark2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "GDP Growth Rate - 2016"
	},
	axisY: {
		title: "Growth Rate (in %)",
		suffix: "%",
		includeZero: false
	},
	axisX: {
		title: "Countries"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.0#\"%\"",
		dataPoints: [
			{ label: "India", y: 7.1 },	
			{ label: "China", y: 6.70 },	
			{ label: "Indonesia", y: 5.00 },
			{ label: "Australia", y: 2.50 },	
			{ label: "Mexico", y: 2.30 },
			{ label: "UK", y: 1.80 },
			{ label: "United States", y: 1.60 },
			{ label: "Japan", y: 1.60 }
			
		]
	}]
});
chart.render();

}


setTimeout(function() {
    linechartload();
}, 2000);
</script> --}}