<?php
  $i = 0;
  echo 'kode ini akan jalan setidaknya sekali karena i default value adalah 0. <br>';
  do {
    echo 'i valaue is' . $i . ', so code block will run. <br>';
    ++$i; 
  } while ($i < 10);
?>