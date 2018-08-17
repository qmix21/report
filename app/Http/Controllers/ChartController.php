<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use App\UserReport;

class ChartController extends Controller
{
    

    public function index()
    {
    	$stockstable = Lava::DataTable();
    	$stockstable->addDateColumn("Date")
    				->addNumberColumn('Projected')
    				->addNumberColumn('Official');


    	for($i =1; $i < 5; $i++)
    	{
    		$stockstable->addRow(['2018-08-'.$i, rand(800,1000),rand(800,1000)]);
    	}

    	$chart = Lava::BarChart('MyStocks',$stockstable);
    	return view('chart');
    }
}
