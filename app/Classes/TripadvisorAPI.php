<?php

namespace App\Classes;

class TripadvisorAPI{
    public function getContent($url)
    {
            $status = '';

            if (strstr($url, "https://www.tripadvisor", false)) {
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                /*curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);*/
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                $html = curl_exec($ch);
                if (curl_errno($ch)) {
                    $status = 'Curl error: ' . curl_error($ch);
                    $response = $status;
                    $json = json_encode($response, JSON_UNESCAPED_SLASHES);

                    return false;
                }
                curl_close($ch);

                $dom = new \DOMDocument();

                @$dom->loadHTML($html);

                $classname_nome = "heading_title";
                $classname_telefone = "phone";
                $classname_reviews = "rating";
                $classname_imagens = "onDemandImg";

                $finder = new \DomXPath($dom);


                $spaner_nome = $finder->query("//*[contains(@class, '$classname_nome')]");
                //$spaner_telefone = $finder->query("//*[contains(@class, '$classname_telefone')]");
                $spaner_reviews = $finder->query("//*[contains(@class, '$classname_reviews')]");

                $nodes = $finder->query("//div[contains(@class, 'rating')]/span[contains(@class, 'ui_bubble_rating')]");

                preg_match_all('!\d+!', $dom->saveHtml($nodes[0]), $matches);


                $nome = trim(preg_replace('/\s+/', ' ', strip_tags($dom->saveHtml($spaner_nome[0]))));
                $reviews = strtok(preg_replace('/\s+/', ' ', strip_tags($dom->saveHtml($spaner_reviews[0]))), " ");



                return ['reviews' => $reviews, 'rating' => isset($matches[0][0])? $matches[0][0]: null ];
            } else {
               return false;
            }

    }
}