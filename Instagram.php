<?php
$instagram_client_id ='f8f3836d6c0d4140965a83a9898792bb';
$your_website_redirect_uri ='http://giftscome.com.cp-28.hostgatorwebservers.com';
$authorization_url = "https://api.instagram.com/oauth/authorize/?client_id=".$instagram_client_id."&redirect_uri=".$your_website_redirect_uri."&response_type=code";
$username='imgurpreet_singh';
$password='mtharu390';
$_defaultHeaders = array(
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: en-US,en;q=0.5',
        'Accept-Encoding: ',
        'Connection: keep-alive',
        'Upgrade-Insecure-Requests: 1',
        'Cache-Control: max-age=0'
    );
$ch  = curl_init();
    $cookie='/application/'.strtoupper(VERSI)."instagram_cookie/instagram.txt";
            curl_setopt( $ch, CURLOPT_POST, 0 );
            curl_setopt( $ch, CURLOPT_HTTPGET, 1 );
            if($this->token!==null){
                array_push($this->_defaultHeaders,"Authorization: ".$this->token);   
            }
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->_defaultHeaders);
            curl_setopt( $ch, CURLOPT_HEADER, true);
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_COOKIEFILE,getcwd().$cookie );
            curl_setopt( $ch, CURLOPT_COOKIEJAR, getcwd().$cookie );
            curl_setopt($this->curlHandle,CURLOPT_URL,$url);
            curl_setopt($this->curlHandle,CURLOPT_FOLLOWLOCATION,true);

            $result = curl_exec($this->curlHandle);
            $redirect_uri = curl_getinfo($this->curlHandle, CURLINFO_EFFECTIVE_URL);
            $form = explode('login-form',$result)[1];
        $form = explode("action=\"",$form)[1];
//        vd('asd',$form);
        $action = substr($form,0,strpos($form,"\""));
//        vd('action',$action);
        $csrfmiddlewaretoken = explode("csrfmiddlewaretoken\" value=\"",$form);
        $csrfmiddlewaretoken = substr($csrfmiddlewaretoken[1],0,strpos($csrfmiddlewaretoken[1],"\""));
        //finish getting parameter
        $post_param['csrfmiddlewaretoken']=$csrfmiddlewaretoken;
        $post_param['username']=$username;
        $post_param['password']=$password;
//format instagram cookie from vaha's answer https://stackoverflow.com/questions/26003063/instagram-login-programatically
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
    $cookieFileContent = '';

    foreach($matches[1] as $item)
    {
        $cookieFileContent .= "$item; ";
    }
    $cookieFileContent = rtrim($cookieFileContent, '; ');
    $cookieFileContent = str_replace('sessionid=; ', '', $cookieFileContent);
    $cookie=getcwd().'/application/'.strtoupper(VERSI)."instagram_cookie/instagram.txt";
    $oldContent = file_get_contents($cookie);
    $oldContArr = explode("\n", $oldContent);
    if(count($oldContArr))
    {
        foreach($oldContArr as $k => $line)
        {
            if(strstr($line, '# '))
            {
                unset($oldContArr[$k]);
            }
        }

        $newContent = implode("\n", $oldContArr);
        $newContent = trim($newContent, "\n");
        file_put_contents(
            $cookie,
            $newContent
        );
    }
    // end format
    $useragent = "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0";
    $arrSetHeaders = array(
        'origin: https://www.instagram.com',
        'authority: www.instagram.com',
        'upgrade-insecure-requests: 1',
        'Host: www.instagram.com',
        "User-Agent: $useragent",
        'content-type: application/x-www-form-urlencoded',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: en-US,en;q=0.5',
        'Accept-Encoding: deflate, br',
        "Referer: $redirect_uri",
        "Cookie: $cookieFileContent",
        'Connection: keep-alive',
        'cache-control: max-age=0',
    );
    $ch  = curl_init();
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."/".$cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."/".$cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrSetHeaders);
    curl_setopt($ch, CURLOPT_URL, $this->base_url.$action);
    curl_setopt($ch, CURLOPT_REFERER, $redirect_uri);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_param));
    sleep(5);
    $page = curl_exec($ch);
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $page, $matches);
    $cookies = array();
    foreach($matches[1] as $item) {
        parse_str($item, $cookie1);
        $cookies = array_merge($cookies, $cookie1);
    }
var_dump($page);
?>