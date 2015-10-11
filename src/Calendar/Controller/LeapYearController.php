<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/6
 * Time: 15:39
 */

namespace Calendar\Controller;

use Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController {
	public function indexAction(Request $request,$year){
		$leapYear = new LeapYear();
		if($leapYear->isLeapYear($year)) {
			//return new Response($year.' is leap year');
			return 'this is a leap year!';
		}else {
			//return new Response(' is not leap year');
			return 'this is not a leap year!';
		}
	}
}