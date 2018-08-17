<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use App\UserReport;

class ChartController extends Controller
{
    

    public function index()
    {

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
			$names = $correctNames;

    	$stockstable = Lava::DataTable();
    	$stockstable->addStringColumn("Name")
    				->addNumberColumn('Calls')
    				->addNumberColumn('Tickets');


    	foreach($names as $name)
    	{
    		$reportstable->addRow([$name, rand(800,1000),rand(800,1000)]);
    	}
    	

    	$chart = Lava::BarChart('MyReports',$stockstable);
    	return view('chart');
    }
}
