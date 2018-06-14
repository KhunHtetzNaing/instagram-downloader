<?php
$url = $_GET['url'];
$html = get_lol($url);

$dom = new DOMDocument;
$dom->loadHTML($html);
$data = $dom->getElementsByTagName("script");
$result = "Result";
foreach ($data as $data2) {
    $lol = $data2->nodeValue;
    if (strpos($lol, 'window._sharedData') !== false) {
	$result = $lol;
$result = str_replace('window._sharedData = ', '', $result);
$result = str_replace(';', '', $result);
	break;
}
}

$json_a = json_decode($result, true);
$mType = $json_a['entry_data']['PostPage']['0']['graphql']['shortcode_media']['is_video'];
$mUrl = $json_a['entry_data']['PostPage']['0']['graphql']['shortcode_media']['display_url'];

if ($mType == true) {
    $mType = "video";
$mUrl = $json_a['entry_data']['PostPage']['0']['graphql']['shortcode_media']['video_url'];
} else {
    $mType = "photo";
}


$myObj->url=$mUrl;
$myObj->type=$mType;
$myJSON = json_encode($myObj);
echo $myJSON;

function get_lol($url){
	$cSession = curl_init();
	  curl_setopt($cSession, CURLOPT_URL, $url);
	  curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);	  
	  curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);  
	  $buffer = curl_exec($cSession);
	  curl_close($cSession);
	  return $buffer ;
	}		
?>
<?php

$url = $_GET['url'];

$html = get_lol($url);



$dom = new DOMDocument;

$dom->loadHTML($html);

$data = $dom->getElementsByTagName("script");

$result = "Result";

foreach ($data as $data2) {

    $lol = $data2->nodeValue;

    if (strpos($lol, 'window._sharedData') !== false) {

	$result = $lol;

$result = str_replace('window._sharedData = ', '', $result);

$result = str_replace(';', '', $result);

	break;

}

}

$json_a = json_decode($result, true);

$mUrl = array();

$mUrl [] = "url:". '' . $json_a['entry_data']['PostPage']['0']['graphql']['shortcode_media']['display_url'];



try {

$tmp = $json_a['entry_data']['PostPage']['0']['graphql']['shortcode_media']['edge_sidecar_to_children']['edges'];

if($tmp!=''){

  $mUrl = array();

  foreach ($tmp as $key => $value) {

  $mUrl [] = "url:". '' .($value['node']['display_url']);

  }

}

}catch(Exception $e) {



}



$myObj->url=$mUrl;

$myJSON = json_encode($myObj);

echo $myJSON;



function get_lol($url){

	$cSession = curl_init();

	  curl_setopt($cSession, CURLOPT_URL, $url);

	  curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);	  

	  curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);  

	  $buffer = curl_exec($cSession);

	  curl_close($cSession);

	  return $buffer ;

	}		

?>
