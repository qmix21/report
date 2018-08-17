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
	
    	$names = UserReport::select('name')->distinct()->get();
		$correctNames = [];
		foreach($names as $name)
		{
			$answer = preg_match('/\\d/', $name);
			if($answer == 1)
			{

			}
			else
			{
				array_push($correctNames, $name);

			}
		}
		$names = $correctNames;

    	$reportstable = Lava::DataTable();
    	$reportstable->addStringColumn("Name")
    				->addNumberColumn('Calls')
    				->addNumberColumn('Tickets');


    	foreach($names as $name)
    	{
    		$reportstable->addRow([$name->name, rand(800,1000),rand(800,1000)]);
    	}
    	

    	$chart = Lava::ColumnChart('MyReports',$reportstable,['title'=>'ReportChart' . "2018-08-02",'titleTextStyle'=>['color' => '#eb6b2c','fontSize' => 10]]);
		return $report;
	    }
}
