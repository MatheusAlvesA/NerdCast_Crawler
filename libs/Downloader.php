<?php

namespace Libs;

class Downloader {
    var $url;
    var $pasta;
    function __construct($url = null, $pasta = null) {
        $this->url = $url;
        $this->pasta = $pasta;
    }
    
    function set_url($url) {$this->url = $url;}
    function set_pasta($pasta) {$this->pasta = $pasta;}
    
    function checar_existe() {
        if($this->url == null || $this->pasta == null) return false;
        
        return file_exists($this->pasta.'/'.$this->url2nome($this->url));
    }
    
    function url2nome($url) {
        $vetor  = explode('/', $url);
        return end($vetor);
    }
    
    function executar() {
        if($this->url == null || $this->pasta == null) return false;

        $con = curl_init();
        $arq = fopen($this->pasta.'/'.$this->url2nome($this->url), 'w+');
        
        curl_setopt($con, CURLOPT_URL, $this->url);
        curl_setopt($con, CURLOPT_FILE, $arq);
        curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($con, CURLOPT_SSLVERSION,4);
        curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
        
        curl_exec($con);
        
        if(curl_error($con)) {
            echo 'Erro no curl: '.curl_error($con);
            return false;
        }
        
        curl_close ($con);
        fclose($arq);
        
        return true;
    }
}

?>