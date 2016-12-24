<?php

namespace Inventori\Http\Controllers\Api;


use Illuminate\Http\Request;
use Inventori\App\Inventori\InventoriModel;
use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;

/**
* 
*/
class ConfigController extends Controller
{
	
	public function get($name)
	{
		$data = config('inventori.kondisi.' . $name);

		return response()->json(['data' => $data]);
	}
}