<?php
require_once('vendor/autoload.php');
use Libs\Crawler as Crawler;

$crawler = new Crawler;
$crawler->set_pasta('data');

//$crawler->start(2);

echo $crawler->progresso();

?>