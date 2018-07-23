<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
class ReportController extends Controller
{
    
    public function mail()
    {
        $messages = LaravelGmail::message()->subject('test')->unread()->preload()->all();
        return $messages;
    }
    
}
