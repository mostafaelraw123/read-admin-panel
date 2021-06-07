<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Notification;
use App\Models\UserPriceOrder;
use App\Models\User;
use Illuminate\Http\Request;



class AdminController extends Controller
{

    public function __construct()
    {

    }

    /**
     * show dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.home.dashboard',[
            'colors' =>['#C0C0C0','#808080','#FFA07A','#E9967A','blue','green','red',
                '#999999','#454545','#D3D3D3','#380000','#E80000','#009966','#009933',
                '#330099','#660099','#D3D3D3','#990066','#9900FF','#990000','#999900',
                '#FF33FF','#FFFF00','#FF3333','#FF3333','#FFFF99','#990000','#FF99CC',
                '#990000','#663366','#663399','#669966','#669999','#6666FF','#66FFFF'
            ],
        ]);
    }

    public function calender(Request $request)
    {
//        $arrResult =[];
//        $orders = UserPriceOrder::get();
//        //get count of orders by days
//        foreach ($orders as $row) {
//            $date = date('Y-m-d', strtotime($row->created_at));
//            if (isset($arrResult[$date])) {
//                $arrResult[$date]["counter"] += 1;
//            } else {
//                $arrResult[$date]["counter"] = 1;
//
//            }
//        }
//        //make format of calender
//        $Events = [];
//        if (count($arrResult)>0) {
//            $i = 0;
//            foreach ($arrResult as $item => $value) {
//                $title= '  <span  class="fc-title" title=""> ' . $value['counter'] . '  </span>';
//                $Events[$i] = array(
//                    'id' => $i,
//                    'title' => $title,
//                    'start' => $item,
//                );
//                $i++;
//            }
//        }
//        //return to calender
//        return $Events ;
    }


}//end
