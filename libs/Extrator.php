<?php

namespace Libs;

class Extrator {
    var $url = 'https://jovemnerd.com.br/feed-nerdcast/';
    var $bruto;
    function __construct() {
        $this->bruto = $this->download_dados($this->url);
    }
    
    function extrair() {
        return $this->_getVetor($this->bruto);
    }
    
    function _getVetor($bruto) {
        $matches =  array();
        preg_match_all('/(<enclosure){1}(.*)(\/>)/', $bruto, $matches);
        $refinado = $matches[2];
        //refinando
        $vetor_final = array();
        for($loop = 0; $loop < count($refinado); $loop++) {
            preg_match('/(url=")[^"]*(")/', $refinado[$loop], $match);
            $vetor_final[$loop] = substr($match[0], 5, -1);
        }
        
        return $vetor_final;
    }
    
    function download_dados($url) {return file_get_contents($url);}
}

?>