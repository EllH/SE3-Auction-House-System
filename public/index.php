<?php
require '../autoload.php';

$routes = new \fothebys\Routes();

$entryPoint = new \CSY2028\EntryPoint($routes);

$entryPoint->run();



