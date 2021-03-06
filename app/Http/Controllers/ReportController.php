<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
use App\Report;
use App\UserReport;
class ReportController extends Controller
{
    
   // public function mail()
   // {
   //     $messages = LaravelGmail::message()->preload()->all();
        #return $messages[0]->payload->parts[0]->body->data;
   //     $subjects = $this->getSubject($messages);
   //     return $subjects;


   // }

    public function mail()
	{
		$reports = Report::all();
		$arr = [];
		foreach($reports as $report)
		{
			$data = preg_split("/((\r?\n)|(\r\n?))/", $report->body);
			$results = ['body'=>$this->correctResults($data),'msgID'=>$report->msgID];

			array_push($arr, $results);

		}
		return $arr;
	}

	public function index()
	{
		//gets all dates, gets the distinct dates and passes it to the view
		$dates = UserReport::select('date')->distinct()->get();
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
		}
		return view('index',compact('dates',$dates),compact('names',$names));
	}

	public function test()
	{
		//Function to get ALL reports
		$report = Report::all();
		return preg_match('/\\d/', '123');
			
    // do stuff with $line

		//return $report;
	}

	public function refresh()
	{    
		$messages = LaravelGmail::message()->from('lee.gibbon@hostopia.com.au')->preload()->all();
		$i =0;
		Report::truncate();

		foreach ( $messages as $message )
		{
			
			if(strpos($message->getSubject(), 'Support Report')!== false )
			{
				if(strpos($message->getSubject(),'RE:') !== false)
				{


				}
				else
				{
				$report = new Report();
				$report->msgID = $message->getId();
				$report->subject = $message->getSubject();
				if($message->payload->parts[0]->body->data)
				{
					$report->body = $this->base64Fix($message->payload->parts[0]->body->data);


				}
				else
				{
					$report->body = $this->base64Fix($message->payload->parts[0]->parts[0]->body->data);

				}
				$report->save();
				}
				
				

			}
			
		}
	return redirect()->to('/index');
	}








## Custom Private Functions Below This Line --------


	private function base64Fix($string)
	{
		$decoded = strtr($string, '-_','+/');
		return $string =  base64_decode($decoded);

	}

	private function correctResults($arr)
	{
		$i = 0;
		$data = [];
		$checkTime = false;
		$checkEnd = false;
		foreach($arr as $a)
		{
			if(strpos($a, ">")!== false && strpos($a, "Interactions")!== false)
			{
			}
			elseif(strpos($a, "<")!== false && strpos($a, "Interactions")!== false)
			{

			}
			else
			{

			

				if(strpos($a, "Staff") !== false && strpos($a, "total")!== false)
				{
					$checkEnd = true;
				}

				if($checkTime)
				{
					if($a ==="")
					{

					}
					else
					{
						if(!$checkEnd)
						{
							array_push($data, $a);

						}
						else
						{
							break;
						}
					}
				}
				if($a ==="Time # of Ratings Rating %")
				{
					$checkTime = true;
				}
				#Staff total
				

				}
				

			}
		return $data;
	
		}
		
	}
    

