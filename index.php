<!DOCTYPE HTML>
<html>
<head>
	<title>Youtube Subscription Feed</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }
        body {
            background: #333;
            padding: 2em 0;
font-family: Roboto, sans-serif;
            font-size: 1.3vw;
        }
        a {
            text-decoration: none;
        }
        .page {
            width: 90%;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
        }
        .title {
            background: #000;
            padding: .5em 1em;
            border-radius: 2px 2px 0 0;
            font-size: 2em;
        }
        .titleLink {
            color: #f0f0f0;
        }
        .channelList {
            background: #f0f0f0;
            border: 1px solid #000;
            display: flex;
            flex-wrap: wrap;
            padding: 1em 1em 0;
            margin: 0 0 2em;
        }
        .vid {
            width: calc(25% - 1em);
            margin: 0 1em 1em 0;
            text-align: center;
            display: flex;
            flex-direction: column;
        }
        .vid:nth-child(4n) {
            margin-right: 0;
        }
        .thumb {
            width: 100%;
            display: block;
        }
        .vidTitle {
            background: #ddd;
            display: block;
            padding: .5em;
            flex-grow: 1;
            color: #000;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="page">
<?
$channel = $_GET['channel'];
$channelArr = explode('|',$channel);
foreach ($channelArr as $feed) {
    $parts = explode(':',$feed);
    $type = $parts[0];
    $channelId = $parts[1];
    $feed = implode(file('https://www.youtube.com/feeds/videos.xml?'.$type.'='.$channelId));
    $xml = simplexml_load_string($feed);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    $title = $array['title'];
    $channelUrl = $array['author']['uri'];
    ?>
    <div class="channel">
    <h2 class="title"><a class="titleLink" href="<?=$channelUrl;?>"><?=$title;?></a></h2>
    <div class="channelList">
    <?
    foreach ($array['entry'] as $entry) {
            $id = explode(':',$entry['id'])[2];
            $url = 'https://www.youtube.com/watch?v='.$id;
            $thumb = 'http://img.youtube.com/vi/'.$id.'/0.jpg';
            $vidTitle = $entry['title'];
            ?>
                <a class="vid" href="<?=$url;?>"><img class="thumb" src="<?=$thumb;?>"><span class="vidTitle"><?=$vidTitle;?></span></a>
            <?
    }
    ?>
    </div>
    </div>
    <?
}
?>
</div>
</body>
</html>