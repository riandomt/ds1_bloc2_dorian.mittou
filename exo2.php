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

    // On oblige les classes filles à définir les méthodes abstract
    abstract function decelerer($vitesse);
    abstract function accelerer($vitesse);

    // Fonction pour démarrer le véhicule
    public function demarrer() 
    {
        $this->demarrer = TRUE;
    }

    // Fonction pour éteindre le véhicule
    public function eteindre() 
    {
        $this->demarrer = FALSE;
    }

    // Vérifier si le véhicule est démarré
    public function estDemarre() 
    {
        return $this->demarrer;
    }

    // Vérifier si le véhicule est éteint
    public function estEteint() 
    {
        return !$this->demarrer;
    }

    // Obtenir la vitesse actuelle
    public function getVitesse() 
    {
        return $this->vitesse;
    }

    // Obtenir la vitesse maximale
    public function getVitesseMax() 
    {
        return $this->vitesseMax;
    }

    // Méthode magique toString pour afficher un véhicule
    public function __toString() 
    {
        $chaine = "Ceci est un véhicule <br/>";
        $chaine .= "---------------------- <br/>";
        return $chaine;
    }
}

class Avion extends Vehicule
{
            /**
     *@author Dorian Mittou <mittou.dorian@gmail.com>
     * @var float $altitude;
     * @var float $altitudeMax;
     * @var bool $trainAtterisage;
     * @var int PLAFOND_MAX;
     * @var int VITESSE_MAX;
     * @var integer $vitesseMax;
     */
    private float $altitude;
    private float $altitudeMax;
    private bool $trainAtterisage = FALSE;
    CONST PLAFOND_MAX = 40000;
    const VITESSE_MAX = 2000;

    public function __construct($vitesseMax)
    {
        $this->setVitesseMax($vitesseMax);
    }

    public function decoller()
    {
        try {
            if($this->getDemarrer()) {
                if($this->getVitesse() >=120) {
                    $this->prendreAltitude();
                } else {
                    throw new Exception("vous ne respectez pas la vitesse minimale de décolage de 120km/h");
                }
            } else {
                throw new Exception("le moteur de l'avion n'est pas demarrer");
            }
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }

    public function atterir()
    {
        try {
            if($this->getTrainAtterisage()) {
                if($this->getVitesse() >= 80 && $this->getVitesse() <= 110) {
                    if($this->getAltitude() >= 50 && $this->getAltitude() <= 150) {
                        $this->setAltitude(0);
                    } else {
                        throw new Exception("L'atterissage ne respecte pas l'altitude autorisé");
                    }
                } else {
                    throw new Exception("L'atterissage ne respecte pas la vitesse autorisé");
                }
            } else {
                throw new Exception("Le train d'atterisage n'est pas disponible");
            }


            
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
        
    }

    public function prendreAltitude()
    {
        $this->setAltitude(100);
    }

    public function perdreAltitude($altitude)
    {
        $this->altitude = $altitude;
    }

    public function accelerer($vitesse)
    {
        
    }

    public function decelerer($vitesse)
    {
        
    }

    public function getVitesseMax():int
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

    private function getAltitude():int
    {
        return $this->altitude;
    }

    private function getTrainAtterisage():bool
    {
        return $this->trainAtterisage;
    }

    private function setVitesse(int $vitesse)
    {
        $this->vitesse = $vitesse;
    }
    

    public function setVitesseMax(int $vitesseMax)
    {
        $this->vitesseMax = $vitesseMax;
    }

    public function setDemarrer(bool $demarrer)
    {
        $this->demarrer = $demarrer;
    }

    private function setAltitude(int $altitude)
    {
        $this->altitude = $altitude;
    }

    private function setTrainAtterisage(bool $trainAtterisage)
    {
        $this->trainAtterisage = $trainAtterisage;
    }

}