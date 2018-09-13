<?php

namespace App\Classes;

use GuzzleHttp\Client;
use App\Classes\instaWrapper;

class InstagramAPI
{

    private $client;
    private $access_token;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.instagram.com/v1/',
        ]);
        $this->access_token = $this->setAccessToken();
    }

    public function setAccessToken()
    {
        return $this->access_token = env('INSTAGRAM_ACCESS_TIKEN');
    }

    public function getUser()
    {
        if ($this->access_token) {
            $response = $this->client->request('GET', 'users/self/', [
                'query' => [
                    'access_token' => $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    public function getPosts()
    {
        if ($this->access_token) {
            $response = $this->client->request('GET', 'users/self/media/recent/', [
                'query' => [
                    'access_token' => $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    public function getTagPosts($tags)
    {
        if ($this->access_token) {
            $response = $this->client->request('GET', 'tags/' . $tags . '/media/recent/', [
                'query' => [
                    'access_token' => $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    public function getInstPhoto($url_parser)
    {
        //$url_parser="https://www.instagram.com/explore/locations/716597855108397/termas-geometricas-conaripe/"; //ссылка для парсинга
        $glubina_stranic = "0"; //глубина парсинга, на одной странице 20 id пользователей

        if(!$insta_massiv = (instaWrapper::getFeedByUrl($url_parser))){
            return false;
        }
       /* for ($i = 1; $i < count($insta_massiv); $i++) {
            $last_id_anketa = $insta_massiv[$i]['id'];
        }
        $x = 0;*/
/*        while ($x++ < $glubina_stranic) {
            if(!$insta_massiv = (instaWrapper::getFeedByUrl("$url_parser?max_id=$last_id_anketa"))){
                return false;
            }
            for ($i = 1; $i < count($insta_massiv); $i++) {
                $last_id_anketa = $insta_massiv[$i]['id'];
            }
        }*/

        return $insta_massiv;
    }
}