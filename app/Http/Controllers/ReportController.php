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
		return Report::all();
	}

	public function index()
	{
		return view('index');
	}

	public function test()
	{
		$messages = LaravelGmail::message()->from('lee.gibbon@hostopia.com.au')->preload()->all();
		return $messages[0]->payload->parts[0]->body->data;
	}

	public function refresh()
	{    
		$messages = LaravelGmail::message()->from('lee.gibbon@hostopia.com.au')->preload()->all();
		$i =0;
		$report = new Report();
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
				$report->msgID = $message->getId();
				$report->subject = $message->getSubject();
				$report->body = $message->payload->parts[0]->body->data;
				$report->save();
				}
				
				

			}
			
		}
	return redirect()->to('/index');
	}
    
}
