<?php

include_once '../condb/condb.php';
session_destroy();
unset($_SESSION['nguoidung']);
header("Location: ../index.php");