<?php

/**
 * @file
 * Contains \Drupal\sample_config_entity\Entity\Ball.
 */

namespace Drupal\sample_config_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;


/**
 * Defines the Ball entity.
 *
 * The ball entity stores information about a snooker ball.
 *
 * @ConfigEntityType(
 *   id = "ball",
 *   label = @Translation("Ball"),
 *   module = "sample_config_entity",
 *   config_prefix = "ball",
 *   admin_permission = "administer site configuration",
 *   handlers = {
 *     "storage" = "Drupal\sample_config_entity\BallStorage",
 *     "list_builder" = "Drupal\sample_config_entity\BallListBuilder",
 *     "form" = {
 *       "default" = "Drupal\sample_config_entity\Form\BallForm",
 *       "delete" = "Drupal\sample_config_entity\Form\BallDeleteForm"
 *     },
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/ball/manage/{ball}",
 *     "delete-form" = "/admin/config/ball/manage/{ball}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "weight" = "weight"
 *   },
 *   config_export = {
 *     "id" = "id",
 *     "label" = "label",
 *     "weight" = "weight",
 *     "color" = "color",
 *     "pointValue" = "point_value",
 *   }
 * )
 */
class Ball extends ConfigEntityBase implements BallInterface {

  /**
   * The ball machine name.
   *
   * @var string
   */
  protected $id;

  /**
   * The human readable name of this ball.
   *
   * @var string
   */
  protected $label;

  /**
   * The position weight (not physical) of this ball.
   *
   * @var int
   */
  protected $weight;

  /**
   * The color of this ball.
   *
   * @var string
   */
  protected $color;

  /**
   * The value of this ball measured in points.
   *
   * @var integer
   */
  protected $pointValue;

  /**
   * {@inheritdoc}
   */
  public function getColor() {
    return $this->color;
  }

  /**
   * {@inheritdoc}
   */
  public function getPointValue() {
    return $this->pointValue;
  }
}
