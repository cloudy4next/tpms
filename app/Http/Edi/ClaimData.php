<?php
namespace App\Http\Edi;
include "ChargeData.php";

class ClaimData {

    // NM1-85 - Billing Provider Information

    // PRV-03 - Billing Provider Taxonomy Code
    public $BillPrvTaxonomyCode;
    // NM1-02 - Billing Provider Entity (1 For Person, 2 For Non-Person(Practice) Entity)
    public $BillPrvEntityType;
    // NM1-03 - Billing Provider Last Or Organization Name
    public $BillPrvOrgName;
    // NM1-04 - Billing Provider First Name (Required When Billing Entity is 1 - Individual Doctor)
    public $BillPrvFirstName;
    // NM1-05 - Billing Provider Middle Initial (Required When Billing Entity is 1 - Individual Doctor)
    public $BillPrvMI;
    // NM1-09 - Billing Provider NPI
    public $BillPrvNPI;

    // N3 - Billing Provider Address1
    public $BillPrvAddress1;
    public $BillPrvAddressLine2;


    // N4 - Billing Provider City
    public $BillPrvCity;
    // N4 - Billing Provider State
    public $BillPrvState;
    // N4 - BIlling Provider Zip Code
    public $BillPrvZipCode;

    // REF-EI - Billing Provider Tax ID
    public $BillPrvTaxID;
    // REF-SY - Billing Provider SSN
    public $BillPrvSSN;

    // REF- Billing Provider Secondary ID Other Than NPI
    public $BillPrvSecondaryID;

    // PER-02 - Billing Provider Contact Name
    public $BillPrvContactName;
    // PER-04 - Billing Provider Telephone
    public $BillPrvTelephone;
    // PER-06 - Billing Provider Fax
    public $BillPrvFax;
    // PER-06 - Billing Provider Email
    public $BillPrvEmail;

    // NM1-87 - Billing Provider Pay to Address (Address Where Payer will Drop Provider's Checks like PO Box Address)
    public $BillPrvPayToAddr;
    public $BillPrvPayToAddrLine2;

    // NM1-87 - Billing Provider Pay to City
    public $BillPrvPayToCity;
    // NM1-87 - Billing Provider Pay to State
    public $BillPrvPayToState;
    // NM1-87 - Billing Provider Pay to Zip
    public $BillPrvPayToZip;


    // SBR-01 - Claim Type (P for Primary Claim, S for Secondary Claim)
    public $ClaimType;
    // SBR-02 - Patient Relation to Insured\Subscriber (true - if patient is same as insured, false - if patient and insured are different)
    public $IsSelfSubscribed;
    // SBR-03 - Subscriber Group\Policy Number
    public $SbrGroupNumber;
    // SBR-04 - Subscriber Group Name
    public $SbrGroupName;
    // SBR-05 - Subscriber Insured Type Code (Required only in Secondary Medicare Claims)
    public $SbrMedicareSecType;

    // SBR-09 - Payer Tye (Use following Values)
    // For Medicare Part A          -   MA
    // For Medicare Part B          -   MB
    // For Blue Cross/Blue Sheild   -   BS
    // For Medicaid                 -   MC
    // For Champus                  -   CH
    // For Commercial Insurances    -   CI
    // For Veteran Administration   -   VA
    // For Other Federal Program    -   OF
    // For Health Maintenance Org   -   HM
    // For Worker Compensation      -   WC
    public $PayerType;

    // NM1-IL - Subscriber\Insured Information
    // NM1-03 - Subscriber\Insured Last Name
    public $SBRLastName;
    // NM1-04 - Subscriber\Insured First Name
    public $SBRFirstName;
    // NM1-05 - Subscriber\Insured Middle Initial
    public $SBRMiddleInitial;
    // NM1-09 - Subscriber\Insured ID
    public $SBRID;

    // N3 - Subscriber\Insured Address
    public $SBRAddress;
    public $SBRAddressLine2;
    // N4 - Subscriber\Insured City
    public $SBRCity;
    // N4 - Subscriber\Insured State
    public $SBRState;
    // N4 - Subscriber\Insured Zip
    public $SBRZipCode;

