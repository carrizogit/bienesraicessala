<?php
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'conf/database.php';

//conectar a base de datos
$db = conectarDb();


ActiveRecord::setDB($db);