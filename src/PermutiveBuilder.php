<?php

namespace Drupal\permutive;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\permutive\Plugin\PermutiveData;

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
      // Group the plugins by type & data id.
      $types[$plugin->getType()][$plugin->getDataId()][] = $plugin;
    }

    //@todo plugin order priority.

    $tags = [];
    foreach ($types as $type => $data_set) {
      foreach ($data_set as $data_id => $plugins) {
        // Pass data for each tag to the plugins to alter.
        $data = new PermutiveData();
        $data->setId($data_id);
        foreach ($plugins as $plugin) {
          $plugin->alterData($data);
        }
        $tags[$type][$data->id()] = $data;
      }
    }

    $js = '';
    foreach ($tags as $type => $data_set) {
      foreach ($data_set as $data_id => $data) {
        $js .= 'permutive.' . $type . '("' . $data_id . '", ';
        $js .= json_encode($data->getArray());
        $js .= ');';
      }
    }

    return $js;
  }

}
