<?php

namespace Isics\EtransactionBundle\Manager;

use Symfony\Component\Process\Process;

class EtransactionManager
{
    /**
     * @var array $params  Paramètres e-Transaction
     */
    protected $params;
    
    
    
    /**
     * Construit l'objet
     *
     * @param array $params  Paramètres e-transaction
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }
    
    /**
     * Retourne le formulaire de demande de paiement sécurisé
     *
     * @param array $data  Données utiles pour la requête
     *
     * @return string
     */
    public function getFormRequest(array $data)
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
        // $cmd = $this->params['request'].' '.$params;
        //     $process  = new Process($cmd);
        //     $exitCode = $process->run();
        //     if (0 !== $exitCode) {
        //         throw new \Exception('Unable to execute request binary file with this command : '.$cmd);
        //     }
    
        return '<FORM METHOD=POST ACTION="https://paiement.e-transactions.credit-agricole.fr:443/cgis-payment-etransactions/demo/callpayment" target="_top"><INPUT TYPE=HIDDEN NAME=DATA VALUE="2020353136603028502c2360552c3338532d2360512d4360502c3360502c2331302d4360505c224360542c3360502c2340522c2360502c2334522e3048502c2328502c2324552c2324532c2330542e233c562d3324512c3324515c224360522e3360502c2329463c4048502c232c502c2360542c3360582c6048502c2334502c2360562c3344512e332c525c224360502d4360502c3330522c2324522c2338512e2324572c3344532c4048502c2340502c2360532e333c585c224360522e2360502c2329463c4048502c2344502c2360523947282a2c2324512c2360592d2641543d27605a2b525d543c46254e3c5625523926354e3b4625493c56344e3b362d433b36244e3b5729472b56454e392635582b4721483c235d4d3b5631553b26345d3d2729413b472d413c4631453b4659413a372d45294631453c562c5d392635463837354c3d5c223941385731493b56585d3c262549393655453b47302a2c232c512c2324502d2641543d27605a2b525d543c46254e3c5625523926354e3b4625493c56344e3b362d433b36244e3b5729472b56454e392635582b4721483c235d4d3b5631553b26345d3d2729413b472d413c4631453b4659413a372d45294631453c562c5d392635463837354c3d5c223941385731493b56585d3c4635543b5735523c262549393655453b4731413d37314f5c224360512c5360502e3331483d2731502e425c4f3d2729413b472d413c4631453b4659413a372d452b465543385655412b465d5239525d493b4631453e5c2259503a27605f3b365d443d3651452f37315238365953383729443936594e383645533932394439372d432f363145394625553b27304638362d543a365d4e2f3721413a36354d393659545c224360512d4360502c232d333454502a2c2324582c2360502d4360502c2360502c6048502c5330502c2324543d26354d3c2651413d26353f3856253f3947282ab89218908f360ed8"><DIV ALIGN=left><INPUT TYPE=IMAGE NAME=CB BORDER=0 SRC="http://transardennaise.mccma.org/img/payment_logo/CB.gif"><IMG SRC="http://transardennaise.mccma.org/img/payment_logo/INTERVAL.gif"><INPUT TYPE=IMAGE NAME=VISA BORDER=0 SRC="http://transardennaise.mccma.org/img/payment_logo/VISA.gif"><IMG SRC="http://transardennaise.mccma.org/img/payment_logo/INTERVAL.gif"><INPUT TYPE=IMAGE NAME=MASTERCARD BORDER=0 SRC="http://transardennaise.mccma.org/img/payment_logo/MASTERCARD.gif"><br><br></DIV></FORM>';
        // return $process->getOutput();
    }
}