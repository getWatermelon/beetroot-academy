<?php
declare(strict_types=1);


namespace App\Command;


class Whois extends Command
{

    public function run(string $domain) : array
    {
       return $this->execute("/usr/bin/whois $domain");
    }

}