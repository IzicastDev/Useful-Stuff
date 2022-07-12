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
 * @param [string] $msg - the msg related to
 * @return void
 */
function flash_message($msg){
  if ( !empty($_SESSION[$msg]) ) {
    echo '<div class="alert alert-danger" role="alert">';
    echo   $_SESSION[$msg];
    echo '</div>';
      //print $_SESSION[$msg];
      unset($_SESSION[$msg]);
  }
};




