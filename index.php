<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

const CONT = 'App/controllers/';
const MOD = 'App/models/';
const VIEW = 'App/views/';
const JS  = 'assets/js/';
const CSS = 'assets/css/';
const IMG = 'assets/images/';
const TMP = 'assets/templates/';

require_once TMP . 'top.php';
require_once 'router.php';
require_once TMP . 'bottom.php'; 
