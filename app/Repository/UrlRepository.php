<?php

namespace App\Repository;

use App\Services\Db;

class UrlRepository implements RepositoryInterface
{
    public function findByUrl($url): string|null
    {
        $db = Db::getInstance();
        $select = $db->query(
            'SELECT `short_key` FROM `urls` WHERE url=:url;',
            [':url' => $url],
        );
        if (isset($select[0]['short_key'])) {
            return 'http://' . $_SERVER['HTTP_HOST'] . '/link/' . $select[0]['short_key'];
        } else
            return null;
    }

    public function findByShortKey($shortKey): string|null
    {
        $db = Db::getInstance();
        $select = $db->query(
            'SELECT `url` FROM `urls` WHERE short_key=:shortKey;',
            [':shortKey' => $shortKey],
        );

            return $select[0]['url'] ?? null;
    }

    public function saveUrl($url, $short_key)
    {
        $db = Db::getInstance();
        $db->query(
            "INSERT INTO `urls` (`id`, `url`, `short_key`) VALUES (?,?,?); ",
            [null, $url, $short_key],
        );
        $select = $db->query(
            'SELECT `short_key` FROM `urls` WHERE url=:url;',
            [':url' => $url],
        );
        if (isset($select[0]['short_key'])) {
            return 'http://' . $_SERVER['HTTP_HOST'] . '/link/' . $select[0]['short_key'];
        } else
            return null;
    }

    public function find()
    {
        // TODO: Implement find() method.
    }
}