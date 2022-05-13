<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
    setTimeout(function () {
    location.reload();
}, 12000);
</script>    
<?php

//API Key
$header = array(
    "TRN-Api-Key:8fd06275-87f1-419d-a5e7-86537c3def5c"
);

if(isset($_GET["plt"])&&($_GET["plt"] != "")){
    $platforms = $_GET["plt"];
}else{
    echo "ちゃんとプラットフォーム選んでね～";
}

if(isset($_GET["name"])&&($_GET["name"] != "")){
    $nameD = $_GET["name"];
}else{
    echo "名前再確認してよね！";
    exit;
}
// TESTIDs

// $platforms = "origin";
// $nameD = "TellM1";
// $platforms = "origin";
// $nameD = "TellM1";
$url = "https://public-api.tracker.gg/v2/apex/standard/profile/".$platforms."/".$nameD;
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
// リンクにあるタグを認識させることで表示する内容を絞り込み可能にする。
// echo $response;
$stl = ($getData['data']['segments'][0]['stats']['level']['value']);

if(isset($getData['data']['segments'][0]['stats']['kills']['value'])){
    $stk = ($getData['data']['segments'][0]['stats']['kills']['value']);//総キル数
}else{
    $stk = null;
}
if(isset($getData["data"]["segments"][0]["stats"]["damage"]["value"])){
    $std = ($getData["data"]["segments"][0]["stats"]["damage"]["value"]);//総ダメージ
}else{
    $std = null;
}
if(isset($getData["data"]["segments"][0]["stats"]["headshots"]["value"])){
    $sths = ($getData["data"]["segments"][0]["stats"]["headshots"]["value"]);//総ダメージ
}else{
    $sths = null;
}
if(isset($getData["data"]["segments"][0]["stats"]["matchesPlayed"]["value"])){
    $stmp = ($getData["data"]["segments"][0]["stats"]["matchesPlayed"]["value"]);//総ダメージ
}else{
    $stmp = null;
}
if(isset($getData["data"]["segments"][0]["stats"]["finishers"]["value"])){
    $stfs = ($getData["data"]["segments"][0]["stats"]["finishers"]["value"]);//総ダメージ
}else{
    $stfs = null;
}

// $getData["data"]["segments"][0]["stats"]["pistolKills"]["value"]
// $getData["data"]["segments"][0]["stats"]["shotgunKills"]["value"]
// $getData["data"]["segments"][0]["stats"]["smgKills"]["value"]
// $getData["data"]["segments"][0]["stats"]["carePackageKills"]["value"]

// $wraith_data = $getData["data"]["segments"][1];
// $gibraltar  = $getData["data"]["segments"][2];
// $bloodhound = $getData["data"]["segments"][3];
// $revenant = $getData["data"]["segments"][4];
// $wattson = $getData["data"]["segments"][5];
// $crypto  = $getData["data"]["segments"][6];
// $bangalore = $getData["data"]["segments"][7];
// $caustic = $getData["data"]["segments"][8];
// $valkyrie = $getData["data"]["segments"][9];
// $octane = $getData["data"]["segments"][10];
// $pathfinder = $getData["data"]["segments"][11];
// $horizon = $getData["data"]["segments"][12];
// $lifeline = $getData["data"]["segments"][13];
// $mirage = $getData["data"]["segments"][14];

//キャラ　　["stats"]["kills"]["value"]

// $sts4w = ($profile["data"]["segments"][0]["stats"]["season?Wins"]["value"]);//シーズンごとの勝利数 ?を数に
// echo $response;



if(isset($stl)&&($stl != null)){
    echo "<p class='maintag'>Name<span class='leveltag'>".$nameD."</span></p>";
}else{
    echo "Name:none";
}
    //チェックの入った項目を表示する
    if(isset($stl)&&($stl != null)){
        // echo $nameD."の総合レベルは".$stl."Lv";
        // echo "<br>";
        if($stl > 500){
            echo "<p class='maintag'>Level<span class='leveltag'>500</span></p>";
        }else{
            echo "<p class='maintag'>Level<span class='leveltag'>".$stl."</span></p>";
        }
        
    }else{
        echo "バトロワ総合キルについての情報を取得できませんでした。";
        echo "<br>";
    }

if(isset($_GET["total_kills"])&&($_GET["total_kills"] == "on")){
    if(isset($stk)&&($stk != null)){
        // echo $nameD."のバトロワ総合キル".$stk."kills";
        // echo "<br>";
        echo "<p class='maintag'>Kills<span class='killtag'>".$stk."</span></p>";
    }else{
        echo "バトロワ総合キルについての情報を取得できませんでした。";
        echo "<br>";
    }
}
    
if(isset($_GET["total_dameges"])&&($_GET["total_dameges"] == "on")){
    if(isset($std)&&($std != null)){
        // echo $nameD."のバトロワ総合ダメージ".$std."dmg";
        // echo "<br>";
        echo "<p class='maintag'>Damages<span class='dmgtag'>".$std."</span></p>";
    }else{
        echo "バトロワ総合ダメージについての情報を取得できませんでした。";
        echo "<br>";
    }
}
if(isset($_GET["head_shots"])&&($_GET["head_shots"] == "on")){
    if(isset($sths)&&($sths != null)){
        // echo $nameD."のバトロワ総合ダメージ".$std."dmg";
        // echo "<br>";
        echo "<p class='maintag'>HeadShots<span class='hstag'>".$sths."</span></p>";
    }else{
        echo "バトロワHS数についての情報を取得できませんでした。";
        echo "<br>";
    }
}

if(isset($_GET["matchesPlayed"])&&($_GET["matchesPlayed"] == "on")){
    if(isset($stmp)&&($stmp != null)){
        // echo $nameD."のバトロワ総合ダメージ".$std."dmg";
        // echo "<br>";
        echo "<p class='maintag'>MatchPlayed<span class='mptag'>".$stmp."</span></p>";
    }else{
        echo "バトロワ総プレイ回数についての情報を取得できませんでした。";
        echo "<br>";
    }
}
    // if(isset($stfs)&&($stfs != null)){
    //     // echo $nameD."のバトロワ総合ダメージ".$std."dmg";
    //     // echo "<br>";
    //     echo "<p class='maintag'>Finishers<span class='mptag'>".$stfs."</span></p>";
    // }else{
    //     echo "バトロワ今シーズンフィニッシャー回数についての情報を取得できませんでした。";
    //     echo "<br>";
    // }
// セッションを終了
curl_close($ch);

?>
</body>
</html>