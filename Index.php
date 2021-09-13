<?php

include_once __DIR__ . '/Router.php';

$route = new Router();

$route->post('/crawler', 'Crawler::index');