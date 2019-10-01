<?php
class bloggerStream {
    var $url; 
    var $img;
    var $json;
    function get_data($url) {
    $ch = curl_init();
    $timeout = 50;
    curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
    function loadApi($urlf) {
        $xix = [];
       $fileurl = $this->getIframe($urlf);
$internalErrors = libxml_use_internal_errors(true);
$dom = new DOMDocument();
@$dom->loadHTML($this->get_data($fileurl));
$xpath = new DOMXPath($dom);
$nlist = $xpath->query("//script");
$fileurl = $nlist[0]->nodeValue;
$diix = explode('var VIDEO_CONFIG = ', $fileurl);

$ress = json_decode($diix[1], true);
        $xix['links'] = $ress['streams'];
        $xix['img'] = $ress['thumbnail'];
        $this->json = $xix;  
        return $this->json;
    }
    function getIframe($url) {
    $ch = curl_init();
    $timeout = 20;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);

$scriptx = "";
$internalErrors = libxml_use_internal_errors(true);
$dom = new DOMDocument();
@$dom->loadHTML($data);
  
$xpath = new DOMXPath($dom);

$nlist = $xpath->query("//iframe");
$fileurl = $nlist[0]->getAttribute("src");
return $fileurl;

}
    function grab() {
        $json = $this->json;
        $this->url = $json['links'][0]['play_url'];  
        return $this->url;
    }
    function poster() {
        $json = $this->json;
        $this->img = $json['img'];
        return $this->img;
    }
} 
?>
