<?php

namespace Drupal\permutive;

interface PermutiveBuilderInterface {

  /**
   * Get the url of the Permutive application script.
   *
   * @return string
   *   The url of the Permutive application script.
   */
  public function getScriptUrl();

  /**
   * Builds the tag.
   *
   * @return string
   *   The javascript for the tag.
   */
  public function buildTag();

  /**
   * Your Permutive api key.
   *
   * @return string
   */
  public function getApiKey();

  /**
   * Your Permutive project id.
   *
   * @return string
   */
  public function getProjectId();

}
