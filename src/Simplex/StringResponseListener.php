<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/11
 * Time: 17:52
 */

namespace Simplex;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class StringResponseListener implements EventSubscriberInterface {
	public function onView(GetResponseForControllerResultEvent $event) {
		$response = $event->getControllerResult();

		if(is_string($response)) {
			$event->setResponse(new Response($response));
		}
	}

	public static function getSubscribedEvents() {
		return array('kernel.view' => 'onView');
	}
}