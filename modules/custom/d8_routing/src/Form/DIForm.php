<?php 

/* 
 * All functions should be public.
 */
namespace Drupal\d8_routing\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\d8_routing\Controller\DataController;


class DIForm extends FormBase {
	protected $dc;
	
	public function __construct(DataController $dc) {
		$this->dc = $dc;
	}
	
	public static function create(ContainerInterface $container) {
		return new static(
			$container->get('d8_routing.data_controller')
		);
	}
	
	public function getFormId() {
		return 'd8_routing_di_form';
	}

	public function buildForm(array $form, FormStateInterface $form_state) {
		
		$result = $this->dc->getResult();
		$form['first_name'] = array(
			'#type' => 'textfield',
			'#title' => t('First Name:'),
			'#required' => TRUE,
			'#default_value' => $result->first_name,
		);
		$form['last_name'] = array(
			'#type' => 'textfield',
			'#title' => t('Last Name:'),
			'#required' => TRUE,
			'#default_value' => $result->last_name,
		);
		
		$form['actions']['#type'] = 'actions';
		$form['actions']['submit'] = array(
			'#type' => 'submit',
			'#value' => $this->t('Save'),
			'#button_type' => 'primary',
		);
		return $form;
	}

	public function submitForm(array &$form, FormStateInterface $form_state) {
		//drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
		$this->dc->InsertResult($form_state->getValue('first_name'), $form_state->getValue('last_name'));
		
		$this->messenger()->addMessage(
		$this->t('Form submitted successfully.')
		);
	}
}
?>