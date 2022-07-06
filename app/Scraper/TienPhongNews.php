<?php

namespace App\Scraper;

use URL;
use DB;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Category;
use App\Models\Post;
use App\Models\Link;

class TienPhongNews
{
    public function scrape($id)
    {
        // check link crawled
        $check = Link::where("id",$id)->select('statusCrawl')->first()->statusCrawl;
        if($check===1){
            return redirect('post');
        }
        //
        $url = Link::where("id",$id)->select('link')->first()->link;

        $idCategory = Link::where("id",$id)->select('idCategory')->first()->idCategory;


        $client = new Client();

        $crawler = $client->request('GET', $url);

        $title = $crawler->filter('.article__title.cms-title')->text();

        $short_description = $crawler->filter('.article__sapo.cms-desc')->text();

        $created_at = $crawler->filter('.article__meta time')->attr('datetime');
        $created_at = date('Y-m-d H:i:s', strtotime($created_at));


        $crawler->filter('.article__body.cms-body img.cms-photo')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $src = $crawler->attr('data-src');
                if ($src){
                    $fileContent = \file_get_contents($src);
                    if ($fileContent){
                        $fileBase = \basename($src);
                        $filePath = public_path().'/upload/'.$fileBase;
                        \file_put_contents($filePath, $fileContent);
                        $node->setAttribute('src', "/upload/".$fileBase);
                        $node->setAttribute('data-src', "");
                    }
                }
            }
        });

        $crawler->filter('.article__body.cms-body .cms-relate')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });
        $content = $crawler->filter('.article__body.cms-body ')->html();


        Post::insert([
            'title' => $title,
            'short_description' => $short_description,
            'content' => $content,
            'created_at' => $created_at,
            'updated_at' => $created_at,
            'idCategory' => $idCategory
        ]);
        Link::where('id',$id)->update([
            'statusCrawl' => 1
        ]);
    }
    public function getCategory()
    {
        $client = new Client();

        $url = 'https://tienphong.vn';

        $crawler = $client->request('GET', $url);

        $data = $crawler->filter('ul.menu li[data-id]')->each(function ($node) {
            $list = Category::where("id", $node->attr('data-id'))->count();
            if ($list === 0) {
                Category::insert([
                    'id' => $node->attr('data-id'),
                    'title' => $node->filter('a')->attr('title')
                ]);
            }
        });
    }
    public function getLinkByCategory($id)
    {
        ini_set('max_execution_time', 1800);
        $page=1;
        while ($page !== false) {
            $api = "https://tienphong.vn/api/morenews-zone-".$id."-".$page.".html";

            $client = new Client(); // Goutte Client
            $crawler = $client->request("GET", $api);
            $data = $client->getResponse()->getContent();
            $data=\json_decode($data, true);
            $articles = $data['data']['articles'];
            $crawler= new Crawler();
            $crawler->addHtmlContent($articles, "utf8");

            $GLOBALS['idCategory']=$id;
            $crawler->filter('a.cms-link')->each(function ($node) {
                $link=$node->attr('href');
                $listLink = Link::where('link', $link)->count();
                if ($listLink === 0) {
                    Link::insert([
                            'link' => $link,
                            'idCategory' => $GLOBALS['idCategory']
                        ]);
                }
            });
            if ($data['data']['hasMoreContent']===true) {
                $page++;
                sleep(3);
            } else {
                $page = false;
                Category::where('id', $GLOBALS['idCategory'])->update([
                        'statusCrawl' => 1
                    ]);
            }
        }
    }
}
