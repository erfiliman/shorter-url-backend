<?php

    header('Content-Type:text/html; charset=UTF-8');
    require 'shorter.php';
    $request_body = file_get_contents('php://input');

    if ($request_body)
    {
        $data = json_decode($request_body);
        $url = $data->url;
        $shorterUrl = new ShorterUrl();
        $array = array(
            'result' => 'https://devlo.ru/c/' . $shorterUrl->addUrl($url)
        );
        echo json_encode($array);
    }
    else
    {
        $shorterUrl = new ShorterUrl();
        $initUrl = $shorterUrl->getInitUrl(basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
        header("Location:$initUrl");
    }
?>
