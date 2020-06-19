
<?php
require 'vendor/autoload.php';

$command = new \App\Command\CompositeCommand(
    new \App\Command\Whois(),
    new \App\Command\Nslookup(),
    new \App\Command\GeoIp()
);
//$output = $command->run($_POST['search']);
//$command = new \App\Command\Nslookup();
//$output = $command->run($_POST['search']);
//$whois = new \App\Command\Whois();
//$output = array_merge($output, $whois->run($_POST['search']));
//$geoip = new \App\Command\GeoIp();
//$output  = array_merge($output, $geoip->run($_POST['search']));
//$template = new \App\View\Template($output);
echo new \App\View\Template($command->run($_POST['search']), $_POST['type']);



