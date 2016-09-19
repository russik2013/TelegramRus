<?php
/**
 * Created by PhpStorm.
 * User: russik
 * Date: 19.09.2016
 * Time: 20:50
 */
$output = file_get_contents('php;//input');
file_put_contents("logs/txt",file_get_contents('php;//input'));