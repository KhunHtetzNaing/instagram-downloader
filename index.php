<?php
$url = $_GET['url'];
$getSource = file_get_contents($url);
$deSource = rawurldecode($getSource);
$data = explode('window._sharedData = ', $deSource)[1];
$data = explode(';</script>', $data)[0];
$data = json_decode($data, true);
$data = $data['entry_data']['PostPage']['0']['graphql']['shortcode_media'];
$temp = array();
if(isset($data['edge_sidecar_to_children'])){
    $tmp = $data['edge_sidecar_to_children']['edges'];
    foreach ($tmp as $key => $value) {
        $type = $value['node']['is_video'];
        $temp['video'] = $type;
        if($type==true){
            $temp['url'] = $value['node']['video_url'];
        }else{
            $temp['url'] = $value['node']['display_url'];
        }
        $output[] = $temp;
    }
}else{
    $type = $data['is_video'];
    $temp['video'] = $type;
    if($type==true){
        $temp['url'] = $data['video_url'];
    }else{
        $temp['url'] = $data['display_url'];
    }
    $output[] = $temp;
}
header('Content-Type: application/json');
echo json_encode($output,JSON_PRETTY_PRINT);
?>
