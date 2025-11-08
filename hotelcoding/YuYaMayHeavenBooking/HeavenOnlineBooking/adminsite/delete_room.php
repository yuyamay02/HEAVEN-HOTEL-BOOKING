<?php
include 'heavenconnect.php';
	mysql_query("DELETE FROM `room` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysql_error());
	header("location:room.php");
?>