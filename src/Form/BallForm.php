<?php

/**
 * @file
 * Contains \Drupal\sample_config_entity\Form\BallForm.
 */

namespace Drupal\sample_config_entity\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the ball entity edit forms.
 */
class BallForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\sample_config_entity\Entity\Ball $entity */
    $entity = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Ball name'),
      '#default_value' => $entity->label(),
      '#size' => 30,
      '#required' => TRUE,
      '#maxlength' => 64,
      '#description' => $this->t('The name for this snooker ball.'),
    );
    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $entity->id(),
      '#required' => TRUE,
      '#disabled' => !$entity->isNew(),
      '#size' => 30,
      '#maxlength' => 64,
      '#machine_name' => array(
        'exists' => ['\Drupal\sample_config_entity\Entity\Ball', 'load'],
      ),
    );
    $form['color'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Ball Color'),
      '#default_value' => $entity->getColor(),
      '#size' => 30,
      '#required' => TRUE,
      '#maxlength' => 64,
      '#description' => $this->t('The color of this ball.'),
    );
    $form['point_value'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Point Value'),
      '#default_value' => $entity->getPointValue(),
      '#size' => 30,
      '#required' => TRUE,
      '#maxlength' => 64,
      '#description' => $this->t('The number of points this ball is worth.'),
    );

    return parent::form($form, $form_state, $entity);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\sample_config_entity\Entity\Ball $entity */
    $entity = $this->entity;

    // Prevent leading and trailing spaces.
    $entity->set('label', trim($entity->label()));
    $entity->set('color', $form_state->getValue('color'));
    $entity->set('point_value', $form_state->getValue('point_value'));
    $status = $entity->save();

    $edit_link = $this->entity->link($this->t('Edit'));
    $action = $status == SAVED_UPDATED ? 'updated' : 'added';

    // Tell the user we've updated their ball.
    drupal_set_message($this->t('Ball %label has been %action.', ['%label' => $entity->label(), '%action' => $action]));
    $this->logger('sample_config_entity')->notice('Ball %label has been %action.', array('%label' => $entity->label(), 'link' => $edit_link));

    // Redirect back to the list view.
    $form_state->setRedirect('sample_config_entity.ball_list');
  }

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = ($this->entity->isNew()) ? $this->t('Add ball') : $this->t('Update ball');
    return $actions;
  }

}
