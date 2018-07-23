<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
class ReportController extends Controller
{
    
    public function mail()
    {
        $messages = LaravelGmail::message()->subject('Support Report - *')->preload()->all();
        return $messages[0]->payload->parts[0]->body->data;
    }
    
}
