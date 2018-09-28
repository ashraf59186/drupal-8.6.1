<?php

namespace Drupal\d8_routing\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DataEntryEventSubscriber.
 */
class DataEntryEventSubscriber implements EventSubscriberInterface {


  protected $logger;
  /**
   * Constructs a new DataEntryEventSubscriber object.
   */
  public function __construct(DbLog $logger) {
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events['d8_routing_demo.data_insert'] = ['logFirstNameLastName'];

    return $events;
  }

  /**
   * This method is called whenever the d8_routing_demo.data_insert event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function logFirstNameLastName(Event $event) {
    drupal_set_message('Event d8_routing_demo.data_insert thrown by Subscriber in module d8_routing.', 'status', TRUE);
  }

}
