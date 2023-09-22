<?php

declare(strict_types=1);

namespace Drupal\client_field\Plugin\Field\FieldType;
     
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
     
/**
 * Plugin implementation of the 'client_url_type' entity field type.
 *
 * @FieldType(
 *   id = "client_url_type",
 *   label = @Translation("Client Url"),
 *   description = @Translation("This field stores client urls"),
 *   category = @Translation("Text"),
 *   default_widget = "client_field_widget",
 *   default_formatter = "client_field_formatter"
 *   
 * )
*/
     
class ClientFieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'max_length' => 4096,
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')->setLabel(t('URL'));
    return $properties;
  }
     
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'not null' => FALSE,
        ],
      ],
    ];
  }

   /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value1 = $this->get('value')->getValue();
    return empty($value1);
  }

}