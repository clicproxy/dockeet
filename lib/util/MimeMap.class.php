<?php
abstract class MimeMap
{
  static $map = array(
    'Image' => array('image/jpeg', 'image/png', 'image/gif'),
    'PDF'   => array('application/pdf')
  );

  /**
   * Retourne les types mime designes par un type
   *
   * @param string $type
   * @return array
   */
  public static function getMimeTypesForType($type)
  {
    return array_key_exists($type, self::$map) ? self::$map[$type] : array();
  }

  /**
   * Retourne le type associe a un type mime
   *
   * @param string $mime_type
   * @return string
   */
  public static function mimeTypeToType($mime_type)
  {
    foreach(self::$map as $type => $mime_types)
    {
      if(in_array($mime_type, $mime_types))
        return $type;
    }
    
    return null;
  }
}
?>
