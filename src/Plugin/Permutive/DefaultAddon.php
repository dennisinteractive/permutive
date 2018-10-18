<?php

namespace Drupal\permutive\Plugin\Permutive;

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
    $data['page']['publisher']['name'] = 'Foooooo';
    return $data;
  }

}
