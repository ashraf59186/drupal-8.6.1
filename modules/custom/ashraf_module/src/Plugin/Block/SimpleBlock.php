<?php

namespace Drupal\ashraf_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Provides a 'SimpleBlock' block.
 *
 * @Block(
 *  id = "simple_block",
 *  admin_label = @Translation("Simple block"),
 * )
 */
class SimpleBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityType_Manager;
  /**
   * Constructs a new SimpleBlock object.
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
    EntityTypeManagerInterface $entityType_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityType_Manager = $entityType_manager;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
  	$query = $this->entityType_Manager->getStorage('node')->getQuery();
  	$nids = $query->condition('type', 'article')
  	->condition('status', '1')
  	->range(0, 3)
  	->sort('created' , 'DESC')
  	->execute();
  	$nodes = $this->entityType_Manager->getStorage('node')->loadMultiple($nids);
  	
    $build = [];
    foreach ($nodes as $node){
    	$build['#markup'] .= $node->getTitle() . '-';
    	$cache_tags[] = 'node' . $node->id();
    }
    
    $build['#cache']['max-age'] = 3600;
    $build['#cache']['tags'] = $cache_tags;
    return $build;
  }

}
