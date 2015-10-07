<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/7
 * Time: 20:36
 */

namespace Simplex;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContentLengthListener implements EventSubscriberInterface{
	public function onResponse(ResponseEvent $event)
	{
		$response = $event->getResponse();
		$headers = $response->headers;

		if(!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
			$headers->set('Content-Length', strlen($response->getContent()));
		}
	}

	public static function getSubscribedEvents()
	{
		return array('response' => array('onResponse', -255));
	}
}