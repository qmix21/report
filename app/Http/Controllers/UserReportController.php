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
				$userReport = new UserReport();

				if(strpos($user, 'Legend')!== false)
				{
					$user = str_replace('Legend','', $user);
				}
				$body = explode(' ', $user);
				$userReport->msgID = $a['msgID'];

				$i = 0;
				foreach($body as $b)
				{

					switch($i)
					{
						case 0:
							$userReport->name = $b;
							$i++;
							break;
						case 1:
							$userReport->name = $userReport->name ." " . $b;
							$i++;
							break;
						case 2:
							$userReport->inbound = $b;
							$i++;
							break;
						case 3:
							$userReport->outbound =$b;
							$i++;
							break;
						case 4:
							$userReport->tickets = $b;
							$i++;
							break;
						case 5:
							$userReport->perhour = $b;
							$i++;
							break;
						case 6:
							$userReport->avgcall = $b;
							$i++;
							break;
						case 7:
							$userReport->talktime = $b;
							$i++;
							break;
						case 8:
							$userReport->ratingsnum = $b;
							$i++;
							break;
						case 9:
							$userReport->ratingsperc = $b;
							$i++;
							break;
						case 10:
							break;							


					}
					
				}
				$userReport->save();

			}
			#$arr = $a;
		}
		
		return UserReport::all();
	}


}
