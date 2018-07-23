<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
class ReportController extends Controller
{
    
    public function mail()
    {
        $messages = LaravelGmail::message()->preload()->all();
        #return $messages[0]->payload->parts[0]->body->data;
        return $messages[0];
    }

    //This function will loop through all of the headers to find the subject and returns the array of subjects.
    public function getSubject($headers)
    {
    	$arr = array();
    	foreach($headers as $h)
    	{
    		
    		array_push($arr, $h->value);

    	}
    	return $arr;
    }
    
}
