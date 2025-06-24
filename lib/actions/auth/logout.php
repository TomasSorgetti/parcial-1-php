<?php
require_once "../../utils/autoload.php";


Auth::logout();

header("Location: ../../../index.php?page=signin");
