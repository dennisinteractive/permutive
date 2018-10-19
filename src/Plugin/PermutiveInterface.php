<?php

namespace Drupal\permutive\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Permutive plugins.
 */
interface PermutiveInterface extends PluginInspectionInterface {

  /**
   * Gets the Permutive call type.
   *
   * @return string
   *   "addon", "identify", "track", "trigger", "query",
   *   "segment", "segments", "ready", "on", "once", "user", "consent"
   */
  public function getType();

  /**
   * The data id.
   *
   * @return string
   *   The data id; "web"
   */
  public function getDataId();

  /**
   * The data to pass to Permutive.
   *
   * @param \Drupal\permutive\Plugin\PermutiveDataInterface $data
   *   The data object that will become the javascript parameters.
   *
   */
  public function alterData(PermutiveDataInterface $data);

}
