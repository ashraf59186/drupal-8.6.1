<?php 

/* 
 * All functions should be public.
 */
namespace Drupal\d8_routing\Controller;
use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;

class RouteController {
	public function hello_world() {
		return [
		 '#type' => "#markup",
		 '#markup' => 'Hello world!'
		];
	}

	public function hello_dynamic($name) {
		return [
				'#type' => "#markup",
				'#markup' => 'Hello world!' . $name
		];
	}

	public function hello_dynamictitle($name) {
		return $name;
	}

	public function get_user_info(UserInterface $user) {
		//dpm($user);
		return [
				'#type' => "#markup",
				'#markup' => 'Hello world!' . $user->getUsername()
		];		
	}

	public function get_user_title(UserInterface $user) {
		return 'Hello ' . $user->getUsername();
	}
	public function listNode(NodeInterface $node) {
		$owner = $node->getOwner()->getAccountName();
		return [
			'#type' => '#markup',
		    '#markup' => $node->getTitle() . "|" .$owner
				
		];
	}
}
?>