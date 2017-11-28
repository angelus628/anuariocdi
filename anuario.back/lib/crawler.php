<?php
    ini_set('display_errors', 1);
error_reporting(E_ALL ^E_WARNING);

    class Crawl {
        private $base_url;
        private $pages;
        private $look_url;
        private $finds;

        public function __construct(){
            $this->base_url  = 'http://' . $_SERVER['SERVER_NAME'] . '/demo/';
            $this->pages = array();
            $this->finds = array();
        }

        public function startCrawl($find){
            try {
                #Se envia la pagina botones que es donde esta el menu
                $html  = @file_get_contents($this->base_url . 'botones.php');
                $dom   = new DOMDocument();
                $dom->loadHtml($html);
                $xpath = new DOMXPath($dom);
                $nodes = $xpath->query('//area/@href');
                $find  = trim($find);

                if(empty($find))
                    return "No data to find.";

                if(!$nodes instanceof Traversable)
                    return "No data found.";

                foreach($nodes as $node) {
                    $this->look_url = $this->base_url . $node->nodeValue;
                    $this->pages[] = $this->look_url;
                    $this->find_links($this->look_url);
                    #$this->find_text($this->look_url, $find);
                }

                if(empty($this->pages)){
                    return array(
                        'records' => 0,
                        'page'    => null,
                    );
                    exit();
                }

                foreach($this->pages as $page){
                    $this->find_text($page, $find);
                }

                if(empty($this->finds)){
                    return array(
                        'records' => 0,
                        'page'    => null,
                    );
                    exit();
                }

                foreach($this->finds as $page => $records){
                    $records = array_unique($records);
                    $results[] = array(
                        'records' => count($records),
                        'page'    => $page,
                    );
                }

                return $results;
                exit();
            }
            catch(Exception $e){
                echo "Error: " . $e->getMessage() . PHP_EOL;
            }
        }

        private function find_text($url = null, $find = ''){
            try {
                $html = @file_get_contents($url);

                if($html == false)
                    return "Not found: $url.";

                $dom   = new DOMDocument();
                $dom->loadHtml($html);
                $xpath = new DOMXPath($dom);
                $nodes = $xpath->query('//p/text()|//div/text()|//td/text()|//span/text()|//h./text()|//strong/text()|//em/text()');

                if(!$nodes instanceof Traversable)
                    return "No data found.";

                foreach ($nodes as $key => $node) {
                    $value = trim($node->nodeValue);
                    if(empty($value))
                        continue;

                    if(preg_match("/$find/i", $value) == 0)
                        continue;

                        $this->finds[$url][] = $value;
                }
            }
            catch(Exception $e){
                return "No data found.";
            }
        }

        private function find_links($url){
            $html  = @file_get_contents($url);

            if($html == false)
                return "Not found: $url.";

            $dom   = new DOMDocument();
            $dom->loadHtml($html);
            $xpath = new DOMXPath($dom);
            $nodes = $xpath->query('//a/@href');

            if(!$nodes instanceof Traversable)
                return "No links found.";

            foreach($nodes as $node){
                $value = trim($node->nodeValue);
                if(empty($value)
                || preg_match('/(pdf)|(http)/i', $value) == 1)
                    continue;

                $this->pages[] = $this->base_url . $value;
            }

            return array_unique($this->pages);
        }
    }
