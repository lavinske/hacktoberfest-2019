<?php
/**
 * Cloudflare adaptor.
 * This module will help the Framework know what actually happends
 * on the client. This will manipulate the PHP's $_SERVER var for
 * detecting IP, SCHEME, and other Usefull tools.
*/

if(isset($_SERVER['HTTP_CF_CONNECTING_IP']) && isset($_SERVER['HTTP_CF_RAY'])){
  $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
  $_SERVER['HTTP_X_REAL_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
  if(isset($_SERVER['HTTP_CF_VISITOR']) || !isset($_SERVER['REQUEST_SCHEME'])){
    $_SERVER['REQUEST_SCHEME'] = (isset($_SERVER['HTTP_CF_VISITOR']) &&
                 strpos($_SERVER['HTTP_CF_VISITOR'],'https')>-1)?'https':'http';
    $_SERVER['HTTPS'] = ($_SERVER['REQUEST_SCHEME']=="https")?"on":null;
  }
}