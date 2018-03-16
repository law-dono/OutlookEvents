<?php
/**
 * @file
 * Contains \Drupal\outlook_events\Form\UserDetailForm.
 */
namespace Drupal\outlook_events\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class UserDetailForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'outlook_events_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {

$header = [
     'title' => t('Title'),
     'organizer' => t('Organizer'),
     'start_ist' => t('Start Time'),
     'end_ist' => t('End Time'),
     'location' => t('Location'),
   ];

  	$form['table'] = [
'#type' => 'tableselect',
'#header' => $header,
//'#rows' => get_outlook_events(),
'#options' => get_outlook_events(),
'#empty' => t('No users found'),
];

 return $form;

 }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
   // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
   }
}