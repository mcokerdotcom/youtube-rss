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
            background: #222;
            padding: 2em 0;
            font-family: Roboto, sans-serif;
						font-size: 1.5vw;
						line-height: 1.4;
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
            font-size: 2em;
        }
        .titleLink {
            color: #f0f0f0;
        }
        .channel {
            margin: 0 0 2em;
            background: #444;
            border: 1px solid #000;
        }
        .channelList {
            display: flex;
            flex-wrap: wrap;
            padding: 1em 1em 0;
        }
        .vid {
            width: calc(25% - 1em);
            margin: 0 1em 1em 0;
            display: flex;
            background: #222;
            border: 1px solid #000;
            flex-wrap: wrap;
            align-items: flex-start;
            transition: background .25s, box-shadow .25s;
        }
        .vid:hover {
            box-shadow: 0 4px 5px -2px rgba(0,0,0,0.4);
            background: #f0f0f0;
        }
        .vid:nth-child(4n) {
            margin-right: 0;
        }
        .thumb {
            width: 100%;
            display: block;
            transition: transform .25s, box-shadow .25s;
            transform-origin: 50% 80%;
        }
        .vid:hover .thumb {
            transform: scale(1.05);
            box-shadow: 0 2px 3px rgba(0,0,0,0.5);
        }
        .vidTitle {
            display: block;
            color: #fff;
            margin: 0 1em;
            padding: .5em;
            transition: color .25s;
        }
        .vid:hover .vidTitle {
            color: #000;
        }
    </style>
</head>
<body>
<div class="page">
<?
if (isset($_GET['channel'])) {
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
}
?>
</div>
</body>
</html>
