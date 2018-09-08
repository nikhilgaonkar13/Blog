<?php

 error_reporting(~E_DEPRECATED & ~E_NOTICE);
 $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
?>