<?php
namespace Drupal\outlook_events\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'Outlook Calendar Block' block.
 *
 * @Block(
 *  id = "outlook_events_block",
 *  admin_label = @Translation("Outlook events block"),
 * )
 */
class OutlookCalendarBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('\Drupal\outlook_events\Form\UserDetailForm');
    return $form;
  }
}