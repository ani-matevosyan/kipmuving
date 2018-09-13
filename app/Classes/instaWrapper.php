<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01-09-2018
 * Time: 11:03
 */

namespace App\Classes;


class instaWrapper
{

    static function getFeedByUrl($url)
    {
        $source = self::getApi($url);
        //dd($source);
        //$source = file_get_contents($url);
        if ($source == false) {
            return false;
        }
        $shards = explode('window._sharedData = ', $source);
        $insta_json = explode(';</script>', $shards[1]);
        $insta_array = json_decode($insta_json[0], TRUE);
        if (isset($insta_array['entry_data']['ProfilePage']))
            $nodes = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
        elseif (isset($insta_array['entry_data']['LocationsPage']))
            ($nodes = $insta_array['entry_data']['LocationsPage'][0]['graphql']['location']['edge_location_to_media']['edges']);
        elseif (isset($insta_array['entry_data']['TagPage']))
            $nodes = $insta_array['entry_data']['TagPage'][0]['tag']['media']['nodes'];
        $result = [];
        foreach ($nodes as $item) {
            $item = $item['node'];
//             dd($item);
            $result[] = [
                "id" => $item['id'],
                "display_url" => $item['display_url'],
                "thumbnail_max" => $item['thumbnail_src'],
                "thumbnail_src" => $item['thumbnail_resources']['1']['src'],
                "is_video" => (boolean)$item['is_video'],
            ];
        }
        return $result;
    }

    public static function getApi($string)
    {
        $ch = curl_init();
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        curl_setopt($ch, CURLOPT_URL, $string);
        /*curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);*/
        /*curl_setopt($ch, CURLOPT_AUTOREFERER, false);*/
        /*curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);*/

        /*curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);*/
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        /*curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);*/
        $webcontent = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $webcontent;

    }
}
