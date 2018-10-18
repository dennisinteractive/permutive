<?php

namespace Drupal\permutive;

use Drupal\Component\Plugin\PluginManagerInterface;

class PermutiveBuilder implements PermutiveBuilderInterface {

  /**
   * The plugin manager.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $manager;

  public function __construct(PluginManagerInterface $manager) {
    $this->manager = $manager;
  }

  /**
   * {@inheritdoc}
   */
  public function getApiKey() {
    // TODO: Implement getApiKey() method.
    return 123;
  }

  /**
   * {@inheritdoc}
   */
  public function getProjectId() {
    // TODO: Implement getProjectId() method.
    return 456;
  }

  /**
   * {@inheritdoc}
   */
  public function getScriptUrl() {
    return 'https://cdn.permutive.com/' . $this->getProjectId() . '-web.js';
  }

  /**
   * {@inheritdoc}
   */
  public function buildTag() {
    $types = [];
    $plugin_definitions = $this->manager->getDefinitions();
    foreach ($plugin_definitions as $id => $definition) {
      /** @var \Drupal\permutive\Plugin\PermutiveInterface $plugin */
      $plugin = $this->manager->createInstance($id);
      $types[$plugin->getType()][$plugin->getDataId()][] = $plugin;
    }

    $js = '';
    foreach ($types as $type => $data_id) {
      foreach ($data_id as $plugins) {
        $js .= 'permutive.' . $type . '("' . $plugin->getDataId() . '", ';
        foreach ($plugins as $plugin) {
          $js .= json_encode($plugin->getData());
        }
        $js .= ');';
      }
    }

    return $js;
  }

}
