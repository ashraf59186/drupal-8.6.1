<?php

namespace Drupal\ashraf_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountProxyInterface;

/**
 * Provides a 'CurrentUserArticleBlock' block.
 *
 * @Block(
 *  id = "current_user_article_block",
 *  admin_label = @Translation("Current user article block"),
 * )
 */
class CurrentUserArticleBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Session\AccountProxyInterface definition.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;
  protected $currentRouteMatch;
  /**
   * Constructs a new CurrentUserArticleBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
  		AccountProxyInterface $current_user, $currentRouteMatch
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;
    $this->currentRouteMatch= $currentRouteMatch;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('current_route_match')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
  	$node = $this->currentRouteMatch->getParameter('node');;
    $build = [];
    $build['current_user_article_block']['#markup'] = 'Hello ' . $this->currentUser->getAccountName() . '<br/>You are watching ' . $node->getTitle();
    $build['#cache'] = [
      'contexts' => [
        'route',
      ]
    ];

    return $build;
  }

}
