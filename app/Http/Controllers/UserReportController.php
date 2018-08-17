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
		UserReport::truncate();
		$subject = [];
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
				$userReport->msgID = $a['msgID'];

				## Getting Date so when searching brings up that dates report stats.
				$reports = Report::where('msgID',$a['msgID'])->get();
				$exp = explode('-',$reports[0]->subject);
				$subject = $exp[1];
				$subject = preg_replace('/\s+/', '', $subject);
				$subject = str_replace('/','-', $subject);
				$userReport->date = $subject;

				$userReport->save();

			}
			#$arr = $a;
		}
		
		return UserReport::all();
	}


	public function index(Request $request)
	{
		$report = UserReport::where('date',$request->get('item_id'))->get();
		return $report;
	}

	public function nameReport(Request $request)
	{
		$report = UserReport::where('name','like','%'.$request->get('name').'%')->get();
		return $request->get('name');
	}


}
