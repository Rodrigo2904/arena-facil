<?php

session_start();

session_destroy();

header("Location: /arena-facil/frontend/login.html");

exit();

?>