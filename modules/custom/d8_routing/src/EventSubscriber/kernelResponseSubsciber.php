<?php

namespace Drupal\d8_routing\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Path\CurrentPathStack;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class kernelResponseSubsciber.
 */
class kernelResponseSubsciber implements EventSubscriberInterface {


   /**
   * Drupal\Core\Path\CurrentPathStack definition.
   *
   * @var \Drupal\Core\Path\CurrentPathStack
   */
  protected $pathCurrent;

  /**
   * Constructs a new TestSubscriber object.
   */
  public function __construct(CurrentPathStack $path_current) {
    $this->pathCurrent = $path_current;
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
  	$events['KernelEvents::RESPONSE'] = ['addHeaderToResponse'];

    return $events;
  }

  /**
   * This method is called whenever the KernelEvents::RESPONSE event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function addHeaderToResponse(Event $event) {
  	if(substr( $this->pathCurrent->getPath(), 0, 5 ) === "/node") {
  		$response = $event->getResponse();
  		$response->headers->set('access-control-allow-origin', '*');
  	}
  }

}
