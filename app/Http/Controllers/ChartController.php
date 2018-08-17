<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use App\UserReport;

class ChartController extends Controller
{
    

    public function index(Request $request)
    {


    	$report = UserReport::where('date',$request->get('item_id'))->get();
	
    	$reportstable = Lava::DataTable();
    	$reportstable->addStringColumn("Name")
    				->addNumberColumn('Calls')
    				->addNumberColumn('Tickets');


    	foreach($report as $r)
    	{
    		$answer = preg_match('/\\d/', $r->name);
    		if($answer != 1)
    		{
    			$reportstable->addRow([$r->name, ($r->inbound+$r->outbound),$r->tickets]);

    		}
    	}
    	

    	$chart = Lava::ColumnChart('MyReports',$reportstable,['title'=>'ReportChart' . "2018-08-02",'titleTextStyle'=>['color' => '#eb6b2c','fontSize' => 10]]);
		return view('chart');
	    }
}
