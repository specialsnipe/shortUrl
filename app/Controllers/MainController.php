<?php

namespace App\Controllers;

use App\Repository\UrlRepository;
use App\Services\UrlManager;

class MainController extends AbstractController
{
    private $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        parent::__construct();
        $this->urlRepository = $urlRepository;
    }


    public function main()
    {
        $this->view->renderHtml('main/main.php');
    }

    public function getLink()
    {
        $url = json_decode(file_get_contents('php://input'));

        if (!$link = $this->urlRepository->findByUrl($url)) {
            try {
                $link = $this->createLink($url);
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        }
        echo json_encode($link);
    }

    public function createLink($url)
    {
        $shortKey = UrlManager::create();
        if (!$link = $this->urlRepository->saveUrl($url, $shortKey)) {
            throw new \Exception();
        }
        return $link;
    }

    public function link($shortKey)
    {
        $link = $this->urlRepository->findByShortKey($shortKey);
        header('location: ' . $link);
    }
}


