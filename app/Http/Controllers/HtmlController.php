<?php

namespace App\Http\Controllers;

use App\Model\HtmlsUrlModel;
use App\Models\HtmlsModel;
use Symfony\Component\DomCrawler\Link;
use Symfony\Component\DomCrawler\Crawler;

class HtmlController extends Controller
{


    public function collection()
    {
        $url = "https://gravurezasshi9.doorblog.jp/?p=";
        $page = 10;
        for ($i = 1; $i <= $page; $i++) {
            $info = parent::geturl($url . $i);
            $c = new Crawler($info);
            $c->filter('a')->each(function ($node) {
                $arr = $node->extract(['_text', 'href']);
                $arr = $arr[0];
                if (count($arr) == 2) {
                    $title = str_replace(array(" ", "　", "\t", "\n", "\r"), '', $arr[0]);
                    $href = $arr[1];
                    if ($title != null && $href != '#' && strstr($href, '.html') && !strstr($href, 'cat_')) {
                        if (!$this->check($title)) {
                            // dump($title . '===' . $href);
                            //保存url
                            HtmlsModel::UpdateOrCreate([
                                'url' => $href,
                                'title' => $title
                            ]);
                        }

                    }
                }

            });
        }
        dump('ok');
    }

    public function check($title): bool
    {
        if (strpos($title, '01月') || strpos($title, '02月') || strpos($title, '03月') || strpos($title, '04月')
            || strpos($title, '05月') || strpos($title, '06月') || strpos($title, '07月') || strpos($title, '08月')
            || strpos($title, '09月') || strpos($title, '10月') || strpos($title, '11月') || strpos($title, '12月')) {
            return true;
        }
        return false;

    }
}
