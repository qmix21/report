<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReportController extends Controller
{
    

	public function create()
	{

		$arr = []
		$arr = \App::call('App\Http\Controllers\ReportController@mail');

		return $arr;
	}


}
