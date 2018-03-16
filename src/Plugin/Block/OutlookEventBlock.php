<?php

/**
 * @file
 * Contains \Drupal\outlook_events\Plugin\Block\OutlookEventBlock.
 */

namespace Drupal\outlook_events\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * Provides a 'Outlook Calendar Events Detail' Block
 *
 * @Block(
 *   id = "outlook_events_block",
 *   admin_label = @Translation("Outlook Calendar Events"),
     category = @Translation("Custom article block example")
 * )
 */


/**
 * Returns outlook events on success.
 */


class OutlookEventBlock extends BlockBase {

  /**
   * {@inheritdoc}
  */
  public function build() {
   return array(
      '#type' => 'markup',
      '#markup' => 'This block list the article.',
    );

  }


}

