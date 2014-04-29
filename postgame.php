<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<form action="postgame.php" method="post">
    <input style="width: 50%;" type="text" name="url" placeholder="Paste google play link here!" />
    <button type="submit">Submit</button>
</form>
<?php
if (isset($_POST['url']) && !empty($_POST['url'])):

    include('wp-load.php');

    $url = $_POST['url'];
    if (strpos($url, '&hl=') === false && strpos($url, '?hl=') === false) {
        $url .= '&hl=vi';
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    $dom = new DOMDocument('1.0', 'utf-8');
    @$dom->loadHTML('<?xml version="1.0" encoding="utf-8"?>' . $data);
    $xpath = new DOMXPath($dom);
    $game = array();
    $content = "";
    /**
     * Retrieve game name:
     */
    $results = $xpath->query("//*[@class='document-title']");
    if ($results->length > 0) {
        $review = $results->item(0)->nodeValue;
        $game['name'] = ucfirst(trim($review));
    }
    /**
     * Retrieve game version:
     */
    $results = $xpath->query("//*[@itemprop='softwareVersion']");
    if ($results->length > 0) {
        $review = $results->item(0)->nodeValue;
        $game['version'] = trim($review);
    }
    /**
     * Retrieve game manufacturer:
     */
    $results = $xpath->query("//*[@class='document-subtitle primary']");
    if ($results->length > 0) {
        $review = $results->item(0)->nodeValue;
        $game['manufacturers'] = trim($review);
    }
    /**
     * Retrieve game images:
     */
    $results = $xpath->query("//*[@itemprop='screenshot']");
    if ($results->length > 0) {
        $review = array();
        for ($i = 0; $i < min(array($results->length, 4)); $i++) {
            $review[] = trim($results->item($i)->getAttribute('src'));
        }
        $game['link_image'] = $review;
    }
    /**
     * Retrieve game description:
     */
    $results = $xpath->query("//*[@class='id-app-orig-desc']");
    $review = '';
    if ($results->length > 0) {
        $review = $results->item(0);
    }
    $results = $xpath->query("//*[@class='id-app-translated-desc']");
    if ($results->length > 0) {
        $review = $results->item(0);
    }
    if (!empty($review)) {
        $html = '';
        foreach ($review->childNodes as $childNode) {
            $html .= $dom->saveXML($childNode);
        }
        $content = $html;
    }

    $post = array(
        'post_title'    => $game['name'],
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array( 8, 7 ) //Static Category: Game Online
    );
    $post_id = wp_insert_post( $post, $wp_error );
    $prefix = '_infomation_';
    echo "<br /><h1>Preview</h1><hr />";
    foreach ($game as $key => $value) {
        if ((empty($value) && $key != "link_image") || ($key == "link_image" && !count($value))) continue;
        add_post_meta($post_id, $prefix . $key, $value);
        if ($key == "link_image") {
            echo "<h2>images</h2><div>";
            foreach ($value as $src) {
                echo "<img src='{$src}' />";
            }
            echo "</div>";
        } else {
            echo "<h2>{$key}</h2><div>{$value}</div><hr />";
        }
    }
    if (!empty($content)) {
        echo "<h2>description</h2><div>{$content}</div>";
    }
endif;?>
</body>
</html>
