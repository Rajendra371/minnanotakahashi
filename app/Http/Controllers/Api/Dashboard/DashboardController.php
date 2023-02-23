<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index()
  {
    // Contact Us
    $total_contactus =  DB::table('contact_us_record')->count();
    // Appointment
    $total_appointment =  DB::table('appointment')->count();
    //visitlog
    $total_contact = countVisitsTableValue();
    $total_unique_today = countVisitsTableValue(false, true);
    $total_today = countVisitsTableValue(true, false);
    $total_unique = countVisitsTableValue(true, true);    // Training Session
    // $total_contact = '0';
    // $total_visit = '0';
    // $total_orders = '0';
    // $total_visitors = '0';
    // $unique_visitors = '0';
    // $pending_applicant = '0';
    // $rejected_applicant = '0';
    // $shortlisted_applicant = '0';
    // $waiting_applicant = '0';


    $data[] = [
      
      [
        'id' => 1,
        'name' => 'Visitor Log',
        'icon' => 'people',
        'color' => 'blue',
        'sub_data' => [
          [
            'title' => 'Total Visits',
            'count' => $total_contact
          ],
          [
            'title' => 'Unique Visits',
            'count' => $total_unique
          ]
          , 
          [
            'title' => 'Total Visits Today',
            'count' => $total_today
          ],
          [
            'title' => 'Today Unique Visits',
            'count' => $total_unique_today
          ]
        ]
      ],
      
      
      [
        'id' => 2,
        'name' => 'Enquiry',
        'icon' => 'envelope',
        'color' => 'cyan',
        'sub_data' => [
          [
            'title' => 'Contact Us',
            'count' => $total_contactus
          ],
          [
            'title' => 'Appointment',
            'count' => $total_appointment
          ],
        ]
      ],
    ];

    return response()->json(['status' => 'success', 'data' => $data]);
  }
}