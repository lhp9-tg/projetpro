<?php

session_start();
$page = 'signin';

require_once('../models/tmdbv2.php');

function cleanString($string) {
	$string = strtolower($string);
	$string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
	$string = preg_replace("/[\s-]+/", " ", $string);
	$string = preg_replace("/[\s_]/", " ", $string);
	return $string;
}

include '../views/results.php';
