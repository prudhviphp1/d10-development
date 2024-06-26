<?php

namespace Drupal\products\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for creating/editing the custom Product entities
 *
 * As per the annotations defined in Entity/Product for forms defining the ProductForm
 */
class ProductForm extends ContentEntityForm
{

    /**
     * {@inheritdoc}
     *
     * Altering the save() method functionality from the parent
     */
    public function save(array $form, FormStateInterface $form_state)
    {
        $entity = $this->entity;

        $status = parent::save($form, $form_state);

        switch ($status) {
        case SAVED_NEW:
            $this->messenger()->addMessage(
                $this->t(
                    'Created the %label Product.', [
                    '%label' => $entity->label(),
                    ]
                )
            );
            break;

        default:
            $this->messenger()->addMessage(
                $this->t(
                    'Saved the %label Product.', [
                    '%label' => $entity->label(),
                    ]
                )
            );
        }
        $form_state->setRedirect('entity.product.canonical', ['product' => $entity->id()]);
    }

}
