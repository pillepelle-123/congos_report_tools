<?php
namespace App\Custom;

class Custom
{
    protected $antwort;

    public function __construct()
    {
        $this->antwort = 'Dies ist eine benutzerdefinierte Klasse.';
    }

    public function getAntwort()
    {
        return $this->antwort;
    }
}
