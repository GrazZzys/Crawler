<?php

include_once __DIR__ . '/Crawler.php';

class Router
{
    public function post($url, $class)
    {
        if($_SERVER['REQUEST_URI'] == $url){
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $className = explode('::', $class)[0];
                $method = explode('::', $class)[1];
                $app = new $className();
                $app->$method();
            }
            else
                echo 'Выберите метод POST';
        }
    }
}