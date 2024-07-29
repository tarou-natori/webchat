<?php
  function h($str) :string
  {
    $h_str = htmlspecialchars($str);
    return $h_str;
  }
?>