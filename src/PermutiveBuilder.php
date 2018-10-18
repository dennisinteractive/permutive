<?php

namespace Drupal\permutive;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class PermutiveBuilder implements PermutiveBuilderInterface {

  /**
   * The plugin manager.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $manager;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  public function __construct(PluginManagerInterface $manager, ConfigFactoryInterface $config_factory) {
    $this->manager = $manager;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public function getApiKey() {
    return $this->configFactory->get('permutive.settings')->get('api_key');
  }

  /**
   * {@inheritdoc}
   */
  public function getProjectId() {
    return $this->configFactory->get('permutive.settings')->get('project_id');
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
