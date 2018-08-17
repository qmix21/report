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


    	for($i =1; $i < 30; $i++)
    	{
    		$stockstable->addRow(['2018-08-'.$a, rand(800,1000),rand(800,1000)]);
    	}

    	$chart = Lava::LineChart('MyStocks',$stockstable);
    }
}
