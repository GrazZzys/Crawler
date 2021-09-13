<?php
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
include_once __DIR__ . '/phpQuery/phpQuery/phpQuery.php';

class Crawler
{
    public function index()
    {
        header('Content-type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data))
        {
            $urls = explode(',', $data['urls']);
            $response = null;
            foreach ($urls as $key => &$url) {
                $url = trim($url);
                if (!empty($url)){
                    if($content = file_get_contents($url)){
                        $dom = phpQuery::newDocument($content);
                        $response[$url] = $dom->find("title")->text();
                    }
                    else
                        $response[$key + 1] = 'Некорректная ссылка';
                }
                else
                    $response[$key + 1] = 'Некорректная ссылка';
            }
            $this->response($response);
        }
        else
            $this->response('Некорректный запрос');
    }

    private function response($args)
    {
        print(json_encode($args, JSON_UNESCAPED_SLASHES| JSON_UNESCAPED_UNICODE));
    }
}