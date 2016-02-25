<?php
/**
 * The Google URL Shortener at goo.gl is a service that takes long URLs and squeezes them into fewer characters to make
 * a link that is easier to share, tweet, or email to friends. Users can create these short links through the web
 * interface at goo.gl, or they can programatically create them through the URL Shortener API.
 *
 * With the URL Shortener API you can write applications that use simple HTTP methods to create, inspect, and manage
 * goo.gl short links from desktop, mobile, or web.
 *
 * Links that users create through the URL Shortener can also open directly in your mobile applications that can handle those links.
 * This automatic behavior provides the best possible experience to your app users who open goo.gl links, no matter what platform or device they are on.
 *
 * EM PORTUGUES
 *
 * O Google URL Shortener em goo.gl é um serviço que leva URLs longas e reducao em menos caracteres para fazer um link
 * que é mais fácil de compartilhar, tweet, ou e-mail para os amigos. Os usuários podem criar através da interface web
 * em goo.gl, ou eles podem programaticamente criá-los através da API URL Shortener.
 *
 * Com a API URL Shortener você pode escrever aplicativos que usam métodos HTTP simples para criar, inspecionar e
 * gerenciar goo.gl links curtos de desktop, celular ou web.
 *
 * Links que os usuários criam através da URL Shortener também pode abrir diretamente em seus aplicativos móveis que
 * podem lidar com esses links. Este comportamento automático fornece a melhor experiência possível aos seus usuários
 * de aplicativos que abrem ligações goo.gl, não importa qual plataforma ou dispositivo que eles estão.
 *
 */
namespace Asmpkg\Shortener;


class Shortener
{

    protected $apiUrl   =   'https://www.googleapis.com/urlshortener/v1/url';

    public $apiKey;


    /**
     * Shortener constructor.
     * @param $apiKey
     *
     * You must submit the Api key to start
     */

    public function __construct($apiKey)
    {
        $this->apiKey   =   $apiKey;
        $this->apiUrl   .=   '?key='.$this->apiKey;
    }

    /**
     * @param $url The parameter URL can be placed on the long or short url.
     * @param bool|true $shorten If you want to get short url TRUE if you want to get a long url FALSE
     * @return mixed
     *
     * For the short url must be set Url Long and True.
     * For the long url must be set Url short and false
     */
    public function shorten($url, $shorten = true)
    {
        return $this->send($url, $shorten);
    }


    private function send($url, $shorten = true)
    {
        $ch = curl_init();

        if ($shorten){
            curl_setopt($ch,CURLOPT_URL,$this->apiUrl);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode(["longUrl"=>$url]));
            curl_setopt($ch,CURLOPT_HTTPHEADER,["Content-Type: application/json"]);
        }else{
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch,CURLOPT_URL,$this->apiURL.'&shortUrl='.$url);
        }

        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        $result = curl_exec($ch);

        return json_decode($result,true);
    }
}