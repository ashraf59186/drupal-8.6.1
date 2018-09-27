<?php
namespace Drupal\d8_routing\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;

class DataController implements ContainerInjectionInterface {
	protected $db;
	
	public function __construct(Connection $db) {
		$this->db = $db;
	}
	
	public static function create(ContainerInterface $container) {
		return new static(
				$container->get('database')
				);
	}
	public function getResult() {
		$result = $this->db->select('d8_demo', dd)
		->fields('dd')
		->orderby('id', 'desc')
		->range(0,1)
		->execute()->fetchAll();
		return $result[0];
	}

	public function InsertResult($first_name, $last_name) {
		$this->db->insert('d8_demo')
		->fields([
				'last_name' => $last_name,
				'first_name' => $first_name,
		])
		->execute();
	}
	
}

?>