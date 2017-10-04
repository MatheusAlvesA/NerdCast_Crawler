<?php
use Libs\Downloader as Downloader;

class DownloaderTest extends PHPUnit_Framework_TestCase {
    var $d;
    function setUp() {
        $this->d = new Downloader;
    }

    public function testset_url() {
        $this->d->set_url('https://nerdcast.jovemnerd.com.br/nerdcast_587_defensores.mp3');
        
        $this->assertEquals($this->d->url, 'https://nerdcast.jovemnerd.com.br/nerdcast_587_defensores.mp3');
    }
    
    public function testset_pasta() {
        $this->d->set_pasta('testes');
        
        $this->assertEquals($this->d->pasta, 'testes');
    }
    
    public function testurl2nome() {
        $this->d->set_pasta('testes');
        
        $this->assertEquals($this->d->url2nome('https://nerdcast.jovemnerd.com.br/nerdcast_587_defensores.mp3'), 'nerdcast_587_defensores.mp3');
    }
    
    public function testchecar_existe() {
        $this->assertFalse($this->d->checar_existe());
    }
}
?>