<?php

namespace Drupal\permutive\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Permutive plugin item annotation object.
 *
 * @see \Drupal\permutive\Plugin\PermutivePluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class PermutivePlugin extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
