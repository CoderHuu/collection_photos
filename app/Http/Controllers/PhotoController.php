<?php

namespace App\Http\Controllers;

use App\Models\HtmlsModel;
use App\Models\PhotosModel;
use Symfony\Component\DomCrawler\Crawler;

class PhotoController extends Controller
{
    public function collection()
    {
        $urls = HtmlsModel::orderBy('id', 'desc')->where('id', "<", 3)->get();
        foreach ($urls as $url) {
            $info = parent::geturl($url->url);
            $c = new Crawler($info);
            $res = $c->filterXPath('//a/@href');
            foreach ($res as $item) {
                $photoUrl = $item->nodeValue;
                $domain = strstr($photoUrl, '.jpg');
                if ($domain) {
                    //保存图片地址
                    PhotosModel::UpdateOrCreate([
                        'url' => $photoUrl,
                        'title' => $url->title,
                        'html_id' => $url->id
                    ]);
                }
            }
        }
        dump('OK');
    }
}
