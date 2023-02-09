<?php
$token = "";
$cid = $_GET['channel'];
header('Content-Type: text/html');

if(isset($_GET['quantity'])){
    $qty = $_GET['quantity'];
}else{
    $qty = 10;
}

// From URL to get webpage contents.
$url = "https://www.googleapis.com/youtube/v3/activities?part=contentDetails&maxResults={$qty}&channelId={$cid}&key={$token}";
// Initialize a CURL session.
$ch = curl_init();

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);
$api = json_decode($result,JSON_PRETTY_PRINT);
foreach($api['items'] as $item){
    $link = $item['contentDetails']['upload']['videoId'];
    echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="padding:1vh;margin:2vh;">'.'</iframe>';
}

?>
