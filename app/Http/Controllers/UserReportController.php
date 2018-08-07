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
				foreach($user->body as $body)
				{
					if(strpos($body, 'Legend')!== false)
					{
						$body = str_replace('Legend','', $body);
					}
					$arr = explode(' ', $body);
				}
			}
		}
		#$userReport = new UserReport();
		return $arr;
	}


}
