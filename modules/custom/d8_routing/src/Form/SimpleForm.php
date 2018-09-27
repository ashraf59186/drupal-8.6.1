<?php 

/* 
 * All functions should be public.
 */
namespace Drupal\d8_routing\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class SimpleForm extends FormBase {
	public function getFormId() {
		return 'custom_form';
	}

	public function buildForm(array $form, FormStateInterface $form_state) {
		$form['candidate_name'] = array(
			'#type' => 'textfield',
			'#title' => t('Candidate Name:'),
			'#required' => TRUE,
		);
		$form['candidate_mail'] = array(
			'#type' => 'email',
			'#title' => t('Email ID:'),
			'#required' => TRUE,
		);
		$form['candidate_number'] = array (
			'#type' => 'tel',
			'#title' => t('Mobile no'),
		);
		$form['candidate_qualification'] = array (
			'#type' => 'select',
			'#title' => ('Qualification'),
			'#options' => array(
				'UG' => t('UG'),
				'PG' => t('PG'),
				'other' => t('other'),
			),
		);
		$form['candidate_info'] = array(
			'#type' => 'textfield',
			'#title' => t('Candidate info:'),
			'#states' => array(
				'visible' => array(
					':input[name="candidate_qualification"]' => array('value' => 'other'),
				)
			),
		);
		$form['country'] = array (
			'#type' => 'select',
			'#title' => ('Country'),
			'#options' => array(
				'UK' => t('UK'),
				'India' => t('India'),
			),
		);
		$form['india_states'] = array (
			'#type' => 'select',
			'#title' => ('States'),
			'#options' => array(
				'KA' => t('KA'),
				'MH' => t('MH'),
				'TN' => t('TN'),
			),
			'#states' => array(
				'visible' => array(
					':input[name="country"]' => array('value' => 'India'),
				)
			),
		);
		$form['uk_states'] = array (
			'#type' => 'select',
			'#title' => ('States'),
			'#options' => array(
				'London' => t('London'),
				'Paris' => t('Paris'),
			),
			'#states' => array(
				'visible' => array(
					':input[name="country"]' => array('value' => 'UK'),
				)
			),
		);
		
		$form['actions']['#type'] = 'actions';
		$form['actions']['submit'] = array(
			'#type' => 'submit',
			'#value' => $this->t('Save'),
			'#button_type' => 'primary',
		);
		return $form;
	}

	public function validateForm(array &$form, FormStateInterface $form_state) {
		if (strlen($form_state->getValue('candidate_number')) < 10) {
			$form_state->setErrorByName('candidate_number', $this->t('Mobile number is too short.'));
		}
	}

	public function submitForm(array &$form, FormStateInterface $form_state) {
		// drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
		//foreach ($form_state->getValues() as $key => $value) {
			$this->messenger()->addMessage(
					$this->t('Form submitted successfully.')
					);
			//drupal_set_message($key . ': ' . $value);
		//}
	}
}
?>