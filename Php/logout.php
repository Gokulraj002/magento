<?php
session_start();

// Destroy all sessions
session_destroy();

// Redirect to login or homepage after logging out
header("Location: index.php");
exit();
?>
