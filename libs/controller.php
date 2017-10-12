<?php
require_once('vendor/autoload.php');
use Libs\Crawler as Crawler;

$pasta = 'data'; // a pasta que vai guardar os nerdcasts. Essa pasta deve existir
$downloads_por_vez = 1; // Quantantos nerdcasts baixar por vez

$crawler = new Crawler;
$crawler->set_pasta($pasta);

/*
    Esta função executa o download de novos nerdcasts
*/
function motor() {
    global $crawler, $downloads_por_vez;
    $crawler->start($downloads_por_vez);
}

/*
    Retorna um vetor com todos os links para nerdcasts
*/
function get_lista_completa() {
    global $crawler;
    return $crawler->get_todos();
}

/*
    Retorna um vetor com apenas links para nerdcasts que ainda não foram baixados
*/
function get_lista_novos() {
    global $crawler;
    return $crawler->get_novos();
}

/*
    Retorna um valor float com a porcentagem do número de nerdcasts baixados
*/
function get_progresso() {
    global $crawler;
    return $crawler->progresso();
}
/*
    Retorna o log dos ultimos nerdcasts baixados
    returns vetor de strings
*/
function get_log() {
    global $crawler;
    return $crawler->get_log();
}
/*
    Deleta o log esvazeando
*/
function reset_log() {
    global $crawler;
    $crawler->delete_log();
}
?>