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
			foreach ($a['body'] as $user)
			{

				if(strpos($user, 'Legend')!== false)
				{
					$user = str_replace('Legend','', $user);
				}
				$arr = explode(' ', $user);
				$arr = $a['msgID'];

			}
			#$arr = $a;
		}
		#$userReport = new UserReport();
		return $arr;
	}


}
