<?php
  class Helper {
  
  /**
   * This is a helper method. It strips all xss chars
   * from $str
   *
   * @param   unknown_type  string to clean
   * @return  string
   */
  public static function cleanse_string($str) {
    $unsafe_chars = ["<",">","'",'"'];
    $str = str_replace($unsafe_chars,"",$str);
    $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
    $unsafe_chars[] = "&";
    $str = str_replace($unsafe_chars,"",$str);
    return $str;
  }
  
  /**
   * This is a helper method. It checks for array or string
   * and calls cleanse_string to cleanse values
   *
   * @param   unknown_type  array or string to clean
   * @return  unknown_type
   */
  public static function strip_xss_chars($val) {
    if(is_array($val)) {
      $clean_array = [];
      foreach($val as $k => $v) {
        $v = self::cleanse_string($v);
        $clean_array[$k] = $v;
      }
      return $clean_array;
    }
    return self::cleanse_string($val);
  }
}
