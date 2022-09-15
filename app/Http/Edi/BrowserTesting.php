<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<?php
   
   
   
   class ClaimHeader {
	
	// ISA(EDI Interchange) Values - Assigned By Clearing House
	
	// ISA01 - Authorization Information Qualifies
	public $ISA01AuthQual = '00';
	// ISA02 - Authorization Information
	public $ISA02AuthInfo;
	// ISA03 - Security Information Qualifier
	public $ISA03SecQual = '00';
	// ISA04 - Security Information
	public $ISA04SecInfo;
	// ISA05 - Interchange Sender ID Qualifier
	public $ISA05SenderQual = 'ZZ';
	// ISA06 - Interchange Sender ID 
	public $ISA06SenderID;
	// ISA07 - Interchange Receiver ID Qualifier
	public $ISA07ReceiverQual = 'ZZ';
	// ISA08 - Interchange Receiver ID
	public $ISA08ReceiverID;
	// ISA13 - Interchange Control Number (Must be 9 Digits Unique Number)
	public $ISA13CntrlNumber;
	// ISA15 - Usage Indicator (T - For Test Transaction, P - For Production Transaction)
	public $ISA15UsageIndi;

	// GS02 - Application Sender’s Code 
	public $GS02SenderID;
	// GS03 - Application Receiver’s Code 
	public $GS03ReceiverID;

	
	// NM1-41-02 - Submitter Entity (1 For Person, 2 For Non-Person(Organization) Entity
	public $SubmitterEntity = '2';
	// NM1-41-03 - Submitter Last Or Organization Name
	public $SubmitterOrgName;
	// NM1-41-04 - Submitter First Name (Required when SubmitterEntity is 1 (Person)
	public $SubmitterFirstName;
	// NM1-41-08 - Submitter ID Qualifier
	public $SubmitterQual = '46';
	// NM1-41-09 - Submitter Identifier
	public $SubmitterID;

	// PER-02 - Submitter Contact Name
	public $SubmitterContactName;
	// PER-04 - Submitter Communication Number
	public $SubmitterTelephone;
	// PER-06 - Submitter Fax 
	public $SubmitterFax;
	// PER-06 - Submitter Email
	public $SubmitterEmail;

	// NM1-40-03 - Receiver Last Or Organization Name
	public $ReceiverOrgName;
	// NM1-40-08 - Receiver ID Qualifier
	public $RecieverQual = '46';
	// NM1-41-09 - Receiver Identifier
	public $ReceiverID;

	// Relax NPI Validation - (True\False) - If False NPI Required Validations will be Relaxed
	public $RelaxNpiValidation;
	
	// List Of Claims Data
	public $ListOfClaimsData = array();
	
	
	// Function - Get Value For Particular Feild
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
	
	// Function - Set Value For Particular Feild
	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}
}
    
    
    
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

    
    
    class ChargeData {
    	
    	// SV1 - CPT\HCPCS Code
    	public $CptCode;
    	// SV1 - Modifier 1
    	public $Modifier1;
    	// SV1 - Modifier 2
    	public $Modifier2;
    	// SV1 - Modifier 3
    	public $Modifier3;
    	// SV1 - Modifier 4
    	public $Modifier4;
    	// SV1 - Line Item Service Description
    	public $LIDescription;
    
    	// SV1 - Charge Amount
    	public $ChargeAmount;
    	// SV1 - Units
    	public $Units;
    	// SV1 - Minutes
    	public $Minutes;
    	// SV1 - Place Of Service (Allowed when Reported POS at the Claim Level is different for the particular CPT)
    	public $POS;
    	// SV1 - ICD Pointer 1 
    	public $Pointer1;
    	// SV1 - ICD Pointer 2
    	public $Pointer2;
    	// SV1 - ICD Pointer 3
    	public $Pointer3;
    	// SV1 - ICD Pointer 4
    	public $Pointer4;
    
    	public $IsEmergency;
       
        // Date Of Service From Date
    	public $DateofServiceFrom;
    	// Date Of Service To Date
    	public $DateOfServiceTo;
    	// Line Item Control Number
    	public $LineItemControlNum;
    	
    	public $ServiceLineNotes;
    	
    	// LIN - Drug Number
    	public $DrugNumber;
    	// CTP - Drug Count
    	public $DrugCount;
    	// CTP - Drug Unit
    	public $DrugUnit;
    
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
       
        // Primary Paid Amount
    	public $PrimaryPaidAmt;
    	// Primary CPT\HCPCS Code
    	public $PrimaryCPT;
    	// Primary Modifier 1
    	public $PrimaryMod1;
    	// Primary Modifier 2
    	public $PrimaryMod2;
    	// Primary Modifier 3
    	public $PrimaryMod3;
    	// Primary Modifier 4
    	public $PrimaryMod4;
    	// Primary Paid Units
    	public $PrimaryUnits;
    	// Primary WriteOff AMount
    	public $PrimaryWriteOffAmt;
    	// Primary Other WriteOff Amount
    	public $PrimaryOthWriteOffAmt;
    	// Primary Co Insurance
    	public $PrimaryCoIns;
    	// Primary Deductible
    	public $PrimaryDeductable;
    	// Primary Adjudicated Quantity
    	public $PrimaryAdjQuantity;
    	// Primary Paid Amount
    	public $PrimaryPaidDate;
    	
    	// Processed Date
    	public $ProcessedDate;
    	// Processed(true\false)
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

    
    class ClaimOutput
    {
    	public $Transaction837;
    	public $ErrorMessage;
    	public $ProcessedClaims = 0;
    
    	// Array of ClaimResult Object
    	public $ListOfClaims = array();
    }
    
    class ClaimResult
    {
    	public $ValidationMsg;
    	public $PatientControlNumber;
    
    	public $Processed;
    	public $ProcessedDate;
    }
    
    class ClaimGenerator {

	private $hlCounter = 0;
	private $hlSbrCounter = 0;
	private $hlBPrvCounter = 0;
	private $lxCounter = 0;
	
	private $elementsCount = 0;
	private $ProcessedClaims = 0;
	
	private $E = '*';
	private $C = ':';
	private $S = '~';
	private $R = '^';
		
	function Generate837Transaction($Header, $Claims, $EDIFilePath) {
		
		$output = new ClaimOutput();
		
		if (is_null($Header) or is_null($Claims) or sizeof($Claims) == 0 )
		{
			$output->ErrorMessage = 'Header, Claims or Charges can not be Empty.';
			return output;
		}
		else if ($Header->ISA13CntrlNumber == '')
		{
			$output->ErrorMessage = "ISA13 Control Number can not be Empty.";
			return output;
		}
		else if ($Header->ISA15UsageIndi == '')
		{
			$output->ErrorMessage = "ISA15 Usage Indicator can not be Empty.";
			return output;
		}
				
		$ClaimSTR  = '';
		$ClaimSTR .= $this->GenerateHeader($Header);

		foreach ($Claims as $CLM) 
		{
			
			$msg = $this->Validate($Header, $CLM);
			if ($msg!= '')
			{
				$CLM->ValidationMsg = $msg;
				
				$clmResult = new ClaimResult(); 
                $clmResult->PatientControlNumber = $CLM->PatientControlNumber;
                $clmResult->Processed = false;
                $clmResult->ValidationMsg = $msg;
				array_push($output->ListOfClaims, $clmResult);
				
				continue;
			}
			

			$ClaimSTR .= $this->GenerateBillingProvider($CLM);

			$ClaimSTR .= $this->GenerateClaim($CLM);

			$this->lxCounter = 0;
			foreach ($CLM->ListOfChargesData as $CH) 
			{
				$ClaimSTR .= $this->GenerateCharge($CH, $CLM);
			}
			
			$clmResult = new ClaimResult(); 
			$clmResult->PatientControlNumber = $CLM->PatientControlNumber;
			$clmResult->Processed = $CLM->Processed;
			$clmResult->ProcessedDate = $CLM->ProcessedDate;
			array_push($output->ListOfClaims, $clmResult);
				
		}

		$this->elementsCount = substr_count($ClaimSTR, $this->S) - 1;
		$ClaimSTR .= $this->GenerateTrailer($Header);
		
		
		if ($this->ProcessedClaims > 0)
		{
			$output->ProcessedClaims = $this->ProcessedClaims;
			$output->Transaction837 = $ClaimSTR;

			// Write the contents back to the file
			if ($EDIFilePath != '') {
				file_put_contents($EDIFilePath, $ClaimSTR);
			}
		}
				
		return $output;
	}
	
	function GenerateHeader($header) {
	
		$E = $this->E;
		$C = $this->C;
		$S = $this->S;
		$R = $this->R;
		
		$yyMMdd = date('ymd');
		$yyyyMMdd = date('Ymd');
		$hhmm = date('Hi', time());
		
		if($header->ISA01AuthQual == '') $header->ISA01AuthQual = '00';
		$header->ISA02AuthInfo = str_pad( $header->ISA02AuthInfo, 10, ' ', STR_PAD_RIGHT);
		if($header->ISA03SecQual == '') $header->ISA01AuthQual = '00';
		$header->ISA04SecInfo = str_pad( $header->ISA04SecInfo, 10, ' ', STR_PAD_RIGHT);
		if($header->ISA05SenderQual == '') $header->ISA05SenderQual = 'ZZ';
		$header->ISA06SenderID = str_pad( $header->ISA06SenderID, 15, ' ', STR_PAD_RIGHT);
		if($header->ISA07ReceiverQual == '') $header->ISA07ReceiverQual = 'ZZ';
		$header->ISA08ReceiverID = str_pad( $header->ISA08ReceiverID, 15, ' ', STR_PAD_RIGHT);
		
		$headerSTR = '';
		
		$headerSTR  = 'ISA'. $E. $header->ISA01AuthQual. $E. $header->ISA02AuthInfo. $E.
						$header->ISA03SecQual. $E. $header->ISA04SecInfo. $E. 
						$header->ISA05SenderQual. $E. $header->ISA06SenderID. $E. 
						$header->ISA07ReceiverQual. $E. $header->ISA08ReceiverID. $E. 
						$yyMMdd. $E. $hhmm. $E. $R. $E. '00501'. $E. $header->ISA13CntrlNumber. $E.
						'1'. $E. $header->ISA15UsageIndi. $E. $C. $S;
					
		$headerSTR .= 'GS'. $E. 'HC'. $E. $header->GS02SenderID. $E. 
						$header->GS03ReceiverID. $E. $yyyyMMdd. $E. $hhmm. $E. 
						$header->ISA13CntrlNumber. $E. 'X'. $E. '005010X222A1'. $S;
						
		$headerSTR .= 'ST' . $E . '837' . $E . '0001' . $E . '005010X222A1' . $S;
						
						
		$headerSTR .= 'BHT' . $E . '0019' . $E . '00' . $E . $header->ISA13CntrlNumber . $E . $yyyyMMdd . $E . $hhmm . $E . 'CH' . $S;
		$headerSTR .= 'NM1' . $E . '41' . $E . $header->SubmitterEntity . $E . $header->SubmitterOrgName . $E . $header->SubmitterFirstName . $E . $E . $E . $E . $header->SubmitterQual . $E . $header->SubmitterID . $S;
		$headerSTR .= 'PER' . $E . 'IC' . $E . $header->SubmitterContactName . $E . 'TE' . $E . $header->SubmitterTelephone;
		if ($header->SubmitterEmail != '')
			$headerSTR .= $E . 'EM' . $E . $header->SubmitterEmail;
		$headerSTR .= $S;

		$headerSTR .= 'NM1' . $E . '40' . $E . '2' . $E . $header->ReceiverOrgName . $E . $E . $E . $E . $E . $header->RecieverQual . $E . $header->ReceiverID . $S;
	   
		return $headerSTR;
	}
	
	function GenerateBillingProvider($CLM){
	
		$bPrvSTR = '';
		$this->hlCounter += 1; $this->hlBPrvCounter = $this->hlCounter;
	
		$E = $this->E;
		$C = $this->C;
		$S = $this->S;
		$R = $this->R;
		
		$bPrvSTR .= 'HL' . $E . $this->hlCounter .  $E . $E . '20' . $E . '1' . $S;
		if ($CLM->BillPrvTaxonomyCode != '')
			$bPrvSTR .= 'PRV' . $E . 'BI' . $E . 'PXC' . $E . $CLM->BillPrvTaxonomyCode . $S;

		if ($CLM->BillPrvEntityType == '') {
			if ($CLM->BillPrvFirstName == '') $CLM->BillPrvEntityType = '2';
			else $CLM->BillPrvEntityType = '1';
		}
		$bPrvSTR .= 'NM1' . $E . '85' . $E . $CLM->BillPrvEntityType . $E . $CLM->BillPrvOrgName;

		if ($CLM->BillPrvNPI != '')
			$bPrvSTR .= $E . $CLM->BillPrvFirstName . $E . $CLM->BillPrvMI . $E . $E . $E . 'XX' . $E . $CLM->BillPrvNPI;
		else if ($CLM->BillPrvFirstName != '')
			$bPrvSTR .= $E . $CLM->BillPrvFirstName;

		$bPrvSTR .= $S;

		$bPrvSTR .= 'N3' . $E . $CLM->BillPrvAddress1 . $S;
		$bPrvSTR .= 'N4' . $E . $CLM->BillPrvCity . $E . $CLM->BillPrvState . $E . $CLM->BillPrvZipCode . $S;
		if ($CLM->BillPrvTaxID != '')
			$bPrvSTR .= 'REF' . $E . 'EI' . $E . $CLM->BillPrvTaxID . $S;
		else if ($CLM->BillPrvSSN != '')
			$bPrvSTR .= 'REF' . $E . 'SY' . $E . $CLM->BillPrvSSN . $S;
		   
		if ($CLM->BillPrvTelephone!= '')
			$bPrvSTR .= 'PER' . $E . 'IC' . $E . $CLM->BillPrvContactName . $E . 'TE' . $E . $CLM->BillPrvTelephone . $S;

		if ($CLM->BillPrvPayToAddr!= '')
		{
			$bPrvSTR .= 'NM1' . $E . '87' . $E . '2' . $S;
			$bPrvSTR .= 'N3' . $E . $CLM->BillPrvAddress1 . $S;
			$bPrvSTR .= 'N4' . $E . $CLM->BillPrvPayToCity . $E . $CLM->BillPrvPayToState . $E . $CLM->BillPrvPayToZip . $S;
		}
	   
		return $bPrvSTR;
	}
	
	function GenerateClaim($CLM) {
	
		$E = $this->E;
		$C = $this->C;
		$S = $this->S;
		$R = $this->R;
		
		$claimSTR = '';
		$lxCounter = 0;
		
		$this->hlCounter += 1; $this->hlSbrCounter = $this->hlCounter;
		$hl04 = '';
		if ($CLM->PatientRelationShip == '18')
			$hl04 = '0';
		else $hl04 = '1';
			
		$claimSTR .= 'HL' . $E . $this->hlCounter . $E . $this->hlBPrvCounter . $E . '22' . $E . $hl04 . $S;
		$claimSTR .= 'SBR' . $E . $CLM->ClaimType . $E . $CLM->PatientRelationShip . $E . $CLM->SbrGroupNumber . $E . $CLM->SbrGroupName
					   . $E . $CLM->SbrMedicareSecTypeV . $E . $E . $E . $E . $CLM->PayerType . $S;

		$claimSTR .= 'NM1' . $E . 'IL' . $E . '1' . $E . $CLM->SBRLastName . $E . $CLM->SBRFirstName . $E . $CLM->SBRMiddleInitial . $E . $E . $E . 'MI' . $E . $CLM->SBRID . $S;
		$claimSTR .= 'N3' . $E . $CLM->SBRAddress . $S;
		$claimSTR .= 'N4' . $E . $CLM->SBRCity . $E . $CLM->SBRState . $E . $CLM->SBRZipCode . $S;

		if ($CLM->SBRDob != '')
			$claimSTR .= 'DMG' . $E .  'D8' . $E . $CLM->SBRDob . $E . $CLM->SBRGender . $S;
		if ($CLM->SBRSSN!= '')
			$claimSTR .= 'REF' . $E . 'SY' . $E . $CLM->SBRSSN . $S;

		$claimSTR .= 'NM1' . $E . 'PR' . $E . '2' . $E . $CLM->PayerName . $E . $E . $E . $E . $E . 'PI' . $E . $CLM->PayerID . $S;
		if ($CLM->PayerAddress!= '')
		{
			$claimSTR .= 'N3' . $E . $CLM->PayerAddress . $S;
			$claimSTR .= 'N4' . $E . $CLM->PayerCity . $E . $CLM->PayerState . $E . $CLM->PayerZipCode . $S;
		}
		if ($CLM->BillPrvSecondaryID!= '')
			$claimSTR .= 'REF' . $E . 'G2' . $E . $CLM->BillPrvSecondaryID . $S;

		if ($CLM->PatientRelationShip != '18')
		{
			$this->hlCounter += 1;
			$claimSTR .= 'HL' . $E . $this->hlCounter . $E . $this->hlSbrCounter . $E . '23' . $E . '0' . $S;
			$claimSTR .= 'PAT' . $E . '19' . $S;         
			$claimSTR .= 'NM1' . $E . 'QC' . $E . '1' . $E . $CLM->PATLastName . $E . $CLM->PATFirstName;
			if ($CLM->PATMiddleInitial!= '')
				$claimSTR .= $E . $CLM->PATMiddleInitial;
			$claimSTR .= $S;
			$claimSTR .= 'N3' . $E . $CLM->PATAddress . $S;
			$claimSTR .= 'N4' . $E . $CLM->PATCity . $E . $CLM->PATState . $E . $CLM->PATZipCode . $S;
			$claimSTR .= 'DMG' . $E . 'D8' . $E . $CLM->PATDob . $E . $CLM->PATGender . $S;
		}

		$claimSTR .= 'CLM' . $E . $CLM->PatientControlNumber . $E . $CLM->ClaimAmount . $E . $E . $E
					   . $CLM->POSCode . $C . 'B' . $C . $CLM->ClaimFreqCode . $E . 'Y' . $E . 'A' . $E . 'Y' . $E . 'Y';
		if ($CLM->AccidentType!= '')
		{
			$claimSTR .= $E . $E . $CLM->AccidentType;
			if ($CLM->AccidentState!= '')
				$claimSTR .= $C . $C . $C . $CLM->AccidentState;
		}
		$claimSTR .= $S;

		//00010101

		if ($CLM->CurrentIllnessDate != '')
			$claimSTR .= 'DTP' . $E . '431' . $E . 'D8' . $E . $CLM->CurrentIllnessDate . $S;
		if ($CLM->InitialTreatmentDate != '')
			$claimSTR .= 'DTP' . $E . '454' . $E . 'D8' . $E . $CLM->InitialTreatmentDate . $S;
		if ($CLM->LastSeenDate != '')
			$claimSTR .= 'DTP' . $E . '304' . $E . 'D8' . $E . $CLM->LastSeenDate . $S;
		if ($CLM->AcuteManifestationDate != '')
			$claimSTR .= 'DTP' . $E . '453' . $E . 'D8' . $E . $CLM->AcuteManifestationDate . $S;
		if ($CLM->AccidentDate != '')
			$claimSTR .= 'DTP' . $E . '439' . $E . 'D8' . $E . $CLM->AccidentDate . $S;
		if ($CLM->LMPDate != '')
			$claimSTR .= 'DTP' . $E . '484' . $E . 'D8' . $E . $CLM->LMPDate . $S;
		if ($CLM->XrayDate != '')
			$claimSTR .= 'DTP' . $E . '455' . $E . 'D8' . $E . $CLM->XrayDate . $S;

		if ($CLM->DisabilityStartDate != '' && $CLM->DisabilityEndDate != '')
			$claimSTR .= 'DTP' . $E . '314' . $E . 'RD8' . $E . $CLM->DisabilityStartDate . '-' . $CLM->DisabilityEndDate . $S;
		else if ($CLM->DisabilityStartDate != '')
			$claimSTR .= 'DTP' . $E . '360' . $E . 'D8' . $E . $CLM->DisabilityStartDate . $S;
		else if ($CLM->DisabilityEndDate != '')
			$claimSTR .= 'DTP' . $E . '361' . $E . 'D8' . $E . $CLM->DisabilityEndDate . $S;

		if ($CLM->LastWorkedDate != '')
			$claimSTR .= 'DTP' . $E . '297' . $E . 'D8' . $E . $CLM->LastWorkedDate . $S;

		// this contains the admission date & time.
		if ($CLM->AdmissionDate != '')
			$claimSTR .= 'DTP' . $E . '435' . $E . 'DT' . $E . $CLM->AdmissionDate . $S;
		if ($CLM->DischargeDate != '')
			$claimSTR .= 'DTP' . $E . '096' . $E . 'D8' . $E . $CLM->DischargeDate . $S;

		if ($CLM->ReferralNumber!= '')
			$claimSTR .= 'REF' . $E . '9F' . $E . $CLM->ReferralNumber . $S;
		if ($CLM->PriorAuthNumber!= '')
			$claimSTR .= 'REF' . $E . 'G1' . $E . $CLM->PriorAuthNumber . $S;
		//if (!string.IsNullOrEmpty($CLM->Payer$claimSTRCntrlNum))
		//    $claimSTR .= 'REF' . $E . 'F8' . $E . $CLM->Payer$claimSTRCntrlNum . $S;
		if ($CLM->CliaNumber!= '')
			$claimSTR .= 'REF' . $E . 'X4' . $E . $CLM->CliaNumber . $S;

		$claimSTR .= 'REF' . $E . 'EA' . $E . $CLM->MedicalRecordNumber . $S;

		if ($CLM->ClaimNotes!= '')
			$claimSTR .= 'NTE' . $E . 'ADD' . $E . $CLM->ClaimNotes . $S;

		$claimSTR .= 'HI' . $E . 'ABK' . $C . str_replace($CLM->ICD1Code, '.', '');
		if ($CLM->ICD2Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD2Code, '.', '');
		if ($CLM->ICD3Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD3Code, '.', '');
		if ($CLM->ICD4Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD4Code, '.', '');
		if ($CLM->ICD5Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD5Code, '.', '');
		if ($CLM->ICD6Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD6Code, '.', '');
		if ($CLM->ICD7Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD7Code, '.', '');
		if ($CLM->ICD8Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD8Code, '.', '');
		if ($CLM->ICD9Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD9Code, '.', '');
		if ($CLM->ICD10Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD10Code, '.', '');
		if ($CLM->ICD11Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD11Code, '.', '');
		if ($CLM->ICD12Code!= '') $claimSTR .= $E . 'ABF' . $C . str_replace($CLM->ICD12Code, '.', '');
		
		$claimSTR .= $S;

		//HI    -   Anesthesia related
		//HCP   -   $claimSTR Pricing/Reprincing info   

		if ($CLM->RefPrvLastName!= '')
		{
			$claimSTR .= 'NM1' . $E . 'DN' . $E . '1' . $E . $CLM->RefPrvLastName . $E . $CLM->RefPrvFirstName . $E . $CLM->RefPrvMI . $E . $E . $E . 'XX' . $E . $CLM->RefPrvNPI . $S;
		}
		if ($CLM->RendPrvLastName!= '')
		{
			$rendEntity = '';
			if ($CLM->RendPrvFirstName != '') $rendEntity = '1';
			else $rendEntity = '2';
			
			$claimSTR .= 'NM1' . $E . '82' . $E . $rendEntity . $E . $CLM->RendPrvLastName;
			if ($CLM->RendPrvNPI!= '')
				$claimSTR .= $E . $CLM->RendPrvFirstName . $E . $CLM->RendPrvMI . $E . $E . $E . 'XX' . $E . $CLM->RendPrvNPI;
			else if ($CLM->RendPrvLastName!= '')
				$claimSTR .= $E . $CLM->RendPrvFirstName;
			$claimSTR .= $S;
			
			if ($CLM->RendPrvTaxonomy!= '') $claimSTR .= 'PRV' . $E . 'PE' . $E . 'PXC' . $CLM->RendPrvTaxonomy . $S;
			if ($CLM->RendPrvSecondaryID!= '') $claimSTR .= 'REF' . $E . 'G2' . $E . $CLM->RendPrvSecondaryID . $S;
		}
		if ($CLM->LocationOrgName!= '')
		{
			$claimSTR .= 'NM1' . $E . '77' . $E . '2' . $E . $CLM->LocationOrgName;
			if ($CLM->LocationNPI!= '') $claimSTR .= $E . $E . $E . $E . $E . 'XX' . $E . $CLM->LocationNPI;
			$claimSTR .= $S;
			if ($CLM->LocationAddress!= '')
			{
				$claimSTR .= 'N3' . $E . $CLM->LocationAddress . $S;
				$claimSTR .= 'N4' . $E . $CLM->LocationCity . $E . $CLM->LocationState . $E . $CLM->LocationZip . $S;
			}
		}
		if ($CLM->SuperPrvLastName!= '')
		{
			$claimSTR .= 'NM1' . $E . 'DQ' . $E . '1' . $E . $CLM->SuperPrvLastName . $E . $CLM->SuperPrvFirstName . $E . $CLM->SuperPrvMI . $E . $E . $E . 'XX' . $E . $CLM->SuperPrvNPI . $S;
		}

		//SECONDARY $claimSTR
		if ($CLM->ClaimType == 'S')
		{
			$claimSTR .= 'SBR' . $E . 'P' . $E . $CLM->OtherSBRPatRelationV . $E . $CLM->OtherSBRGroupNumber . $E . $CLM->OtherSBRGroupName
					   . $E . $E . $E . $E . $E . $CLM->PayerType . $S;

			$claimSTR .= 'AMT' . $E . 'D' . $E . $CLM->PrimaryPaidAmt . $S;
			$claimSTR .= 'OI' . $E . $E . $E . 'Y' . $E . $E . $E . 'Y' . $S;
			$claimSTR .= 'NM1' . $E . 'IL' . $E . '1' . $E . $CLM->OtherSBRLastName . $E . $CLM->OtherSBRFirstName . $E . $CLM->OtherSBRMI . $E . $E . $E . 'MI' . $E . $CLM->OtherSBRId . $S;
			if ($CLM->OtherSBRAddress!= '')
			{
				$claimSTR .= 'N3' . $E . $CLM->OtherSBRAddress . $S;
				$claimSTR .= 'N4' . $E . $CLM->OtherSBRCity . $E . $CLM->OtherSBRState . $E . $CLM->OtherSBRZipCode . $S;
			}
			$claimSTR .= 'NM1' . $E . 'PR' . $E . '2' . $E . $CLM->OtherPayerName . $E . $E . $E . $E . $E . 'PI' . $E . $CLM->OtherPayerID . $S;
			if ($CLM->OtherPayerAddress!= '')
			{
				$claimSTR .= 'N3' . $E . $CLM->OtherPayerAddress . $S;
				$claimSTR .= 'N4' . $E . $CLM->OtherPayerCity . $E . $CLM->OtherPayerState . $E . $CLM->OtherPayerZipCode . $S;
			}
			$claimSTR .= 'REF' . $E . 'F8' . $E . $CLM->PayerClaimCntrlNum . $S;
		}
		//
		$this->ProcessedClaims += 1;
		
		return $claimSTR;
	}
	
	function GenerateCharge($CH, $CLM) {
		$ChargeSTR = '';
		
		$E = $this->E;
		$C = $this->C;
		$S = $this->S;
		$R = $this->R;
		
		$this->lxCounter += 1;
		
		$ChargeSTR .= 'LX' . $E . $this->lxCounter . $S;
		$ChargeSTR .= 'SV1' . $E . 'HC' . $C . $CH->CptCode;

		if ($CH->LIDescription != '')
			$ChargeSTR .= $C . $CH->Modifier1 . $C . $CH->Modifier2 . $C . $CH->Modifier3 . $C . $CH->Modifier4 . $C . $CH->LIDescription;
		else if ($CH->Modifier4 != '')
			$ChargeSTR .= $C . $CH->Modifier1 . $C . $CH->Modifier2 . $C . $CH->Modifier3 . $C . $CH->Modifier4;
		else if ($CH->Modifier3 != '')
			$ChargeSTR .= $C . $CH->Modifier1 . $C . $CH->Modifier2 . $C . $CH->Modifier3;
		else if ($CH->Modifier2 != '')
			$ChargeSTR .= $C . $CH->Modifier1 . $C . $CH->Modifier2;
		else if ($CH->Modifier1 != '')
			$ChargeSTR .= $C . $CH->Modifier1;

		//SV1*HC:98941*101*UN*1***1:2:3:4~

		$ChargeSTR .= $E . $CH->ChargeAmount . $E;
		if ($CH->Units != '') $ChargeSTR .= 'UN' . $E . $CH->Units;
		if ($CH->Minutes != '') $ChargeSTR .= 'MJ' . $E . $CH->Minutes;

		$ChargeSTR .= $E . $CH->POS . $E . $E . $CH->Pointer1;
		if ($CH->Pointer2 != '') $ChargeSTR .= $C . $CH->Pointer2;
		if ($CH->Pointer3 != '') $ChargeSTR .= $C . $CH->Pointer3;
		if ($CH->Pointer4 != '') $ChargeSTR .= $C . $CH->Pointer4;
		$ChargeSTR .= $S;

		if ($CH->DateofServiceFrom != ''  and $CH->DateOfServiceTo != ''  and  $CH->DateofServiceFrom != $CH->DateOfServiceTo)
			$ChargeSTR .= 'DTP' . $E . '472' . $E . 'RD8' . $E . $CH->DateofServiceFrom . '-' . $CH->DateOfServiceTo . $S;
		else
			$ChargeSTR .= 'DTP' . $E . '472' . $E . 'D8' . $E . $CH->DateofServiceFrom . $S;

		$ChargeSTR .= 'REF' . $E . '6R' . $E . $CH->LineItemControlNum . $S;
		if ($CH->ServiceLineNotes != '') $ChargeSTR .= 'NTE' . $E . 'ADD' . $E . $CH->ServiceLineNotes . $S;

		if ($CH->DrugNumber != '') $ChargeSTR .= 'LIN' . $E . $E . 'N4' . $E . $CH->DrugNumber . $S;
		if ($CH->DrugCount != '') $ChargeSTR .= 'CTP' . $E . $E . $E . $E . $CH->DrugCount . $E . $CH->DrugUnit . $S;


		if ($CLM->ClaimType == 'S')
		{
			$ChargeSTR .= 'SVD' . $E . $CLM.OtherPayerID  . $E . $CH->PrimaryPaidAmt . $E . 'HC' . $C . $CH->PrimaryCPT;

			if ($CH->PrimaryMod4 != '')
				$ChargeSTR .= $C . $CH->PrimaryMod1 . $C . $CH->PrimaryMod2 . $C . $CH->PrimaryMod3 . $C . $CH->PrimaryMod4;
			else if ($CH->PrimaryMod3 != '')
				$ChargeSTR .= $C . $CH->PrimaryMod1 . $C . $CH->PrimaryMod2 . $C . $CH->PrimaryMod3;
			else if ($CH->PrimaryMod2 != '')
				$ChargeSTR .= $C . $CH->PrimaryMod1 . $C . $CH->PrimaryMod2;
			else if ($CH->PrimaryMod1 != '')
				$ChargeSTR .= $C . $CH->PrimaryMod1;

			$ChargeSTR .= E . $E . $CH->PrimaryUnits . $S;

			if ($CH->PrimaryWriteOffAmt != 0)
				$ChargeSTR .= 'CAS' . $E . 'CO' . $E .  '45' . $E . $CH->PrimaryWriteOffAmt . $S;

			if ( $CH->PrimaryDeductable.Amt() != 0 && $CH->PrimaryCoIns.Amt() != 0)
				$ChargeSTR .= 'CAS' . $E . 'PR' . $E . '1' . $CH->PrimaryDeductable . $E . '1' . $E . '2' . $E . $CH->PrimaryCoIns . '1' .  S;
			else if ($CH->PrimaryDeductable.Amt() != 0)
				$ChargeSTR .= 'CAS' . $E . 'PR' . $E . '1' . $E . $CH->PrimaryDeductable . $E . '1' . $S;
			else if ($CH->PrimaryCoIns.Amt() != 0)
				$ChargeSTR .= 'CAS' . $E . 'PR' . $E . '2' . $E . $CH->PrimaryCoIns . $E . '1' . $S;

			if ($CH->PrimaryPaidDate != '' )
				$ChargeSTR .= 'DTP' . $E . '573' . $E . 'D8' . $E . $CH->PrimaryPaidDate . $S;
		}

		$dt = date('Y-m-d\TH:i:sP');
		
		$CH->Processed = true;
		$CH->ProcessedDate = $dt;

		$CLM->Processed = true;
		$CLM->ProcessedDate = $dt;

		return $ChargeSTR;
	}
	
	function GenerateTrailer($Header) {
		$E = $this->E;
		$C = $this->C;
		$S = $this->S;
		$R = $this->R;
		
		$trailerSTR = '';
		
		$trailerSTR .= 'SE' . $E . ($this->elementsCount) . $E . '0001' . $S;
		
		$trailerSTR .= 'GE' . $E . "1" . $E . $Header->ISA13CntrlNumber . $S;
		$trailerSTR .= 'IEA' . $E . "1" . $E . $Header->ISA13CntrlNumber . $S;
		return $trailerSTR;
	}
		
	
	function Validate($Header, $CLM) {
		$msg = '';

		if ($CLM->SBRLastName == '' or $CLM->SBRFirstName == '')
			$msg = "Subscriber Insured Name is requried";
		else if ($CLM->SBRAddress == '' or $CLM->SBRCity == '' or $CLM->SBRState == '' or $CLM->SBRZipCode == '')
			$msg = "Subscriber Address, City, State and Zip Code are required";
		else if ($CLM->SBRID == '')
			$msg = "Subscriber ID is required";
		else if ($CLM->ClaimType == '')
			$msg = "Claim Type is required";
		else if ($CLM->PayerType == '')
			$msg = "Payer Type is required";
		else if ($CLM->PatientRelationShip == '')
			$msg = "Patient Relationship is required";
		else if ($CLM->PayerName == '')
			$msg = "Payer Name is required";
		else if ($CLM->PayerID == '')
			$msg = "Payer ID is required";
		else if ($CLM->BillPrvOrgName == '')
			$msg = "Billing Provider Name is required";
		else if ($Header->RelaxNpiValidation != false && $CLM->BillPrvNPI == '')
			$msg = "Billing Provider NPI is required";
		else if ($CLM->BillPrvAddress1 == '' or $CLM->BillPrvCity == '' or $CLM->BillPrvState == '' or $CLM->BillPrvZipCode == '')
			$msg = "Billing Provider Address, City, State and Zip Code are required";
		else if ($CLM->BillPrvTaxID == '')
			$msg = "Billing Provider Tax ID is required";
		else if ($CLM->PatientControlNumber == '')
			$msg = "Patient Control Number is required";
		else if ($CLM->ClaimAmount <= 0)
			$msg = "Claim Amount is rqeuired";
		else if ($CLM->ICD1Code == '')
			$msg = "ICD Code 1 is required";
		else if ($CLM->POSCode == '')
			$msg = "Place of Service is required";
		else if ($CLM->PatientRelationShip != "18")
		{
			if ($CLM->PATLastName == '' or $CLM->PATFirstName == '')
				$msg = "Patient Name is requried";
			else if ($CLM->PATAddress == '' or $CLM->PATCity == '' or $CLM->SBRState == ''
			or $CLM->PATZipCode == '')
				$msg = "Patient Address, City, State and Zip Code are required";
		}

		if ($msg != '')
			return $msg;

		foreach ($CLM->ListOfChargesData as $CH)
		{
			if ($CH->CptCode == '')
				$msg = "CPT Code is required";
			else if ($CH->ChargeAmount <= 0)
				$msg = "Service Line Amount is required";
			else if ($CH->Units == '')
				$msg = "Service Line Units are required";
			else if ($CH->Pointer1 == '')
				$msg = "Service Line Pointer 1 is required";
			else if ($CH->DateofServiceFrom == '')
				$msg = "Service Line Date Of Service is required";
			else if ($CH->LineItemControlNum == '')
				$msg = "Service Line Control Number is required";
		}

		return $msg;
	}	
}


    
    //Creating the EDI 837 Generation object
			
$generate = new ClaimGenerator();
$header = new ClaimHeader();
$listOfClaims = array();

// Hard-coded Values
$header->ISA01AuthQual = '00';
$header->ISA02AuthInfo = '';
$header->ISA03SecQual = '00';
$header->ISA04SecInfo = '';
$header->ISA05SenderQual = 'ZZ';
// Sender ID - THiS ID IS PROVIDED BY ZIRMED
$header->ISA06SenderID = '101410';
$header->ISA07ReceiverQual = 'ZZ';
// RECEIVER ID - THiS ID IS PROVIDED BY ZIMRED
$header->ISA08ReceiverID = 'ZIRMED';

// 9 Digit Unique Control Number For Every Batch
// Use any sequencer starting with 111111111 and incriment every time.
$header->ISA13CntrlNumber = '111111111';

// File Indicator
// T for Test, P for Production
$header->ISA15UsageIndi = 'T';

// Sender\Receiver IDs - ASSIGNED BY ZIMRED
$header->GS02SenderID = '101410';
$header->GS03ReceiverID = 'ZIRMED';

// PUT THE SUBMITTER\BILLING COMPANY HERE
$header->SubmitterOrgName = 'ABCOR HOME HEALTH';
$header->SubmitterID = '101410';    	// ASIGNED BY ZIMRED

$header->SubmitterContactName = 'IT SUPERVISOR';
$header->SubmitterTelephone = '8476708268';
$header->SubmitterEmail = '';
// 
$header->ReceiverOrgName = 'ZIRMED';
$header->ReceiverID = 'ZIRMED';

// USE IT AS FALSE.
$header->RelaxNpiValidation = true;		// Set this true, because in your case NPI is not used.

// Claim 1 Data -   Subscriber and Patient is SAME

$claim = new ClaimData();
// Billing Provider\Practice\Facility
$claim->BillPrvOrgName = 'ABCOR HOME HEALTH';
$claim->BillPrvFirstName = '';
$claim->BillPrvEntityType = '2';
$claim->BillPrvNPI = '1234567890';				// this will be empty in your case

// Practice\Billing Provider Address
$claim->BillPrvAddress1 = '3201 N WILKE RD';
$claim->BillPrvCity = 'ARLINGTON HEIGHTS';
$claim->BillPrvState = 'IL';
$claim->BillPrvZipCode = '600040000';

// Billing Provider Tax ID\EIN
$claim->BillPrvTaxID = '203030621';

// Billing Provider Secondary ID
$claim->BillPrvSecondaryID = '203030621902';		// copied from your edi file

// Billing Provider Taxonomy
$claim->BillPrvTaxonomyCode = '';					// not used here in your case

// Billing Provider Pay to Address (Where Checks will be droppd)		// empty in your case
$claim->BillPrvPayToAddr = '';
$claim->BillPrvPayToCity = '';
$claim->BillPrvPayToState = '';
$claim->BillPrvPayToZip = '';


// Set Following Values for Payer Type

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
$claim->PayerType = 'CI';

// Claim Type
// P for Primary, S for Secondary
$claim->ClaimType = 'P';
$claim->SbrGroupNumber = '';

// Subscriber\Insured Name, Insrued ID, Address, Gender, DOB
$claim->SBRLastName = 'TENKE';
$claim->SBRFirstName = 'JOHN';
$claim->SBRID = '890653812';
$claim->SBRAddress = '20 LEUCE PL';
$claim->SBRCity = 'GLEN COVE';
$claim->SBRState = 'NY';
$claim->SBRZipCode = '11542';
$claim->SBRDob = '19900325';
$claim->SBRGender = 'M';      // M for Male, F for Female, U for Unknown

// Patient Relation Ship With Insured.
// Self             -   18
// Child            -   19
// Spouse           -   01
// Unknown/Other    -   21
$claim->PatientRelationShip = '18';

// IF PATIENT RELATION SHIP IS SELF (18), NO NEED TO SET PATIENT FEILDS
$claim->PATLastName = '';
$claim->PATFirstName = '';
$claim->PATMiddleInitial = '';
$claim->PATAddress = '';
$claim->PATCity = '';
$claim->PATState = '';
$claim->PATZipCode = '';
$claim->PATDob = '';
$claim->PATGender = 'F';
//

// Insurace\Payer Name, Payer ID
$claim->PayerName = 'AETNA BETTER HEALTH';
$claim->PayerID = '26337';    // Payer ID - Will be selected from Office Allay Payer List


// Patient Account Number
$claim->PatientControlNumber = 'BC59010';		// unique claim number
$claim->MedicalRecordNumber = 'AH10002681-AET';	// medical record number

// Total Charge Amount
$claim->ClaimAmount = 45.15;
// Place of Service - Set Place of Service from First Service Line
$claim->POSCode = '32';		

// ICD\Diagnosis
$claim->ICD1Code = '2356.1'; $claim->ICD2Code = ''; $claim->ICD3Code = '';
$claim->ICD4Code = ''; $claim->ICD5Code = ''; $claim->ICD6Code = '';
$claim->ICD7Code = ''; $claim->ICD8Code = ''; $claim->ICD9Code = '';
$claim->ICD10Code = ''; $claim->ICD11Code = ''; $claim->ICD12Code = '';


$claim->AccidentDate = '';				// accident info empty in you case
// Auto Accident    -   AA
// Employment       -   EM
// Other Accident   -   OA
$claim->AccidentType = '';
$claim->AccidentState = '';

// Claim Dates
$claim->AdmissionDate = '201107211201';		// this is date time yyyyMMddhhmmss
$claim->DischargeDate = '';
$claim->LMPDate = '';
$claim->InitialTreatmentDate = '';
$claim->DisabilityStartDate = '';
$claim->DisabilityEndDate = '';

$claim->PriorAuthNumber = 'PriorAuthNumber';	// this is used in your case. 

// Rendering Provider
$claim->RendPrvLastName = '';	// empty in your case 
$claim->RendPrvFirstName = '';
$claim->RendPrvMI = '';
$claim->RendPrvNPI = '';

// Referring Provider			// empty in your case
$claim->RefPrvLastName = '';
$claim->RefPrvFirstName = '';
$claim->RefPrvMI = '';
$claim->RefPrvNPI = '';

// Supervising Provider			// empty in your case
$claim->SuperPrvLastName = '';
$claim->SuperPrvFirstName = '';
$claim->SuperPrvMI = '';
$claim->SuperPrvNPI = '';

// Location
$claim->LocationOrgName = '';	// empty in your case	
$claim->LocationNPI = '';
$claim->LocationAddress = '';
$claim->LocationCity = '';
$claim->LocationState = '';
$claim->LocationZip = '';


// Service Lines
$charge1 = new ChargeData();
$charge1->CptCode = '9989M';      // CPT
$charge1->ChargeAmount = 39.15;    // Charge Amount
$charge1->Units = '45';           // Units
$charge1->Pointer1 = '1';         // Pointer 1
$charge1->Pointer2 = '';         // Pointer 2
$charge1->Pointer3 = '';         // Pointer 3
$charge1->Pointer4 = '';         // Pointer 4
$charge1->POS = '';             // POS - Don't set if, POS is same of All Charges and same with Claim POS
$charge1->DateofServiceFrom = '20190706';      // Date of Service
$charge1->DateOfServiceTo = '';
$charge1->LineItemControlNum = '5853175';        // Charge Control Number - Unique Number - Era Payment will be mapped with this.
$charge1->LIDescription = 'HOMEMAKER SERVICES';	// this is used in your case for few types of visits.

$charge2 = new ChargeData();

$charge2->CptCode = '9986M';      // CPT
$charge2->ChargeAmount = 6;    // Charge Amount
$charge2->Units = '11';            // Units
$charge2->Pointer1 = '1';         // Pointer 1
$charge2->Pointer2 = '';         // Pointer 2
$charge2->Pointer3 = '';         // Pointer 3
$charge2->Pointer4 = '';         // Pointer 4
$charge2->POS = '';             // POS - Don't set if, POS is same of All Charges and same with Claim POS
$charge2->DateofServiceFrom = '20190706';      // Date of Service
$charge2->DateOfServiceTo = null;
$charge2->LineItemControlNum = '5853175';        // Charge Control Number - Unique Number - Era Payment will be mapped with this.

// Adding Claim's Charges into List
array_push($claim->ListOfChargesData, $charge1);
array_push($claim->ListOfChargesData, $charge2);

// Adding Claims into Claims List
array_push($listOfClaims, $claim);


// Claim 2 - Patient is not the subscriber\Insured
$claim2 = new ClaimData();
$claim2->BillPrvOrgName = 'ABC Provider';
$claim2->BillPrvNPI = '1111111111';
$claim2->BillPrvAddress1 = '89A ADDRESS';
$claim2->BillPrvCity = 'GLEN COVE';
$claim2->BillPrvState = 'NY';
$claim2->BillPrvZipCode = '12345';

// Commented this line, so that we get Validation Msg for your demonstration.
$claim2->BillPrvTaxID = '000254123';

$claim2->BillPrvPayToAddr = 'PO BOX 123';
$claim2->BillPrvPayToCity = 'NEW HYDE PARK';
$claim2->BillPrvPayToState = 'NY';
$claim2->BillPrvPayToZip = '12345';

$claim2->PayerType = 'CI';

// Claim Type
// P for Primary, S for Secondary
$claim2->ClaimType = 'P';

$claim2->PatientRelationShip = '21';

$claim2->PATLastName = 'PAT LAST NAME';
$claim2->PATFirstName = 'PAT FIRST NAME';
$claim2->PATMiddleInitial = '';
$claim2->PATAddress = 'PATIENT ADDRESS';
$claim2->PATCity = 'CITY';
$claim2->PATState = 'NY';
$claim2->PATZipCode = '12345';
$claim2->PATDob = '19900325';
$claim2->PATGender = 'F';


$claim2->SBRLastName = 'TENKE';
$claim2->SBRFirstName = 'JOHN';
$claim2->SBRID = '890653812';
$claim2->SBRAddress = '20 LEUCE PL';
$claim2->SBRCity = 'GLEN COVE';
$claim2->SBRState = 'NY';
$claim2->SBRZipCode = '11542';
$claim2->SBRDob = '19500325';
$claim2->SBRGender = 'M';
$claim2->PayerName = 'UNITED HEALTHCARE';
$claim2->PayerID = '87726';
$claim2->PatientControlNumber = '330420V5853175E691';
$claim2->ClaimAmount = 351.01;

$claim2->POSCode = '11';
$claim2->ICD1Code = 'M9901'; 
$claim2->ICD2Code = 'M5003'; 
$claim2->ICD3Code = 'M531'; 
$claim2->ICD4Code = 'M542';
$claim2->RendPrvLastName = 'COHEN';
$claim2->RendPrvFirstName = 'FRANK';
$claim2->RendPrvNPI = '1629152921';
$claim2->LocationOrgName = 'GLEN COVE CHIROPRACTIC AND PT';
$claim2->LocationAddress = '189 FOREST AVENUE STE A';
$claim2->LocationCity = 'GLEN COVE';
$claim2->LocationState = 'NY';
$claim2->LocationZip = '115422020';


$charge1 = new ChargeData();
$charge1->CptCode = '97110';
$charge1->ChargeAmount = 80.9;
$charge1->Units = '1';
$charge1->Pointer1 = '1';
$charge1->Pointer2 = '2';
$charge1->Pointer3 = '3';
$charge1->Pointer4 = '4';
$charge1->DateofServiceFrom = '20190705';
$charge1->LineItemControlNum = '5853176';

array_push($claim2->ListOfChargesData, $charge1);
array_push($listOfClaims, $claim2);


//List<ClaimData> claims = new List<ClaimData>() { claim, claim2 };
//List<ClaimData> claims = new List<ClaimData>() { claim};
$output = $generate->Generate837Transaction($header, $listOfClaims, '837.txt');

echo "Processed Claims: " . $output->ProcessedClaims . "\n" ;

// 	Based on the Output, you can maintain the SubmissionHistoryLog (batch wise) with following columns
//	ID, Edi837FilePath, NumberOfClaims, Amount, Date etc.
	

// Check For Not Processed Claims, that are put on hold due to required data missing.
foreach ($output->ListOfClaims as $CLM)
{
	// If Processed is True, that means this claim has been included in the claim string.
	// You can mark the claim Processed in your system, based on this variable.
	if ($CLM->Processed)
	{
		echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Processed: ' . $CLM->Processed . ', Processed Date: ' . $CLM->ProcessedDate . "\n" ;
	}
	// If claim is not Processed, it will have the Validation Message 
	// Probably the required data is not provided.
	else
	{
		// You can get ValidationMsg
		// And Save into your system.
		// Can Resubmit Again after fixing the data.
		// Validation Msgs could be: Billing Provider NPI is required Or Payer Type is required etc.

		// Validation Msgs are put so that clean claim should be submitted to OFFICEALLY in the first place.
		$validationMsg = $CLM->ValidationMsg;
		
		if ($validationMsg != '')
			echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Validation Msg. ' . $CLM->ValidationMsg . "\n" ;
	}
}


    echo "EDI Transaction:" . "\n";
    echo $output->Transaction837;




?>
</body>
</html>