    // DMG - Subscriber Date of Birth (Format: YYYYMMDD)
    public $SBRDob;
    // DMG - Subscriber Gender (M - For Male, F - For Female, U - For Unknown)
    public $SBRGender;

    // REF - Subscriber\Insured SSN
    public $SBRSSN;

    // NM1-PR - Payer Information
    // NM1-03 - Payer Organization Name
    public $PayerName;
    // NM1-09 - Payer ID (From Payer List)
    public $PayerID;

    // N3 - Payer Address
    public $PayerAddress;
    public $PayerAddressLine2;
    // N4 - Payer City
    public $PayerCity;
    // N4 - Payer State
    public $PayerState;
    // N4 - Payer Zip Code
    public $PayerZipCode;

    // PAT-01 - Patient Relation Ship With Subscriber\Insured. (Use Above Numberical Values)
    // Self             -   18
    // Child            -   19
    // Spouse           -   01
    // Unknown/Other    -   21
    public $PatientRelationShip;

    // NM1-QC - Patient Information
    // NM1-03 - Patient Last Name
    public $PATLastName;
    // NM1-04 - Patient First Name
    public $PATFirstName;
    // NM1-05 - Patient Middle Initial
    public $PATMiddleInitial;


    // N4 - Patient Address
    public $PATAddress;
    public $PATAddressLine2;
    // N3 - Patient City
    public $PATCity;
    // N3 - Patient State
    public $PATState;
    // N3 - Patient Zip
    public $PATZipCode;

    // DMG - Patient Date of Birth (Format: YYYYMMDD)
    public $PATDob;
    // DMG - Patient Gender (M - For Male, F - For Female, U - For Unknown)
    public $PATGender;

    // CLM - Claim Information

    // CLM-01 - Patient Control Number
    public $PatientControlNumber;
    // CLM-02 - Total Claim Amount
    public $ClaimAmount;
    // Place Of Service Code
    public $POSCode;
    // Claim Frequecy Code (1 - For New Claim, 7 For Replacement Claim)
    public $ClaimFreqCode = '1';
    public $ProvSignature;
    public $PrvPayerAssignment;
    public $BenefitsAssignment;
    public $ReleaseOfInfo;

    // Accident Type, Use Following Values
    // Auto Accident    -   AA
    // Employment       -   EM
    // Other Accident   -   OA
    public $AccidentType;

    // Accident State
    public $AccidentState;

    // Claim Dates
    // DTP - Current Illness Date
    public $CurrentIllnessDate;
    // DTP - Initial Treatment Date
    public $InitialTreatmentDate;
    // DTP - Last Seen Date
    public $LastSeenDate;
    // DTP - Acute Manifestation Date
    public $AcuteManifestationDate;
    // DTP - Accident Date
    public $AccidentDate;
    // DTP - Last Menstrual Period Date
    public $LMPDate;
    // DTP - Last Xray Date
    public $XrayDate;
    // DTP - Initial Disability Period Start Date
    public $DisabilityStartDate;
    // DTP - Initial Disability Period End Date
    public $DisabilityEndDate;
    // DTP - Last Worked Date
    public $LastWorkedDate;
    // DTP - Admission Date
    public $AdmissionDate;
    // DTP - Discharge Date
    public $DischargeDate;

    //PWK   CLAIM SUPPLEMENTAL INFORMATION
    //CN1   CONTRACT INFORMATION
    //AMT   PATIENT AMOUND PAID

    public $MedicalRecordNumber;

    //client authrization number
    public $PriorAuthNumber;

    // REF - Payer Claim Control Number
    public $PayerClaimCntrlNum;
    // REF - CLIA Number
    public $CliaNumber;

    public $ClaimNotes;

    //CR1
    //CR2
    //CRC

