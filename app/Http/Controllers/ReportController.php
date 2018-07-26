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
			$report->body = str_replace(' ', '-', base64_decode($report->body))
			$report->body =  preg_replace('/[^A-Za-z0-9\-]/', '', $report->body); 
		}
		return $reports;
	}

	public function index()
	{
		return view('index');
	}

	public function test()
	{
		$messages = LaravelGmail::message()->from('lee.gibbon@hostopia.com.au')->preload()->all();
		return $messages;
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
					$report->body = $message->payload->parts[0]->body->data;

				}
				else
				{
					$report->body = $message->payload->parts[0]->parts[0]->body->data;

				}
				$report->save();
				}
				
				

			}
			
		}
	return redirect()->to('/index');
	}
    
}
