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
		$messages = LaravelGmail::message()->preload()->all();
                dd($messages);

		foreach ( $messages as $message )
			$subjects[] = $message->getSubject();
		
		return $subjects;
	}

    //This function will loop through all of the headers to find the subject and returns the array of subjects.
    public function getSubject($messages)
    {
    	$arr = array();
    	foreach($messages as $m)
    	{
    		foreach($m->payload->headers as $h)
    		{
    			if($h->name == 'Subject')
    			{
    				array_push($arr, $h->value);
    			}
    		}

    	}
    	return $arr;
    }

    
}
