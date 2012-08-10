<?php

namespace Isics\SipsBundle\Model;

/**
 * Données renvoyées par le binaire response
 */
class Response
{
    const
        RESPONSE_CODE_APPROVED                = '00',
        RESPONSE_CODE_AUTHORIZATION_REQUESTED = '02',
        RESPONSE_CODE_INVALID_MERCHANT_ID     = '03',
        RESPONSE_CODE_NOT_APPROVED            = '05',
        RESPONSE_CODE_INVALID_TRANSACTION     = '12',
        RESPONSE_CODE_CANCELED                = '17',
        RESPONSE_CODE_FORMAT_ERROR            = '30',
        RESPONSE_CODE_DECEPTION               = '34',
        RESPONSE_CODE_TO_MANY_ATTEMPTS        = '75',
        RESPONSE_CODE_UNAVAILABLE_SERVICE     = '90';
        
    public $code;
    public $error;
    public $merchantId;
    public $merchantCountry;
    public $amount;
    public $transactionId;
    public $paymentMeans;
    public $transmissionDate;
    public $paymentTime;
    public $paymentDate;
    public $responseCode;
    public $paymentCertificate;
    public $authorisationId;
    public $currencyCode;
    public $cardNumber;
    public $cvvFlag;
    public $cvvResponseCode;
    public $bankResponseCode;
    public $complementaryCode;
    public $complementaryInfo;
    public $returnContext;
    public $caddie;
    public $receiptComplement;
    public $merchantLanguage;
    public $language;
    public $customerId;
    public $orderId;
    public $customerEmail;
    public $customerIpAddress;
    public $captureDay;
    public $captureMode;
    public $data;
    public $orderValidity;
    public $transactionCondition;
    public $statementReference;
    public $cardValidity;
    public $scoreValue;
    public $scoreColor;
    public $scoreInfo;
    public $scoreThreshold;
    public $scoreProfile;
    
    
    
    /**
     * Construit lobjet
     *
     * @param array $data  Données issues du binaire response
     */
    public function __construct(array $data)
    {
        $this->code                 = $data[1];
        $this->error                = $data[2];
        $this->merchantId           = $data[3];
        $this->merchantCountry      = $data[4];
        $this->amount               = $data[5];
        $this->transactionId        = $data[6];
        $this->paymentMeans         = $data[7];
        $this->transmissionDate     = $data[8];
        $this->paymentTime          = $data[9];
        $this->paymentDate          = $data[10];
        $this->responseCode         = $data[11];
        $this->paymentCertificate   = $data[12];
        $this->authorisationId      = $data[13];
        $this->currencyCode         = $data[14];
        $this->cardNumber           = $data[15];
        $this->cvvFlag              = $data[16];
        $this->cvvResponseCode      = $data[17];
        $this->bankResponseCode     = $data[18];
        $this->complementaryCode    = $data[19];
        $this->complementaryInfo    = $data[20];
        $this->returnContext        = $data[21];
        $this->caddie               = $data[22];
        $this->receiptComplement    = $data[23];
        $this->merchantLanguage     = $data[24];
        $this->language             = $data[25];
        $this->customerId           = $data[26];
        $this->orderId              = $data[27];
        $this->customerEmail        = $data[28];
        $this->customerIpAddress    = $data[29];
        $this->captureDay           = $data[30];
        $this->captureMode          = $data[31];
        $this->data                 = $data[32];
        $this->orderValidity        = $data[33];
        $this->transactionCondition = $data[34];
        $this->statementReference   = $data[35];
        $this->cardValidity         = $data[36];
        $this->scoreValue           = $data[37];
        $this->scoreColor           = $data[38];
        $this->scoreInfo            = $data[39];
        $this->scoreThreshold       = $data[40];
        $this->scoreProfile         = $data[41];
    }
    
    /**
     * Retourne vrai si la transaction a été approuvée
     *
     * @return boolean
     */
    public function isTransactionApproved()
    {
        return $this->responseCode === self::RESPONSE_CODE_APPROVED;
    }
    
    /**
     * Retourne vrai si la réponse a été générée avec succès
     *
     * @return boolean
     */
    public function isProcessedSuccessfully()
    {
        return $this->code == 0;
    }
}