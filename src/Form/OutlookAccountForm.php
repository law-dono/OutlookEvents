<?php
/**
 * @file
 * Contains \Drupal\outlook_events\Form\OutlookAccountForm.
 */
namespace Drupal\outlook_events\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OutlookAccountForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'outlook_account_form';
  }


    public function buildForm(array $form, FormStateInterface $form_state) {
    $conn = Database::getConnection();
     $record = array();
    if (isset($_GET['num'])) {
        $query = $conn->select('outlook_events', 'oe')
            ->condition('id', $_GET['num'])
            ->fields('oe');
        $record = $query->execute()->fetchAssoc();
    }
$form['mail'] = array(
  '#type' => 'textfield',
  '#title' => $this->t('Exchange MailID to get event details'),
  '#required' => TRUE,
  '#default_value' => (isset($record['mail']) && $_GET['num']) ? $record['mail']:'',
);
$form['password'] = array(
  '#type' => 'password',
  '#title' => $this->t('Exchange MailID Password'),
  '#required' => TRUE,
  '#default_value' => (isset($record['password']) && $_GET['num']) ? $record['password']:'',
);
$form['actions']['#type'] = 'actions';
$form['actions']['submit'] = array(
  '#type' => 'submit',
  '#value' => $this->t('Add Account'),
  '#button_type' => 'primary',
);

 return $form;

 }

   /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user = '1';

    $field=$form_state->getValues();
    $mail = $field['mail'];
    $password = $field['password'];
     if (isset($_GET['num'])) {
          $field  = array(
              'mail'   => $mail,
              'password' =>  $password,
              'uid' => $user,
          );
          $query = \Drupal::database();
          $query->update('outlook_events')
              ->fields($field)
              ->condition('id', $_GET['num'])
              ->execute();
          drupal_set_message("succesfully updated");
          $form_state->setRedirect('outlook_events.account');
               //return new RedirectResponse(\Drupal::url('outlook_events.create'));
      }
       else
       {
           $field  = array(
              'mail'   =>  $mail,
              'password' =>  $password,
              'uid' => $user,
          );
           $query = \Drupal::database();
           $query ->insert('outlook_events')
               ->fields($field)
               ->execute();
           drupal_set_message("succesfully saved");
           return new RedirectResponse(\Drupal::url('outlook_events.account'));
           // $response = new RedirectResponse("/mydata/hello/table");
           // $response->send();
       }
     }


   }