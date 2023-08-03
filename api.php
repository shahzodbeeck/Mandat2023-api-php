<?php
ob_start();
error_reporting(0);
date_default_timezone_set("Asia/Tashkent");
header("Content-Type: application/json; charset=UTF-8");
$password = $_GET['password'];
if($password == "soqssqatwuwujjsjjsjsss"){
$id = $_GET['id'];
$url = 'https://mandat.uzbmb.uz/Home2023/AfterFilter?name=' . $id . '&region=0&university=0';
$headers = array(
    'authority: mandat.uzbmb.uz',
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
    'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,uz;q=0.6',
    'cookie: .AspNetCore.Antiforgery.bnDOLbEMdVI=CfDJ8N4-hIiFYeBLsik8C8OCbnvGneE8ACLQZHhgsuaGYaXnMXrnh9MzrRk3s4Z9mQCeVYJMsSdYl_7qUeGBygMhvqIWmTMt0AQ2MQcoVcEEA9DT6bD70Zfn8hg1Qh66X6dcAnZcTAPPSz94D64vvMoMrbg',
    'referer: https://mandat.uzbmb.uz/Home2023/AfterFilter',
    'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: document',
    'sec-fetch-mode: navigate',
    'sec-fetch-site: same-origin',
    'sec-fetch-user: ?1',
    'upgrade-insecure-requests: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_ENCODING, '');
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);
if ($error) {
    echo "cURL Error: " . $error;
} else {
$tr_pattern = '/<tr>(.*?)<\/tr>/s';;
preg_match_all($tr_pattern, $response, $matches222, PREG_SET_ORDER);
$td_pattern = '/<td.*?>(.*?)<\/td>/s';
 preg_match_all($td_pattern, $matches222[1][1], $td_matches);
    $link = '/<a\s+class="btn btn-info"[^>]*href="([^"]+)"/i';
preg_match_all($link, $response, $link);
    $shaha = file_get_contents("https://mandat.uzbmb.uz".$link[1][0]);
$pattern_body = '/<tbody>(.*?)<\/tbody>/is';
preg_match($pattern_body, $shaha, $matches_body);
if (!empty($matches_body)) {
    $pattern_body_row = '/<tr[^>]*>(.*?)<\/tr>/is';
    preg_match_all($pattern_body_row, $matches_body[1], $body_rows);
    foreach ($body_rows[1] as $body_row) {
        $pattern_body_cell = '/<td[^>]*>(.*?)<\/td>/is';
        preg_match_all($pattern_body_cell, $body_row, $cells);
    $data2[] = [
        "id" => $cells[1][0],
        "muassasa" => $cells[1][1],
        "yunalish" => $cells[1][2],
        "shakli" => $cells[1][3],
        "shifr" => $cells[1][4],
        "qabul" => [
            "garant" => $cells[1][5],
            "shartnoma" => $cells[1][6]
        ],
        "otish" => [
            "garant" => $cells[1][7],
            "shartnoma" => $cells[1][8]
        ],
    ];
    }
} 
$doc = new DOMDocument();
$doc->loadHTML($shaha);
$xpath = new DOMXPath($doc);
$h5Text = $xpath->query("//div[contains(@class, 'alert alert-')]/h5")->item(1)->textContent;

    $pattern3 = '/<table class="table table-bordered"[^>]*>(.*?)<\/table>/s';
    preg_match_all($pattern3, $shaha, $matches3);
    $pattern5 = '/<table class="table table-striped"[^>]*>(.*?)<\/table>/s';
    preg_match_all($pattern5, $shaha, $matches5);
    $pattern6 = '/<td style="text-align: center">(.*?)<\/td>/s';
    preg_match_all($pattern6, $matches5[1][0], $matches6);
    $bb = '/<b>(.*?)<\/b>/s';
      preg_match_all($bb, $matches5[1][0], $bbb);
    $imtiyoz[] =[
        'Imtiyozball' => str_replace(["\r", "\n", "\t"], '', $matches6[1][0]),
        'CEFRball' => str_replace(["\r", "\n", "\t"], '', $matches6[1][1]),
        'Ijodiyball' => str_replace(["\r", "\n", "\t"], '', $matches6[1][2]),
        'serti' => str_replace(["\r", "\n", "\t"], '', $matches6[1][3]),
        'Umumiyball' =>  $bbb[1][1]
    ];
    $pattern4 = '/<th>(.*?)<\/th>/s';
    preg_match_all($pattern4, $matches3[0][0], $matches4);
    $pattern_b = '/<b>(.*?)<\/b>.*?/s';
    $pattern_td = '/<t[dh]>(.*?)<\/t[dh]>/s';
    preg_match_all($pattern_b, $matches3[0][0], $matches_b);
    preg_match_all($pattern_td, $matches3[0][0], $matches_td);
    $text = str_replace(["\r", "\n", "\t"], '', $matches_b[1][0]);
        $text0= str_replace(["<br />"], ' ', $text);
    $javob = str_replace(["\r", "\n", "\t"], '', $matches_td[1][10]);
    $ball = str_replace(["\r", "\n", "\t"], '', $matches_td[1][11]);
 $blcok[] = [
            'block' => $text0,
            'savol' => '10',
            'answer' => $javob,
            'ball' => $ball
    ];
    $text2 = str_replace(["\r", "\n", "\t"], '', $matches_b[1][1]);
        $text9= str_replace(["<br />"], ' ', $text2);
    $javob1 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][12]);
    $ball1 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][13]);
 $blcok[] = [
            'block' => $text9,
            'savol' => '10',
            'answer' => $javob1,
            'ball' => $ball1
    ];
    $text3 = str_replace(["\r", "\n", "\t"], '', $matches_b[1][2]);
        $text8= str_replace(["<br />"], ' ', $text3);
    $javob2 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][14]);
    $ball2 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][15]);
   $blcok[] = [
            'block' => $text8,
            'savol' => '10',
            'answer' => $javob2,
            'ball' => $ball2
    ];
    $text4 = str_replace(["\r", "\n", "\t"], '', $matches_b[1][3]);
    $text7= str_replace(["<br />"], ' ', $text4);
    $javob3 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][16]);
    $ball3 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][17]);
   $blcok[] = [
            'block' => $text7,
            'savol' => '30',
            'answer' => $javob3,
            'ball' => $ball3
    ];
    $text5 = str_replace(["\r", "\n", "\t"], '', $matches_b[1][4]);
    $text6= str_replace(["<br />"], ' ', $text5);
    $javob4 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][18]);
    $ball4 = str_replace(["\r", "\n", "\t"], '', $matches_td[1][19]);
    $blcok[] = [
            'block' => $text6,
            'savol' => '30 ',
            'answer' => $javob4,
            'ball' => $ball4
    ];
    preg_match_all($pattern, $html, $matches3[0][0]);
    $pattern = '/<div class="card-body"[^>]*>(.*?)<\/div>.*?<div class="row"[^>]*>(.*?)<\/div>/s';
    preg_match_all($pattern, $shaha, $matches);
    $pattern2 = '/<b>(.*?)<\/b>(.*?)<p>(.*?)<\/p>(.*?)<i class="(.*?)" aria-hidden="true" style="(.*?)"><\/i>/s';
    preg_match_all($pattern2, $matches[0][1], $matches2);
    for ($i = 0; $i < count($matches2[1]); $i++) {
        $cheks = $matches2[5][$i];
        $type = strpos($cheks, 'fa fa-times') !== false ? '❌' : '✅';
        $text = str_replace(["\r", "\n", "\t"], '', $matches2[4][$i]);
        $answer[] = [
            "id" => $i,
            "question" => $matches2[1][$i],
            "point" => $matches2[3][$i],
            "answer" => $text,
            "check" => $type
    ];
    }
    $shaha_cleaned = str_replace(array("\r", "\n", "\t"), '', $h5Text);
    $data[] = [
        "id" => $td_matches[1][0],
        "tavsiya" => $shaha_cleaned,
        "name" => $td_matches[1][1],
        "yunalish" => $td_matches[1][2],
        "muassasa" => $td_matches[1][3],
        "ball" => $td_matches[1][4],
        "til" => $td_matches[1][5],
        "shakli" => $td_matches[1][6]
    ];
    $e = [
        'short' => $data,
        'long' => $data2,
        'answers' => $answer,
        'block' => $blcok,
        'imtiyoz' => $imtiyoz
    ];
    echo json_encode($e, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
}else{
      $e = [
        'ok' => false,
        'eror' => "Password mistake",
        'key'=>'no money no honey'
    ];
     echo json_encode($e, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
?>