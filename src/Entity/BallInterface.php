<?php

/**
 * @file
 * Contains \Drupal\sample_config_entity\Entity\BallInterface.
 */

namespace Drupal\sample_config_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Interface for balls.
 */
interface BallInterface extends ConfigEntityInterface {

  public function getColor();
  public function getPointValue();
}
