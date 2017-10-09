<?php
namespace Libs;
require_once('vendor/autoload.php');

use Libs\Extrator as Extrator;
use Libs\Downloader as Downloader;

class Crawler {
    const TEMPO_LIMITE = 1800; // meia hora
    var $extrator;
    var $downloader;

    function __construct() {
        $this->extrator = new Extrator;
        $this->downloader = new Downloader;
    }
    
    function set_pasta($pasta) {$this->downloader->set_pasta($pasta);}
    
    function get_todos() {return $this->extrator->extrair();}
    
    function get_novos() {
        $lista = $this->get_todos();
        $lista_novos = array();
        $n = 0;
        for($loop = 0; $loop < count($lista); $loop++) {
            $this->downloader->set_url($lista[$loop]);
            if(!$this->downloader->checar_existe()) {
                $lista_novos[$n] = $lista[$loop];
                $n++;
            }
        }
        return $lista_novos;
    }
    
    function start($limite = false) {
        if($this->esta_travado()) return false;
        
        $this->travar();
        
        $lista = $this->get_novos();
        if($limite === false || $limite > count($lista)) $limite = count($lista);

        for($loop = 0; $loop < $limite; $loop++) {
            $this->downloader->set_url($lista[$loop]);
            if(!$this->downloader->checar_existe())
                $this->downloader->executar();
        }

        $this->destravar();

        return true;
    }
    
    function progresso() {
        $all = count($this->get_todos());
        $novos = count($this->get_novos());
        
        return (($all-$novos)/$all)*100;
    }
    
    function esta_travado() {
        if($this->downloader->pasta == '') throw new \Exception('Pasta dos NerdCast não definida');
        
        if(!file_exists($this->downloader->pasta.'/crawler.lock')) return false;
        $momento = (int)file_get_contents($this->downloader->pasta.'/crawler.lock');
        if((time() - $momento) > self::TEMPO_LIMITE) {
            @unlink($this->downloader->pasta.'/crawler.lock');
            return false;
        }
        return true;
    }
    
    function travar() {
        if($this->downloader->pasta == '') throw new \Exception('Pasta dos NerdCast não definida');
        
        if(file_exists($this->downloader->pasta.'/crawler.lock')) return false;
        file_put_contents($this->downloader->pasta.'/crawler.lock', time());
        return true;
    }
    
    function destravar() {
        if($this->downloader->pasta == '') throw new \Exception('Pasta dos NerdCast não definida');
        
        if(!file_exists($this->downloader->pasta.'/crawler.lock')) return false;
        @unlink($this->downloader->pasta.'/crawler.lock');
        return true;
    }
}

?>