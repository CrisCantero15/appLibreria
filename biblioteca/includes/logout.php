<?php
session_start();
session_unset();
session_destroy();
header("Location: ../access.php"); // Redirigimos al usuario a la página 'accessUser.php'.
exit();