<?php
namespace App\MyClass;
use Carbon\Carbon;
class CommonFx{
	public static function totalDays($f,$t){
		$datef = new Carbon($f, 'Asia/Dhaka');
        $datet = new Carbon($t, 'Asia/Dhaka');
		return $datef->diffInDays($datet);
	}

}
