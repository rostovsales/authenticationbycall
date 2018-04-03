<?php

//!--------------------------------------------------------
// @class        Authentication by call
// @site         https://authenticationbycall.com/docs
// @company      http://5rm.io
// @author       Eugene Kartysh
// @licence      
// @version      03042018
//!--------------------------------------------------------



class abc
{

    /**
     * Take it on https://authenticationbycall.com/login
     */
    private static $api_token = '';
    private static $form_token = '';


    /**
     * Creating new authentication
     * @access public
     * @param string $telephone telephone
     * @return array:
     * [RU] - Russian telephone for authnetication call
     * [EU] - Europe telephone for authnetication call
     * [uniq_id] - authentication uniq id
     */
    public static function authpost($telephone)
    {
        $params = array(
            'method' => 'authpost',
            'api_token' => self::$api_token,
            'form_token' => self::$form_token,
            'telephone' => $telephone,
        );

        $response = self::api_curl($params);
        $response = json_decode($response, true);
        return $response;
    }

    /**
     * check status of authentication
     * @access public
     * @param string $uniq_id authentication uniq id
     * @return int 1 - waiting for call, 2 - success call
     */
    public static function authget($uniq_id)
    {
        $params = array(
            'method' => 'authget',
            'api_token' => self::$api_token,
            'form_token' => self::$form_token,
            'uniq_id' => $uniq_id,
        );
        $response = self::api_curl($params);
        $response = json_decode($response, true);
        return $response;
    }


    /**
     * geting list of phonenumbers that waiting calls
     * @access public
     * @return array:
     * [RU] - Russian telephone for authnetication call
     * [EU] - Europe telephone for authnetication call
     */
    public static function phonenumbersget()
    {
        $params = array(
            'method' => 'phonenumbersget',
            'api_token' => self::$api_token,
            'form_token' => self::$form_token
        );
        $response = self::api_curl($params);
        $response = json_decode($response, true);
        return $response;
    }

//  method for send curl
    private function api_curl($params)
    {
        $url = 'https://authenticationbycall.com/api/';

        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params)
        ));
        $response = curl_exec($myCurl);
        curl_close($myCurl);
        return $response;
    }


    public function api_fileGetContents($link)
    {
        return file_get_contents($link);
    }

}