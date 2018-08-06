<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\UserReport;
class UserReportController extends Controller
{
    

	public function create()
	{

		$arr = \App::call('App\Http\Controllers\ReportController@mail');

		foreach($arr as $a)
		{
			if(strpos($a, 'Legend')!== false)
			{
				str_replace($a, '', 'Legend')
				$arr = $a
			}
		}
		#$userReport = new UserReport();
		return $arr;
	}


}
