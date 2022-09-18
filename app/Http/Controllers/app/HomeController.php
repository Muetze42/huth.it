<?php

namespace App\Http\Controllers\app;

use DOMDocument;
use DOMXPath;

class HomeController extends Controller
{
    //

    public function test()
    {
        $html = file_get_contents('https://packagist.org/users/Muetze/packages/?page=1');

        $doc = new DOMDocument();
        $doc->loadHTML($html, LIBXML_NOERROR);
        $finder = new DomXPath($doc);
        $classname = 'packages';
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        foreach ($nodes as $node) {
            $packages = $node->getElementsByTagName('li');
            foreach ($packages as $package) {
                echo basename($package->getElementsByTagName('a')[0]->nodeValue);
                echo ' Downloads:'.preg_replace('/\D/', '', $package->getElementsByTagName('span')[0]->nodeValue).' ';

                echo "\n";
            }

            echo "\n";
        }

        echo "\n\n";
        $classname = 'pagination';
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            $links = $node->getElementsByTagName('a');
            foreach ($links as $link) {
                if ($link->getAttribute('rel') && $link->getAttribute('rel') == 'next') {
                    echo $link->getAttribute('href');
                }
            }
        }

//        $liList = $doc->getElementsByTagName('li');
//        $liValues = array();
//        foreach ($liList as $li) {
//            $liValues[] = $li->nodeValue;
//        }
//
//        var_dump($liValues);
    }
}
