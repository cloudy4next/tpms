<?php

namespace App\Http\Edi\Eraparser;
/**
 * @file
 * This class contains the data fields of visit level payment like submitted amount, paid Amount,
 * patient resposibility, payer claim control number etc used in 835 File.
 */
class ERAVisitPayment
{

    public $PatientControlNumber;
    public $ClaimProcessedAs;
    public $SubmittedAmt;
    public $PaidAmt;
    public $PatResponsibilityAmt;
    public $PayerTypeValue;
    public $PayerControlNumber;
    public $ClaimFilingIndicator;
    public $FacilityCode;
    public $ClaimFrequencyCode;
    //CAS
    public $PatientLastName;
    public $PatientFirstName;
    public $PatientMiddleInitial;
    public $SubscriberID;
    public $SubscriberHIC;
    public $SubscriberLastName;
    public $SubscirberFirstName;
    public $SubscriberMI;

    public $RendPrvEntity;
    public $RendPrvLastName;
    public $RendPrvFirstName;
    public $RendPrvMI;
    public $RendPrvNPI;

    public $CrossOverPayerName;
    public $CrossOverPayerID;

    public $SubscriberGroupNum;
    public $SubscriberSSN;
    public $ClaimReceivedDate;
    public $ClaimStatementFrom;
    public $ClaimStatementTo;
    public $ClaimContactNumber;
    public $ClaimTelephone;
    public $ClaimCoverageAmt;
    public $ClaimDiscountAmt;
    public $ClaimInterestAmt;


    public $DeductableAmt;
    public $CoInsuranceAmt;
    public $CopayAmt;
    public $WriteOffAmt;

    public $OtherAdjustmentCode1;
    public $OtherAdjustmentAmt1;
    public $OtherAdjustmentCode2;
    public $OtherAdjustmentAmt2;
    public $OtherAdjustmentCode3;
    public $OtherAdjustmentAmt3;
    public $OtherAdjustmentCode4;
    public $OtherAdjustmentAmt4;
    public $OtherAdjustmentCode5;
    public $OtherAdjustmentAmt5;

    public $OtherAdjustmentAmt;
    public $CorrectionReversalAmt;
    public $PayerReductionAmt;
    public $GroupOrPolicyNum;

    // Array for charge payments
    public $ERAChargePayments = array();

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

