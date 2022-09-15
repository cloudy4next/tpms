<?php

namespace App\Http\Edi\Eraparser;
/**
 * @file
 * This class contains the data fields of charge level payment like submitted amount, paid Amount,
 * deductible, co-insurance, allowed amount etc used in 835 File.
 */
class ERAChargePayment
{

    public $CPTCode;
    public $Modifier1;
    public $Modifier2;
    public $Modifier3;
    public $Modifier4;
    public $CPTDescription;
    public $SubmittedAmt;
    public $PaidAmt;
    public $RevenueCode;
    public $UnitsPaid;
    public $ServiceDateFrom;
    public $ServiceDateTo;

    public $DeductableAmt;
    public $CoInsuranceAmt;
    public $CopayAmt;
    public $WriteOffAmt;

    public $OtherAdjustmentCode1;
    public $OtherAdjustmentAmt1;
    public $OtherWriteOffCode2;
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

    public $ChargeControlNumber;
    public $LocationNumber;
    public $AllowedAmount;

    public $RemarkCode1;
    public $RemarkCode2;
    public $RemarkCode3;
    public $RemarkCode4;
    public $RemarkCode5;
    public $RemarkCode6;
    public $RemarkCode7;
    public $RemarkCode8;
    public $RemarkCode9;
    public $RemarkCode10;

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
