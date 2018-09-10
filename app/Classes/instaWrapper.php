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

    static function getFeedByUrl($url) {
        $source = file_get_contents($url);
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
        $result=[];
        foreach($nodes as $item) {
            $item = $item['node'];
           // dd($item);
            $result[]=[
                "id" => $item['id'],
                "thumbnail_src" => $item['thumbnail_src'],
                "is_video" => (boolean)$item['is_video'],
            ];
        }
        return $result;
    }
}
