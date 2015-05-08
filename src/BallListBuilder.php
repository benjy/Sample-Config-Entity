<?php

/**
 * @file
 * Contains \Drupal\sample_config_entity\BallListBuilder.
 */

namespace Drupal\sample_config_entity;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Config\Entity\DraggableListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a class to build a listing of user ball entities.
 *
 * @see \Drupal\user\Entity\Ball
 */
class BallListBuilder extends DraggableListBuilder {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sample_config_entity_ball_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = t('Name');
    $header['color'] = t('Color');
    $header['point_value'] = t('Points');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $this->getLabel($entity);
    $row['color'] = ['#markup' => SafeMarkup::checkPlain($entity->getColor())];
    $row['point_value'] = ['#markup' => SafeMarkup::checkPlain($entity->getPointValue())];
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOperations(EntityInterface $entity) {
    $operations = parent::getDefaultOperations($entity);

    if ($entity->hasLinkTemplate('edit-form')) {
      $operations['edit'] = array(
        'title' => t('Edit ball'),
        'weight' => 20,
        'url' => $entity->urlInfo('edit-form'),
      );
    }
    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    drupal_set_message(t('The ball settings have been updated.'));
  }

}
