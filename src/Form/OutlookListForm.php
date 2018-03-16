<?php
/**
 * @file
 * Contains \Drupal\outlook_events\Form\OutlookListForm.
 */
namespace Drupal\outlook_events\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;


class OutlookListForm extends FormBase {

/**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'outlook_account_detail_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {

$header = [
     'uid' => t('Uid'),
     'outlook_id' => t('Outlook Id'),
     'operations' => t('Operations'),
   ];
$form['create'] = [
  '#title' => $this
    ->t('+Add Outlook'),
  '#type' => 'link',
  '#url' => Url::fromRoute('outlook_events.create'),
];
    $form['table'] = [
'#type' => 'tableselect',
'#header' => $header,
//'#rows' => get_outlook_events(),
'#options' => get_outlook_account_list(),
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