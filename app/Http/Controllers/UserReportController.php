<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReportController extends Controller
{
    

	public function create()
	{

		$arr = App::call('Http\Controllers\ReportController@mail');

		return $arr;
	}


}
