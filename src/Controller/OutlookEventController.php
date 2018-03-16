<?php
namespace Drupal\outlook_events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides route responses for the Example module.
 */
class OutlookEventController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */


  public function myPage() {
$url = Url::fromRoute('outlook_events.create');
$internal_link = \Drupal::l(t('+Add Outlook Account'), $url);
    $element = array(
      '#markup' => $internal_link,
    );
    return $element;
  }
//  /**
//    * {@inheritdoc}
//    */
//   public function getFormId() {
//     return 'outlook_account_detail_form';
//   }


//   public function buildForm(array $form, FormStateInterface $form_state) {

// $header = [
//      'uid' => t('Uid'),
//      'outlook_id' => t('Outlook Id'),
//      'operations' => t('Operations'),
//    ];

//     $form['table'] = [
// '#type' => 'tableselect',
// '#header' => $header,
// //'#rows' => get_outlook_events(),
// '#options' => get_outlook_account_list(),
// '#empty' => t('No users found'),
// ];

//  return $form;

//  }

//   /**
//    * {@inheritdoc}
//    */
//   public function submitForm(array &$form, FormStateInterface $form_state) {
//    // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
//     foreach ($form_state->getValues() as $key => $value) {
//       drupal_set_message($key . ': ' . $value);
//     }
//    }


}