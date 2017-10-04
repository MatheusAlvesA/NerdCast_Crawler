<?php
use Libs\Extrator as Extrator;

class ExtratorTest extends PHPUnit_Framework_TestCase {

    public function testExtrator() {
        $extrator = new Extrator;
        
        $this->assertTrue($extrator->download_dados('https://jovemnerd.com.br/feed-nerdcast/') != null, 'Falha no download do Feed');
        
        $this->assertArraySubset(array(
                0 => "https://nerdcast.jovemnerd.com.br/nerdcast_587_defensores.mp3",
                1 => "https://nerdcast.jovemnerd.com.br/nerdcast_empreendedor_33.mp3",
                2 => "https://nerdcast.jovemnerd.com.br/nerdcast_586_o_melhor_hamburguer_do_brasil.mp3"
            ),
            $extrator->_getVetor('<title>NerdCast 587 - Quem defende os Defensores?</title>
      <link>https://jovemnerd.com.br/?podcast=quem-defende-os-defensores</link>
      <itunes:summary>Conheça o maior segredo para ser imortal, ninja de paletó e não se esqueça: "Eu sou o imortal Punho de Ferro".</itunes:summary>
      <itunes:duration>01:50:36</itunes:duration>
      <enclosure url="https://nerdcast.jovemnerd.com.br/nerdcast_587_defensores.mp3" length="6636" type="audio/mpeg"/>
      <pubDate>Fri, 29 Sep 2017 11:01:40 +0000</pubDate>
      <guid>https://jovemnerd.com.br/?podcast=quem-defende-os-defensores</guid>
      <description><![CDATA[Neste podcast: Conheça o maior segredo para ser imortal, ninja de paletó e não se esqueça: "Eu sou o imortal Punho de Ferro".
ARTE DA VITRINE: André Carvalho
Kingsman: O Círculo Dourado

 	28 de setembro nos cinemas.
 	Assista o trailer: https://youtu.be/LqehHzvyaKw
 	Acesse o Facebook: https://www.facebook.com/KingsmanFilme

Nerdcast Empreendedor

 	Nerdcast Empreendedor 33 - Ray Kroc: Fome de expansão: http://bit.ly/2hBqwSX
 	Playlist completa Nerdcast Empreendedor: http://bit.ly/2cS4M22

Nerdcast Stories


Assista: Vem comigo
E-MAILS

 	Mande suas críticas, elogios, sugestões e caneladas para nerdcast@jovemnerd.com.br

EDIÇÃO COMPLETA POR RADIOFOBIA PODCAST E MULTIMÍDIA

 	http://radiofobia.com.br
]]></description>
    </item>
        <item>
      <title>Empreendedor 33 - Ray Kroc: Fome de expansão</title>
      <link>https://jovemnerd.com.br/?podcast=ray-kroc-fome-de-expansao</link>
      <itunes:summary>Discutimos o filme The Founder (Fome de Poder) e fazemos paralelos com a realidade vivida por Ray Kroc e os irmãos McDonald.</itunes:summary>
      <itunes:duration>01:07:11</itunes:duration>
      <enclosure url="https://nerdcast.jovemnerd.com.br/nerdcast_empreendedor_33.mp3" length="4031" type="audio/mpeg"/>
      <pubDate>Fri, 29 Sep 2017 11:00:40 +0000</pubDate>
      <guid>https://jovemnerd.com.br/?podcast=ray-kroc-fome-de-expansao</guid>
      <description><![CDATA[Neste podcast: Discutimos o filme The Founder (Fome de Poder) e fazemos paralelos com a realidade vivida por Ray Kroc e os irmãos McDonald.
ARTE DA VITRINE:  André Carvalho
LINK PARA A PROMOÇÃO

 	Acesse: https://meusucesso.com/jovemnerd

PROGRAMA ANTERIOR

 	Nerdcast Empreendedor 32 - Shiba in box: http://bit.ly/2vlEB9b
 	Playlist completa Nerdcast Empreendedor: http://bit.ly/2cS4M22

FEED DO NERDCAST

 	http://feed.nerdcast.com.br

E-MAILS

 	Mande suas críticas, elogios, sugestões e caneladas para nerdcast@jovemnerd.com.br

EDIÇÃO COMPLETA POR RADIOFOBIA PODCAST E MULTIMÍDIA

 	http://radiofobia.com.br
]]></description>
    </item>
        <item>
      <title>NerdCast 586 - O melhor hambúrguer do Brasil</title>
      <link>https://jovemnerd.com.br/?podcast=o-melhor-hamburguer-do-brasil</link>
      <itunes:summary>Fernandinho mãos bonitas, mais conhecido como Tucano, conta pra gente como foi sua saga até vencer o concurso de melhor hambúrguer do Brasil!</itunes:summary>
      <itunes:duration>01:43:40</itunes:duration>
      <enclosure url="https://nerdcast.jovemnerd.com.br/nerdcast_586_o_melhor_hamburguer_do_brasil.mp3" length="6220" type="audio/mpeg"/>
      <pubDate>Fri, 22 Sep 2017 11:00:24 +0000</pubDate>
      <guid>https://jovemnerd.com.br/?podcast=o-melhor-hamburguer-do-brasil</guid>
      <description>')
        );
    }
    
}
?>