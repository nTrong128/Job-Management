<?php

include_once '../condb/condb.php';


session_start();

session_unset();

session_destroy();

header("Location: dangnhap.php");
