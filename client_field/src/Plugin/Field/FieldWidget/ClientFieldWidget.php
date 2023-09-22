<?php

declare(strict_types=1);

namespace Drupal\client_field\Plugin\Field\FieldWidget;
 
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

/**
 * Plugin implementation of the 'client_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "client_field_widget",
 *   label = @Translation("Client URL"),
 *   field_types = {
 *     "client_url_type"
 *   }
 * )
 */
class ClientFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $config = \Drupal::config('client_url_type.config');

    //the file url_list.txt is placed in my local's docroot folder
    $urls = explode(' ' , file_get_contents('url_list.txt'));
    
    foreach ($urls as $key => $url) {
      $options_urls[$url] = $url;
      //filter unique
    }
    $urls = unserialize($items->getValue('client_url_type')[0]['value']);
    foreach($urls as $default_key => $default_value){
      if($default_value !== 0)
        $default_urls[$default_key] = $default_value;
    }
    
    $element['value'] = [
      '#type' => 'checkboxes',
      '#title' => t('URL'),
      '#description' => t('List of urls'),
      '#options' => $options_urls,
      '#default_value' => $default_urls
    ];

    // //setting default value to all fields from above
    // $childs = Element::children($element);
    // foreach ($childs as $child) {
    //   $element[$child]['#default_value'] = isset($items[$delta]->{$child}) ? $items[$delta]->{$child} : NULL;
    // }

    return $element;
  }

  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    
    if($values[0]['value'] != '0'){
      $values[0]['value'] = serialize($values[0]['value']);
    }

    return $values;
  }

}