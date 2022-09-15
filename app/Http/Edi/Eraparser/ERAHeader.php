<?php

namespace App\Http\Edi\Eraparser;
/**
 * @file
 * This class contains the data fields of header level info like Check#, Check Amount, Payer,
 * Provider all submitted amount etc used in 835 File.
 */
class ERAHeader
{

    public $ISA06SenderID;
    public $ISA08ReceiverID;
    public $ISADateTime;
    public $ISAControlNumber;
    public $GS02SenderID;
    public $GS03ReceiverID;
    public $GSControlNumber;
    public $STControlNumber;
    public $VersionNumber;

    public $TransactionCode;
    public $CheckAmount;
    public $CreditDebitFlag;
    public $PaymentMethod;
    public $PaymentFormat;
    public $CheckDate;
    public $CheckNumber;
    public $PayerTrn;
    public $ProductionDate;

    public $PayerName;
    public $PayerID;
    public $PayerAddress;
    public $PayerCity;
    public $PayerState;
    public $PayerZip;
    public $REF2U;
    public $REFEO;
    public $PayerContactName;
    public $PayerTelephone;
    public $PayerBillingContactName;
    public $PayerBillingEmail;
    public $PayerBillingTelephone;
    public $PayerWebsite;

    public $PayeeName;
    public $PayeeNPI;
    public $PayeeAddress;
    public $PayeeCity;
    public $PayeeState;
    public $PayeeZip;
    public $PayeeTaxID;

    public $ProviderID;
    public $FacilityCode;
    public $FiscalYear;
    public $ClaimCount;
    public $TotalClaimAmount;

    //Visit Payment Array
    public $ERAVisitPayments = array();


    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}

