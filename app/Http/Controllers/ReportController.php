<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
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
		$messages = LaravelGmail::message()->from('lee.gibbon@hostopia.com.au')->preload()->all();
		$parts[] = $messages[0]->payload->parts;
		$i =0;
		foreach ( $messages as $message )
		{
			
			if(strpos($message->getSubject(), 'Support Report')!== false )
			{
				if(strpos($message->getSubject(),'RE:') !== true)
				{


				}
				else
				{

				$subjects[$i] = ["ID"=>$message->getId(),'Subject'=>$message->getSubject(),];
 				$i= $i +1;
				}
				
				

			}
			
		}
		return $parts;
	}
    
}
