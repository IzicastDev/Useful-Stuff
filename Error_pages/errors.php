<?php
/**
 * Show flash message
 *
 * SESSIONs:
 *  'lt' - Loer thirds
 *  'rankFive' 
 *  'time'
 *  'calculateTime'
 *
 * @param [string] $form - the form related to
 * @return void
 */
function flash_message($form){
  if ( !empty($_SESSION[$form]) ) {
  echo '<div class="alert alert-danger" role="alert">';
  echo   $_SESSION[$form];
  echo '</div>';
    //print $_SESSION[$form];
    unset($_SESSION[$form]);
  }
};




