<?php 
/**
 * 
 * 
 */
if(!defined('APP_ENGINE')) die('Access denied!');

if(APP_SESSION_ENABLED) {
    if(!isset($_SESSION)) {
        session_start();
    }
}