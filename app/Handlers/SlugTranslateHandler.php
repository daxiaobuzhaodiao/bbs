<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text)
    {
        // 实例化 HTTP 客户端  为什么一下三种形式 都是可以的
        // $http = new Client();
        // $http = new Client;
        $http = app(Client::class);

        // 初始化配置信息 不要忽略结尾的 ？ 问号
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $secret = config('services.baidu_translate.secret');
        $salt = time();

        // 如果没有配置百度翻译，自动使用兼容的拼音方案
        if (empty($appid) || empty($secret)) {
            return $this->pinyin($text);
        }

        // 根据文档，生成 sign
        // http://api.fanyi.baidu.com/api/trans/product/apidoc
        // appid+q+salt+密钥 的MD5值
        $sign = md5($appid. $text . $salt . $secret);

        // 构建请求参数  "q=%E7%99%BE%E5%BA%A6%E5%9C%A8%E7%BA%BF%E7%BF%BB%E8%AF%91&from=zh&to=en&appid=20190105000254671&salt=1557722734&sign=284f21cec6e068883410d6421167eca3"
        $query = http_build_query([
            "q"     =>  $text,
            "from"  => "zh",
            "to"    => "en",
            "appid" => $appid,
            "salt"  => $salt,
            "sign"  => $sign,
        ]);

        // 发送 HTTP Get 请求   $response 是 GuzzleHttp/Psr7/Response 的实例
        $response = $http->get($api.$query);
        // var_dump($response->getBody());

        $result = json_decode($response->getBody(), true);
        // dd($result);

        // 尝试获取翻译结果
        if (isset($result['trans_result'][0]['dst'])) {
            // str_slug()  辅助函数在 5.9 中将被移除，建议使用 Str::slug()
            return str_slug($result['trans_result'][0]['dst']);
        } else {
            // 如果百度翻译没有结果，使用拼音作为后备计划。
            return $this->pinyin($text);
        }
    }

    public function pinyin($text)
    {
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}
