<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
use App\Report;
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

		foreach($reports as $report)
		{
			$report->body = strtr($report->body, '-_','+/');
			$report->body =  base64_decode($report->body);
			//$report->body =  preg_replace('/[^A-Za-z0-9\-]/', '-', $report->body); 
		}
		return $reports;
	}

	public function index()
	{
		return view('index');
	}

	public function test()
	{

		//Skip upto 10, 13 and 15
		$report = $this->base64Fix(Report::find(20)->body);
		$data = preg_split("/((\r?\n)|(\r\n?))/", $report);
		$arr = [];
		$i = 0;
		foreach($data as $d)
		{
			
			if($i <= 10)
			{
				$i++;
			}
			else
			{
				if($i == 13)
				{
					$i++;
				}
				elseif ($i == 15) {
					$i++;
				}
				else
				{
					if($d == '')
					{
						break;
					}
					else
					{
						array_push($arr, $d);
						$i++;

					}
					
				}
				
			}
			
		}
		return $arr;
			
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



	private function base64Fix($string)
	{
		$decoded = strtr($string, '-_','+/');
		return $string =  base64_decode($decoded);
	}
    
}
