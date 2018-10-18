<?php

namespace Drupal\permutive\Plugin\Permutive;

use Drupal\node\NodeInterface;
use Drupal\permutive\Plugin\PermutiveBase;

/**
 * The default web addon.
 *
 * @Permutive(
 *   label = "Default addon",
 *   id = "default_addon",
 *   type = "addon",
 *   data_id = "web",
 * )
 */
class DefaultAddon extends PermutiveBase {

  /**
   * {@inheritdoc}
   */
  public function getData() {
    $route_match = \Drupal::routeMatch();
    $token = \Drupal::token();
    $name = $token->replace(
      '[site:name]',
      [],
      ['clear' => TRUE]
    );
    $data['page']['publisher']['name'] = $name;

    // Node values.
    $node = $route_match->getParameter('node');
    if ($node instanceof NodeInterface) {
      $data['content'] = [
        'headline' => $token->replace(
          '[node:title]',
          ['node' => $node],
          ['clear' => TRUE]
        ),
        'description' => $token->replace(
          '[node:summary]',
          ['node' => $node],
          ['clear' => TRUE]
        ),
        'type' => $node->getEntityTypeId(),
      ];
    }

    return $data;
  }

}
