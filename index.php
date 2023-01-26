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
        $tredicesima = $this->getTredicesima() == 'si' ? $this->getMensile() : 0;
        $quattordicesima = $this->getQuattordicesima() == 'si' ? $this->getMensile() : 0;
        return $this->getMensile() * 12 + $tredicesima + $quattordicesima;
    }
}

class Persona
{
    private $nome;
    private $cognome;
    private $dataNascita;
    private $luogoNascita;
    private $codiceFiscale;

    public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $codiceFiscale)
    {
        $this->setNome($nome);
        $this->setCognome($cognome);
        $this->setDataNascita($dataNascita);
        $this->setLuogoNascita($luogoNascita);
        $this->setCodiceFiscale($codiceFiscale);
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getCognome()
    {
        return $this->cognome;
    }
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }
    public function getDataNascita()
    {
        return $this->dataNascita;
    }
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;
    }
    public function getLuogoNascita()
    {
        return $this->luogoNascita;
    }
    public function setLuogoNascita($luogoNascita)
    {
        $this->luogoNascita = $luogoNascita;
    }
    public function getCodiceFiscale()
    {
        return $this->codiceFiscale;
    }
    public function setCodiceFiscale($codiceFiscale)
    {
        $this->codiceFiscale = $codiceFiscale;
    }

    public function getHtml()
    {
        return 'Nome: ' . $this->getNome()
            . '<br> Cognome: ' . $this->getCognome()
            . '<br> Data di nascita: ' . $this->getDataNascita()
            . '<br> Luogo di nascita: ' . $this->getLuogoNascita()
            . '<br> Codice fiscale: ' . $this->getCodiceFiscale();
    }
}

class Impiegato extends Persona
{
    private $stipendio;
    private $dataAssunzione;

    public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $codiceFiscale, $stipendio, $dataAssunzione)
    {
        parent::__construct($nome, $cognome, $dataNascita, $luogoNascita, $codiceFiscale);

        $this->setStipendio($stipendio);
        $this->setDataAssunzione($dataAssunzione);
    }

    public function getStipendio()
    {
        return $this->stipendio;
    }
    public function setStipendio($stipendio)
    {
        $this->stipendio = $stipendio;
    }
    public function getDataAssunzione()
    {
        return $this->dataAssunzione;
    }
    public function setDataAssunzione($dataAssunzione)
    {
        $this->dataAssunzione = $dataAssunzione;
    }

    public function getStipendioAnnuale()
    {
        return $this->getStipendio()->getAnnuale();
    }

    public function getHtml()
    {
        $html = parent::getHtml();
        $html .= '<br> Data di assunzione: '
            . $this->getDataAssunzione()
            . '<br> Stipendio annuale: '
            . $this->getStipendioAnnuale();
        return $html;
    }
}

class Capo extends Persona
{
    private $dividendo;
    private $bonus;

    public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $codiceFiscale, $dividendo, $bonus)
    {
        parent::__construct($nome, $cognome, $dataNascita, $luogoNascita, $codiceFiscale);
        $this->setDividendo($dividendo);
        $this->setBonus($bonus);
    }

    public function getDividendo()
    {
        return $this->dividendo;
    }
    public function setDividendo($dividendo)
    {
        $this->dividendo = $dividendo;
    }
    public function getBonus()
    {
        return $this->bonus;
    }
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;
    }

    public function getRedditoAnnuale()
    {
        return $this->getDividendo() * 12 + $this->getBonus();
    }

    public function getHtml()
    {
        $html = parent::getHtml();
        $html .= '<br> Dividendo annuale: ' . $this->getDividendo()
            . '<br> Bonus: ' . $this->getBonus()
            . '<br> Reddito annuale: ' . $this->getRedditoAnnuale();
        return $html;
    }
}

$stipendio = new Stipendio(1300, "no", "no");
echo $stipendio->getHtml() . "<br>" . "<br>";

$persona = new Persona("Silvio", "Rossi", "04-02-1997", "Milano", "SLVGRI95Z4505F");
echo $persona->getHtml() . "<br>" . "<br>";

$impiegato = new Impiegato('Mario', 'Rossi', '01-01-1989', 'Roma', 'ABCDEF01G01H123I', $stipendio, '02-01-2019');
echo $impiegato->getHtml() . "<br>" . "<br>";

$capo = new Capo('Fabio', 'Forghieri', '01/01/1980', 'Milano', 'GHIJKL01M01N234O', 500000, 10000);
echo $capo->getHtml() . "<br>" . "<br>";