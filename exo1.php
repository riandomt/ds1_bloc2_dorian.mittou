<?php

abstract class Vehicule
{
    /**
     *@author Dorian Mittou <mittou.dorian@gmail.com>
     * @var bool $demarrer;
     * @var integer $vitesse;
     * @var integer $vitesseMax;
     */

    protected bool $demarrer = FALSE;
    protected int $vitesse = 0;
    protected int $vitesseMax;

    // On oblige les classes filles à définir les méthodes abstracts
    abstract function demarrer();
    abstract function eteindre();
    abstract function decelerer($vitesse);
    abstract function accelerer($vitesse);

    // Méthode magique toString
    public function __toString()
    {
        $chaine = "Ceci est un véhicule <br/>";
        $chaine .= "---------------------- <br/>";
        return $chaine;
    }
}

class Voiture extends Vehicule
{

    /**
     *@author Dorian Mittou <mittou.dorian@gmail.com>
     * @var integer $nbrVoiture;
     */
    public static $nbrVoiture = 0;

    public function __construct($vitesseMax)
    {
        self::$nbrVoiture++;
        $this->setVitesseMax($vitesseMax);
    }

    public static function getNombreVoiture()
    {
        return self::$nbrVoiture;
    }
    public function getVitesseMax(): int
    {
        return $this->vitesseMax;
    }

    public function getVitesse(): int
    {
        return $this->vitesse;
    }

    public function getDemarrer(): bool
    {
        return $this->demarrer;
    }

    public function setVitesseMax(int $vitesseMax)
    {
        $this->vitesseMax = $vitesseMax;
    }

    public function setDemarrer(bool $demarrer)
    {
        $this->demarrer = $demarrer;
    }

    private function setVitesse(int $vitesse)
    {
        $this->vitesse = $vitesse;
    }

    public function demarrer():void
    {
        try {
            $demarrer = $this->getDemarrer();
            if (!$demarrer) {
                $this->setDemarrer(true);
            } else {
                throw new Exception('La voiture est déjà demarrer');
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }

    public function eteindre():void
    {
        $vitesseActuelle = $this->getVitesse();
        try {
            if ($vitesseActuelle == 0) {
                $this->setDemarrer(false);
            } else {
                throw new Exception("Imposible d'activer le frein de stationnement, la voiture roule encore");
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }
    public function accelerer($vitesse):void
    {
        try {
            if ($this->getDemarrer()) {
                $vitesseActuelle = $this->getVitesse();

                if ($vitesseActuelle == 0 && $vitesse <= 10) {
                    $this->setVitesse($vitesse);
                } else {
                    if ($vitesse <= $vitesseActuelle * 1.30 && $vitesseActuelle != 0) {
                        $this->setVitesse($vitesse);
                    } else {
                        throw new Exception('la vitesse pour accelerer ne dois pas être supérieur à 30% de la vitesse actuelle');
                    }
                    throw new Exception('la vitesse de demarage ne dois pas dépassé 10km/h');
                }
            } else {
                throw new Exception("La voiture n'est pas démarrer");
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }

    public function decelerer($vitesse):void
    {
        try {
            if ($this->getDemarrer()) {
                $vitesseActuelle = $this->getVitesse();
                if ($vitesse <= 20 && $vitesseActuelle != 0) {
                    $this->setVitesse($vitesse);
                } else {
                    throw new Exception('Impossible de ralentir de plus de 20km/h');
                }
            } else {
                throw new Exception("La voiture n'est pas démarrer");
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }
}

$veh1 = new Voiture(110);
$veh1->demarrer();
$veh1->accelerer(40);
echo $veh1;
$veh1->accelerer(40);
echo $veh1;
$veh1->accelerer(12);
$veh1->accelerer(40);
echo $veh1;
$veh1->accelerer(40);
$veh1->decelerer(120);
echo $veh1;

$veh2 = new Voiture(180);
echo $veh2;

echo "############################ <br/>";
echo "Nombre de voiture instanciée : " . Voiture::getNombreVoiture() . "<br/>";