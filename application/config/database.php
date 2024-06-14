<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

switch($_SERVER['SERVER_NAME']){
				case "finnsapp.com":
				$db['default'] = array(
				'dsn'	=> '',
				'hostname' => 'localhost',
				'username' => 'root',
				'password' => '',
				'database' => 'finns',
				'dbdriver' => 'mysqli',
				'dbprefix' => '',
				'pconnect' => FALSE,
				'db_debug' => (ENVIRONMENT !== 'production'),
				'cache_on' => FALSE,
				'cachedir' => '',
				'char_set' => 'utf8',
				'dbcollat' => 'utf8_general_ci',
				'swap_pre' => '',
				'encrypt' => FALSE,
				'compress' => FALSE,
				'stricton' => FALSE,
				'failover' => array(),
				'save_queries' => TRUE
			);
		break;

  case "fins_app.id": //LIVE PRODUCTION SERVER
  case "www.fins_app.id":
    $db['default'] = array(
				'dsn'	=> '',
				'hostname' => 'localhost',
				'username' => 'root',
				'password' => '',
				'database' => 'berkarya_new',
				'dbdriver' => 'mysqli',
				'dbprefix' => '',
				'pconnect' => FALSE,
				'db_debug' => (ENVIRONMENT === 'production'),
				'cache_on' => TRUE,
				'cachedir' => '',
				'char_set' => 'utf8mb4',
				'dbcollat' => 'utf8mb4_unicode_ci',
				'swap_pre' => '',
				'encrypt' => FALSE,
				'compress' => FALSE,
				'stricton' => FALSE,
				'failover' => array(),
				'save_queries' => TRUE
			);
		break;

  default:
    $db['default'] = array(
				'dsn'	=> '',
				'hostname' => 'localhost',
				'username' => 'root',
				'password' => '',
				'database' => 'finn_app',
				'dbdriver' => 'mysqli',
				'dbprefix' => '',
				'pconnect' => FALSE,
				'db_debug' => (ENVIRONMENT !== 'production'),
				'cache_on' => FALSE,
				'cachedir' => '',
				'char_set' => 'utf8',
				'dbcollat' => 'utf8_general_ci',
				'swap_pre' => '',
				'encrypt' => FALSE,
				'compress' => FALSE,
				'stricton' => FALSE,
				'failover' => array(),
				'save_queries' => TRUE
			);
    break;

}

