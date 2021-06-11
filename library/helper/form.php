<?php 
  if (!function_exists('filter_request_form')) {
    function filter_request_form($data = null) {
      if(!$data)
      {
        return null;
      }
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);

      return $data;
    }
  }