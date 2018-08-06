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
			foreach ($a as $user)
			{

				if(strpos($user, 'Legend')!== false)
				{
					str_replace($user, '', 'Legend');
					$arr = $user;
				}
			}
		}
		#$userReport = new UserReport();
		return $arr;
	}


}
