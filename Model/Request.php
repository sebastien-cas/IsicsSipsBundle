<?php

namespace Isics\SipsBundle\Model;

/**
 * Données renvoyées par le binaire request
 */
class Request
{
    public $code;
    public $error;
    public $htmlForm;
    
    
    
    /**
     * Construit l'objet
     *
     * @param array $data  Données issues du binaire request
     */
    public function __construct(array $data)
    {
        $this->code     = $data[1];
        $this->error    = $data[2];
        $this->htmlForm = $data[3];
    }
    
    /**
     * Retourne vrai si la demande a été générée avec succès
     *
     * @return boolean
     */
    public function isProcessedSuccessfully()
    {
        return $this->code == 0;
    }
}