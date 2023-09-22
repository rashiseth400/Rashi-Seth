<?php

namespace Drupal\client_field\Plugin\Field\FieldFormatter;
     
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Component\Utility\UrlHelper;
     
/**
 * Plugin implementation of the 'client_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "client_field_formatter",
 *   label = @Translation("Client URL"),
 *   description = @Translation("Client Field - Formatter"),
 *   field_types = {
 *     "client_url_type",
 *   }
 * )
 */
     
class ClientFieldFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $element = [];
    foreach ($items as $delta => $item) {
      if (!$item->isEmpty()) {
        $urls = unserialize($item->value);
        foreach($urls as $url){
          if($url !== 0){
            $element[] = [
              '#type' => 'string',
              '#markup' => $url,
              '#title' => 'Client URL',
            ];
          }
        }
      }
    }

    return $element;
  }

}