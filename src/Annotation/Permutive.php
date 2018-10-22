<?php

namespace Drupal\permutive\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Permutive item annotation object.
 *
 * @see \Drupal\permutive\Plugin\PermutiveManager
 * @see plugin_api
 *
 * @Annotation
 */
class Permutive extends Plugin {


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

  /**
   * Where in a list of plugins this one sits.
   *
   * @var integer
   */
  public $priority = 0;

  /**
   * The Permutive call type.
   *
   * @return string
   *   "addon", "identify", "track", "trigger", "query",
   *   "segment", "segments", "ready", "on", "once", "user", "consent"
   */
  public $type = 'addon';

  /**
   * The client type.
   *
   * @return string
   *   The data id; "web"
   */
  public $client_type = 'web';
}
