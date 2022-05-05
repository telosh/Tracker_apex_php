<?php
//API Key
$header = array(
    "TRN-Api-Key:8fd06275-87f1-419d-a5e7-86537c3def5c";
);
$url = "https://public-api.tracker.gg/v2/apex/standard/profile/origin/TellM1";
// $url = "https://public-api.tracker.gg/apex/v1/standard/profile/origin/TellM1";
// $apikey = "8fd06275-87f1-419d-a5e7-86537c3def5c";

// cURLセッションを初期化
$ch = curl_init();

// オプションを設定
curl_setopt($ch, CURLOPT_URL, $url); // 取得するURLを指定
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 実行結果を文字列で返す
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//header情報を設定
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // サーバー証明書の検証を行わない

// URLの情報を取得
$response =  curl_exec($ch);//とりあえずここでjson形式のデータが受け取れる
$getData = json_decode($response,true);//json形式へ変換

// 取得結果を表示
echo $getData;
// $stk = ($profile['data']['segments'][0]['stats']['kills']['value']);
// $std = ($profile["data"]["segments"][0]["stats"]["damage"]["value"]);
// $sts4w = ($profile["data"]["segments"][0]["stats"]["season4Wins"]["value"]);


// セッションを終了
curl_close($ch);

?>