<?php
    require_once ('..\..\modele\Database.php');
    function webscraping() {
        $db = new Database();
        $html = file_get_contents('https://www.lemonde.fr/');
        libxml_use_internal_errors(TRUE);
        $dom = new DOMDocument();
        if(!empty($html)){
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xpath = new DOMXPath($dom);
            $query= '//div[@class="article article--main"]';
            $results = $xpath->query($query);
            foreach ($results as $result){
                $title = $result->getElementsByTagName('p')->item(0)->nodeValue;
                $link = $result->getElementsByTagName('a')->item(0)->getAttribute('href');
                $image = $result->getElementsByTagName('img')->item(0)->getAttribute('src');
                $description = $result->getElementsByTagName('p')->item(1)->nodeValue;
                $data['title'] = $title;
                $data['link'] = $link;
                $data['image'] = $image;
                $data['description'] = $description;
                $date = date("Y-m-d H:i:s");
            }
        }
        $mail = 'admin@admin.fr';
      //  $db->CreatePostforAll(1,$data['title'],$data['description'],date("Y-m-d H:i:s"),null,$data['image'],0,$mail,$data['link']);
    }
    webscraping();
