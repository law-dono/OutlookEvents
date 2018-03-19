<?php
namespace Drupal\outlook_events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;

/**
 * Class OutlookAccountController.
 *
 * @package Drupal\outlook_events\Controller
 */
class OutlookAccountController extends ControllerBase {

      public function getContent() {
    $build = [
      'description' => [
        '#theme' => 'outlook_events_description',
        '#description' => 'outlook_events',
        '#attributes' => [],
      ],
    ];
    return $build;
  }
  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function accountDisplay() {
    //create table header
    $header = array(
     'id'=>    t('Id'),
      'mail' => t('Mail'),
        'opt' => t('operations'),
        'opt1' => t('operations'),
    );

   $form['account'] = [
  '#title' => $this
    ->t('+Add Account'),
  '#type' => 'link',
  '#url' => Url::fromRoute('outlook_events.create'),
];
 //display data in site
    $form['table'] = [
            '#type' => 'table',
            '#header' => $header,
            '#rows' => get_outlook_calendar(),
            '#empty' => t('No users found'),
        ];
        return $form;
}
}