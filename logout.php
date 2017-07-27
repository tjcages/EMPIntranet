<?php

//logout and sleep for 2 seconds

session_start();

session_unset();

session_destroy();

header("Location: /");