    // ICD - Diagnosis Code 1
    public $ICD1Code;
    // ICD - Diagnosis Code 2
    public $ICD2Code;
    // ICD - Diagnosis Code 3
    public $ICD3Code;
    // ICD - Diagnosis Code 4
    public $ICD4Code;
    // ICD - Diagnosis Code 5
    public $ICD5Code;
    // ICD - Diagnosis Code 6
    public $ICD6Code;
    // ICD - Diagnosis Code 7
    public $ICD7Code;
    // ICD - Diagnosis Code 8
    public $ICD8Code;
    // ICD - Diagnosis Code 9
    public $ICD9Code;
    // ICD - Diagnosis Code 10
    public $ICD10Code;
    // ICD - Diagnosis Code 11
    public $ICD11Code;
    // ICD - Diagnosis Code 12
    public $ICD12Code;

    //HI    Anesthesia related procedure
    //HI    Condition Information
    //HCP   Claim Pricing Information

    // NM1-DN - Refering Provider Information
    // NM1-03 - Refering Provider Last Name
    public $RefPrvLastName;
    // NM1-04 - Refering Provider First Name
    public $RefPrvFirstName;
    // NM1-05 - Refering Provider Middle Initial
    public $RefPrvMI;
    // NM1-09 - Refering Provider NPI
    public $RefPrvNPI;

    // NM1-82 - Rendering Provider
    // NM1-03 - Rendering Provider Last Name
    public $RendPrvLastName;
    // NM1-04 - Rendering Provider First Name
    public $RendPrvFirstName;
    // NM1-05 - Rendering Provider Middle Initial
    public $RendPrvMI;
    // NM1-09 - Rendering Provider NPI
    public $RendPrvNPI;
    // NM1-09 - Rendering Provider Taxonomy
    public $RendPrvTaxonomy;

    // NM1-09 - Rendering Provider Secondary ID Other Than NPI
    public $RendPrvSecondaryID;

    // NM1-77 - Service Location Information
    // NM1-03 - Location Organization Name
    public $LocationOrgName;
    // NM1-09 - Location Provider NPI
    public $LocationNPI;

    // N4 - Location Address
    public $LocationAddress;
    public $LocationAddressLine2;
    // N3 - Location City
    public $LocationCity;
    // N3 - Location State
    public $LocationState;
    // N3 - Location Zip
    public $LocationZip;

    // NM1-DQ - Supervising Provider Information
    // NM1-04 - Supervising Provider Last Name
    public $SuperPrvLastName;
    // NM1-04 - Supervising Provider First Name
    public $SuperPrvFirstName;
    // NM1-04 - Supervising Provider Middle Initial
    public $SuperPrvMI;
    // NM1-04 - Supervising Provider NPI
    public $SuperPrvNPI;

    //NM1   Ambulance pick-up location
    //NM1   AMBULANCE DROP-OFF LOCATION

    // Other Subscriber Relation Ship With Patient
    public $OtherSBRPatRelationV;
    // Other Subscriber Group Number
    public $OtherSBRGroupNumber;
    // Other Subscriber Group Name
    public $OtherSBRGroupName;
    // Other Payer Type
    public $OtherPayerTypeValue;

    // Primary Paid Amount
    public $PrimaryPaidAmt;
    // Other Subscriber Last Name
    public $OtherSBRLastName;
    // Other Subscriber First Name
    public $OtherSBRFirstName;
    // Other Subscriber Middle Initial
    public $OtherSBRMI;
    // Other Subscriber ID
    public $OtherSBRId;

    // Other Subscriber Address
    public $OtherSBRAddress;
    public $OtherSBRAddressLine2;
    // Other Subscriber City
    public $OtherSBRCity;
    // Other Subscriber State
    public $OtherSBRState;
    // Other Subscriber Zip Code
    public $OtherSBRZipCode;

    // Other Payer Name
    public $OtherPayerName;
    // Other Payer ID
    public $OtherPayerID;

    // Other Payer Address
    public $OtherPayerAddress;
    public $OtherPayerAddressLine2;
    // Other Payer City
    public $OtherPayerCity;
    // Other Payer State
    public $OtherPayerState;
    // Other Payer Zip Code
    public $OtherPayerZipCode;

    // List Of Charges Data
    public $ListOfChargesData = array();

    // Submitted Date
    public $ProcessedDate;
    // Processed (ture\false)
    public $Processed;


    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}

