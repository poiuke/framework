<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/6
 * Time: 15:44
 */

namespace Calendar\Model;


class LeapYear {
	public function isLeapYear($year = null){
		if($year == null){
			$year = date('Y');
		}
		return 0 == $year%400 || (0 == $year%4 && 0 != $year%100) ;
	}
}