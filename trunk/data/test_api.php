<?php 
  $hostname = 'http://ged/';
  $api_key = 'b6c2d0e939c7fc341070629f';
  $api_secret = 'bb4bbdfe';
  
  /**
   * *********************************** How to list *************************************
   */
  
  $api_sig = md5($api_secret . 'api_key' . $api_key);
  
  $curl_handle = curl_init();
  $options = array
  (
    CURLOPT_URL=> $hostname . 'api/list?api_key=' . $api_key . '&api_sig=' . $api_sig,
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_FOLLOWLOCATION=>true,
    CURLOPT_USERAGENT=>$defined_vars['HTTP_USER_AGENT']
  );
  curl_setopt_array($curl_handle,$options);
  $server_output = curl_exec($curl_handle);
  curl_close($curl_handle);
?>

<pre><?php echo $server_output; ?></pre>

<?php 
  /**
   * ************************************* How to Download *********************************   */

  $params_url = array(
    'api_key' => $api_key,
    'slug' => 'gestion-ressources-v3-1-png'
  );
  ksort($params_url);
  
  
  $api_sig_plain = $api_secret;
  $url = '';
  foreach($params_url as $key => $param_url)
  {
    $api_sig_plain .= $key . $param_url;
    $url .= '&' . $key . '=' . $param_url;
  }
  $url = $hostname . 'frontend_dev.php/api/download?api_sig=' . md5($api_sig_plain) . $url;
?>

<a href="<?php echo $url; ?>">Telecharge</a>