<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
class ReportController extends Controller
{
    
    public function mail()
    {
        $messages = LaravelGmail::message()->subject('Support Report - 22/07/18')->preload()->all();
        return $messages->payload->parts[0]->body->data;
    }
    
}
