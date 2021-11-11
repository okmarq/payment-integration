<?php

include '../env_util.php';

$reference = $_GET['reference'];

if ($reference == '') {
    header('Location: javascript://history.go(-1)');
}
