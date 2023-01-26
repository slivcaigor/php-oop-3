<?php

class Stipendio
{
    private $mensile;
    private $tredicesima;
    private $quattordicesima;

    public function __construct($mensile, $tredicesima, $quattordicesima)
    {
        $this->setMensile($mensile);
        $this->setTredicesima($tredicesima);
        $this->setQuattordicesima($quattordicesima);
    }

    public function getMensile()
    {
        return $this->mensile;
    }
    public function setMensile($mensile)
    {
        $this->mensile = $mensile;
    }
    public function getTredicesima()
    {
        return $this->tredicesima;
    }
    public function setTredicesima($tredicesima)
    {
        $this->tredicesima = $tredicesima;
    }
    public function getQuattordicesima()
    {
        return $this->quattordicesima;
    }
    public function setQuattordicesima($quattordicesima)
    {
        $this->quattordicesima = $quattordicesima;
    }

    public function getHtml()
    {
        return
            'Stipendio mensile: '
            . $this->getMensile()
            . '<br> Tredicesima: '
            . $this->getTredicesima()
            . '<br> Quattordicesima: '
            . $this->getQuattordicesima();
    }

    // calcolo stipendio annuale se indicate tredicesima e quattoridcesima come "si", altrimenti vengono considerate "0"
    public function getAnnuale()
    {
        $tredicesima = $this->tredicesima == 'si' ? $this->mensile : 0;
        $quattordicesima = $this->quattordicesima == 'si' ? $this->mensile : 0;
        return $this->mensile * 12 + $tredicesima + $quattordicesima;
    }
}

$stipendio = new Stipendio(1200, "si", "si");
echo $stipendio->getHtml();