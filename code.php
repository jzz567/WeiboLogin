<?php
$code = $_GET['code'];
$data = weibo("https://api.weibo.com/oauth2/access_token?client_id=1949395522&client_secret=你的app secret&grant_type=authorization_code&code=$code&redirect_uri=回调脚本地址", 1);
$access_token = json_decode($data, true)['access_token'];
$data = weibo("https://api.weibo.com/oauth2/get_token_info?access_token=$access_token", 1);
$uid = json_decode($data, true)['uid'];
$data = weibo("https://api.weibo.com/2/users/show.json?access_token=$access_token&uid=$uid", 0);
$data = json_decode($data, true);
var_dump($data);
echo '头像:' . "<img src='{$data['avatar_large']}'/>" . '<br/>';
echo '用户名:' . $data['screen_name'] . '<br/>';
echo '位置:' . $data['location'] . '<br/>';
echo '粉丝:' . $data['followers_count'] . '<br/>';
echo '关注:' . $data['friends_count'] . '<br/>';
echo '最新博文:' . $data['status']['text'] . '<br/>';
function weibo($url, $is_post) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($is_post == 1) {
        curl_setopt($ch, CURLOPT_POST, 1);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

