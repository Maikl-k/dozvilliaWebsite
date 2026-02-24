<?php

require_once __DIR__ . "/../models/session_model.php";

$userSession = new SessionManager();

$_SESSION = array();

$userSession->destroy();

header("Location: /");
exit;
