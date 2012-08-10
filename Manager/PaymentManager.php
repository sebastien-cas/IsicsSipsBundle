<?php

namespace Isics\SipsBundle\Manager;

use Isics\SipsBundle\Model\Request;
use Isics\SipsBundle\Model\Response;
use Symfony\Component\Process\Process;

class PaymentManager
{
    /**
     * @var array $params  Paramètres e-Transaction
     */
    protected $params;
    
    
    
    /**
     * Construit l'objet
     *
     * @param array $params  Paramètres SIPS
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }
    
    /**
     * Retourne la demande
     *
     * @param array $data  Données utiles pour la requête
     *
     * @return Request
     */
    public function getRequest(array $data)
    {
        // Le montant est requis
        if (!isset($data['amount'])) {
            throw new \InvalidArgumentException('Amount is required.');
        }
        
        // Ajout des données
        $params = '';
        foreach ($data as $key => $value) {
            $params .= ' '.$key.'='.$value;
        }

        // Récupération des paramètres obligatoires
        $params .= ' merchant_id='.$this->params['merchant_id']
            .' merchant_country='.$this->params['merchant_country']
            .' currency_code='.$this->params['currency_code']
            .' pathfile='.$this->params['pathfile'];
        
        // Récupération des paramètres optionnels
        if (isset($this->params['options'])) {
            foreach ($this->params['options'] as $key => $param) {
                $params .= ' '.$key.'='.$param;
            }
        }
    
        // Execution de la commande
        $cmd = $this->params['request'].' '.$params;
        $process  = new Process($cmd);
        $exitCode = $process->run();
        if (0 !== $exitCode) {
            throw new \RuntimeException('Unable to execute request binary file: '.$cmd);
        }
      
        return new Request(explode("!", $process->getOutput()));
    }
     
    /**
     * Retourne la réponse de la banque en clair
     *
     * @param string $data  Données transmises par la banque (cryptées)
     *
     * @return Response
     */
    public function getResponse($data)
    {
        if (empty($data)) {
            throw new \InvalidArgumentException('Payment data are required.');
        }
        
        // Récupération des paramètres obligatoires
        $params = ' pathfile='.$this->params['pathfile'].' message='.$data;
            
        // Execution de la commande
        $cmd = $this->params['response'].' '.$params;
        $process  = new Process($cmd);
        $exitCode = $process->run();
        if (0 !== $exitCode) {
            throw new \RuntimeException('Unable to execute response binary file : '.$cmd);
        }
        
        return new Response(explode("!", $process->getOutput()));
    }
}