<?php
namespace Libs;
require_once('vendor/autoload.php');

use Libs\Extrator as Extrator;
use Libs\Downloader as Downloader;

class Crawler {
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
        $lista = $this->get_novos();
        if($limite === false || $limite > count($lista)) $limite = count($lista);

        for($loop = 0; $loop < $limite; $loop++) {
            $this->downloader->set_url($lista[$loop]);
            if(!$this->downloader->checar_existe())
                $this->downloader->executar();
        }

        return true;
    }
    
    function progresso() {
        $all = count($this->get_todos());
        $novos = count($this->get_novos());
        
        return (($all-$novos)/$all)*100;
    }
}

?>