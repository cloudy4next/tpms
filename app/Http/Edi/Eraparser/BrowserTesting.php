<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>

<?php
    
    
    class ERAHeader {
	
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


    class ERAVisitPayment {

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
    
    
    	public $DeductableAmt;
    	public $CoInsuranceAmt;
    	public $CopayAmt;
    	public $WriteOffAmt;
    
		public $OtherAdjustmentGroupCode1;
    	public $OtherAdjustmentCode1;
    	public $OtherAdjustmentAmt1;
		public $OtherAdjustmentGroupCode2;
    	public $OtherAdjustmentCode2;
    	public $OtherAdjustmentAmt2;
		public $OtherAdjustmentGroupCode3;
    	public $OtherAdjustmentCode3;
    	public $OtherAdjustmentAmt3;
		public $OtherAdjustmentGroupCode4;
    	public $OtherAdjustmentCode4;
    	public $OtherAdjustmentAmt4;
		public $OtherAdjustmentGroupCode5;
    	public $OtherAdjustmentCode5;
    	public $OtherAdjustmentAmt5;
    
    	public $OtherAdjustmentAmt;
    	public $CorrectionReversalAmt;
    	public $PayerReductionAmt;
    	public $GroupOrPolicyNum;
    	
    	// Array for charge payments
    	public $ERAChargePayments = array();
    	
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

    
    class ERAChargePayment {

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
    
		public $OtherAdjustmentGroupCode1;
    	public $OtherAdjustmentCode1;
    	public $OtherAdjustmentAmt1;
		public $OtherAdjustmentGroupCode2;
    	public $OtherWriteOffCode2;
    	public $OtherAdjustmentAmt2;
		public $OtherAdjustmentGroupCode3;
    	public $OtherAdjustmentCode3;
    	public $OtherAdjustmentAmt3;
		public $OtherAdjustmentGroupCode4;
    	public $OtherAdjustmentCode4;
    	public $OtherAdjustmentAmt4;
		public $OtherAdjustmentGroupCode5;
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


    class ERAParser {

	//variable for segment counter
    private $_counter = 0;
	// E->	Element Separator, C->	Component Separator, S-> Separator
	private $E = ' ', $C = ' ', $S = ' ';
	// Elements of a segment
	private $elements;
	// Segments of the entire Files
	private $segments; 
	
	// ISA segment Variables
	private $ISA06 = ' ', $GS02 = ' ', $GS03 = '';
	private $ISA08 = '';
	private $ISAControlNum = '';
	private $GSConrolNum = ''; 
	private $Version = '';
	private $ISADate;
	private $ISATime;
	
	// Variable that will hold Complete Parsed Data
	public $ERAData = array();
	
	
	function ParseERAFile($FilePath) {
		
		$this->_counter = 0;

		// Getting File Contents
		// $this->contents = file_get_contents($FilePath);
		
		$this->contents = 'ISA|00|          |00|          |ZZ|ZIRMED         |ZZ|AV09311993     |220120|1608|}|00501|000012711|0|P|^~GS|HP|ZIRMED|AV01101957|20220120|1608|12704|X|005010X221A1~ST|835|0001~BPR|H|0|C|NON||||||||||||20220119~TRN|1|NO-PAY-202201190004080|1610647538~REF|EV|030240928~DTM|405|20220119~N1|PR|HUMANA INC.|XV|610647538~N3|P.O. BOX 14601~N4|LEXINGTON|KY|405124601~PER|BL~PER|IC||UR|APPS.HUMANA.COM/MARKETING/DOCUMENTS.ASP?FILE=2859948~N1|PE|ABCOR HOME HEALTH|XX|1750614731~N3|3201 N WILKE RD~N4|ARLINGTON HEIGH|IL|600041573~REF|PQ|331984~REF|TJ|203030621~LX|1~TS3|1750614731|12|20221231|2|561.6~CLP|179650|1|374.4|0||MC|820220130182024|12|1~NM1|QC|1|GONZALEZ|JUAN||||MI|H57112430~NM1|74|1|GONZALEZ|JUAN||||C|H57112430~NM1|82|2|ABCOR HOME HEALTH, INC.|||||XX|1750614731~REF|1L|00A18701~REF|CE|MEDICAID GATED CAPITATED~DTM|232|20211216~DTM|233|20211221~DTM|050|20220113~SVC|HC^S5130|74.88|0||12~DTM|472|20211216~CAS|PI|16|74.88~REF|6R|1200415~REF|0K|RECONSIDERATION~LQ|HE|N56~SVC|HC^S5130|99.84|0||16~DTM|472|20211217~CAS|PI|16|99.84~REF|6R|1200416~REF|0K|RECONSIDERATION~LQ|HE|N56~SVC|HC^S5130|99.84|0||16~DTM|472|20211220~CAS|PI|16|99.84~REF|6R|1200417~REF|0K|RECONSIDERATION~LQ|HE|N56~SVC|HC^S5130|99.84|0||16~DTM|472|20211221~CAS|PI|16|99.84~REF|6R|1200418~REF|0K|RECONSIDERATION~LQ|HE|N56~CLP|85|1|187.2|0||MC|820220120305089|12|1~NM1|QC|1|PARTIDA|REYNALDO||||MI|H40667239~NM1|74|1|PARTIDA|REYNALDO||||C|H40667239~NM1|82|2|ABCOR HOME HEALTH, INC.|||||XX|1750614731~REF|1L|00A18702~REF|CE|MEDICAID GATED CAPITATED~REF|G1|141346476~DTM|232|20211216~DTM|233|20211223~DTM|050|20220112~SVC|HC^S5130|87.36|0||14~DTM|472|20211216~CAS|CO|197|87.36~REF|6R|1941~REF|0K|RECONSIDERATION~SVC|HC^S5130|99.84|0||16~DTM|472|20211223~CAS|CO|197|99.84~REF|6R|2206~REF|0K|RECONSIDERATION~SE|71|0001~GE|1|12704~IEA|1|000012711~';
		
		
		// Checking, if it is a valid EDI File
		if (substr($this->contents, 0, 3) != "ISA") throw new Exception("Invalid File ". $FilePath);
		
		// Getting Element, Component, Segment Separator
		$this->E = substr($this->contents, 3, 1);
		$this->C = substr($this->contents, 104, 1);
		$this->S = substr($this->contents, 105, 1);

		// Spliting the file on the basis of segment separator	
		$this->segments = explode($this->S, $this->contents);
		
		// Looping util segments size equals to counter
		// Loop will end once file is read completely.
		while (sizeof($this->segments) != $this->_counter + 1) {
			// Spiliting the current segment into elements
			$this->elements = explode($this->E, $this->segments[$this->_counter]);
			
			switch (trim($this->elements[0])) {
				// Header Segment, that contains the file sender and receiver info
				case "ISA":
					
					$this->ISA06 = $this->elements[6];
					$this->ISA08 = $this->elements[8];
					$ISADate = $this->elements[9];
					$ISATime = $this->elements[10];
					$this->ISAControlNum = $this->elements[13];
					break;
				// Header Segment, that contains the file sender and receiver info
				case "GS":
					$this->GS02 = $this->elements[2];
					$this->GS03 = $this->elements[3];
					if (sizeof($this->elements) >= 9) $this->Version = $this->elements[8];
					$this->GSConrolNum = $this->elements[6];
					break;

				case "ST":
					$this->ParseST();
					break;

				case "SE":
				case "GE":
				case "IEA":
					break;

				default:
					break;
			}
			$this->_counter = $this->_counter + 1;
		}
	}

    function ParseST() {
		$eraHeader = new ERAHeader();
		
		$eraHeader->__set('ISA06SenderID', $this->ISA06);
		$eraHeader->__set('ISA08ReceiverID', $this->ISA08);
		$eraHeader->__set('ISADateTime', $this->ISADate.$this->ISATime);
		$eraHeader->__set('ISAControlNumber', $this->ISAControlNum);
		$eraHeader->__set('GS02SenderID', $this->GS02);
		$eraHeader->__set('GS03ReceiverID', $this->GS03);
		$eraHeader->__set('GSControlNumber', $this->GSConrolNum);
		$eraHeader->__set('VersionNumber', $this->Version);

		// Checking if file is 835 transaction
		if ($this->elements[1] != "835") throw new Exception("Invalid File.");
		$eraHeader->__set('STControlNumber', $this->elements[2]);
		$this->_counter = $this->_counter + 1;
		
		$stCondition = true;
		while ($stCondition) {
			$this->elements = explode($this->E, $this->segments[$this->_counter]);
			
			switch (trim($this->elements[0])) {
				// Check Information
				case "BPR":
					$eraHeader->__set('TransactionCode', $this->elements[1]);
					$eraHeader->__set('CheckAmount', $this->elements[2]);
					$eraHeader->__set('CreditDebitFlag', $this->elements[3]);
					$eraHeader->__set('PaymentMethod', $this->elements[4]);
					$eraHeader->__set('PaymentFormat', $this->elements[5]);
					$eraHeader->__set('CheckDate', $this->elements[16]);
					break;
				// Check Information
				case "TRN":
					$eraHeader->__set('CheckNumber', $this->elements[2]);
					$eraHeader->__set('PayerTrn', $this->elements[3]);
					break;
				
				// Production Date
				case "DTM":
					if ($this->elements[1] == "405")
						$eraHeader->__set('ProductionDate', $this->elements[2]);
					break;

				
				case "N1":
					// Payer Name, Ids, Address, City, State, Zip
					if ($this->elements[1] == "PR") {
						if (sizeof($this->elements) > 2)
							$eraHeader->__set('PayerName', $this->elements[2]);
						if (sizeof($this->elements) > 4) 
							$eraHeader->__set('PayerID', $this->elements[4]);
						$this->_counter = $this->_counter + 1;
						
						$n1PRCondtion = true;
						$contactType = '';
						while ($n1PRCondtion) {
							$this->elements = explode($this->E, $this->segments[$this->_counter]);
							switch (trim($this->elements[0])) {
								case "N3":
									$eraHeader->__set('PayerAddress', $this->elements[1]);
									break;
								case "N4":
									$eraHeader->__set('PayerCity', $this->elements[1]);
									$eraHeader->__set('PayerState', $this->elements[2]);
									$eraHeader->__set('PayerZip', $this->elements[3]);
									break;
								case "REF":
									if ($this->elements[1] == "2U") $eraHeader->__set('REF2U', $this->elements[2]);
									if ($this->elements[1] == "EO") $eraHeader->__set('REFEO', $this->elements[2]);
									break;
								case "PER":
									if ($this->elements[1] == "CX" && sizeof($this->elements) > 2 ) {
										$eraHeader->__set('PayerContactName', $this->elements[2]);
										if (sizeof($this->elements)>3 && $this->elements[3] == "TE") $eraHeader->__set('PayerTelephone', $this->elements[4]);
									}
									else if ($this->elements[1] == "BL") {
										if (sizeof($this->elements) > 2)
											$eraHeader->__set('PayerBillingContactName', $this->elements[2]);
										
										if (sizeof($this->elements) > 4 && $this->elements[3] == "TE") 
											$eraHeader->__set('PayerBillingTelephone', $this->elements[4]);
										else if (sizeof($this->elements) > 4 && $this->elements[3] == "EM") 
											$eraHeader->__set('PayerBillingEmail', $this->elements[4]);

										if (sizeof($this->elements) > 5) {
											if ($this->elements[5] == "TE") $eraHeader->__set('PayerBillingContactName', $this->elements[5]);
											else if ($this->elements[5] == "EM") $eraHeader->__set('PayerBillingEmail', $this->elements[5]);
										}
									}
									else if ($this->elements[1] == "IC" && sizeof($this->elements) > 4) {
										if ($this->elements[3] == "UR") $eraHeader->__set('PayerWebsite', $this->elements[4]);
									}
									break;

								case "LINE":
									if ($this->elements[1] == "TE") {
										$eraHeader->__set('PayerTelephone', $this->elements[2]);
										if (sizeof($this->elements) > 4 && $this->elements[3] == "EM") 
											$eraHeader->__set('PayerBillingEmail', $this->elements[4]);
									}
									break;
								case "N1":
									$this->_counter = $this->_counter - 1; $n1PRCondtion = false;
									break;
							}
						   if($n1PRCondtion) $this->_counter += 1;
						}
					}
					// Payee Name, Ids, Address, City, State, Zip
					else if ($this->elements[1] == "PE") {
						$eraHeader->__set('PayeeName', $this->elements[2]);
						if (sizeof($this->elements) >= 4) $eraHeader->__set('PayeeNPI', $this->elements[4]);
						$this->_counter = $this->_counter + 1;
						
						$n1PECondtion = true;
						while ($n1PECondtion)
						{
							$this->elements = explode($this->E, $this->segments[$this->_counter]);
							switch (trim($this->elements[0]))
							{
								case "N3":
									$eraHeader->__set('PayeeAddress', $this->elements[1]);
									break;
								case "N4":
									$eraHeader->__set('PayeeCity', $this->elements[1]);
									$eraHeader->__set('PayeeState', $this->elements[2]);
									$eraHeader->__set('PayeeZip', $this->elements[3]);
									break;
								case "REF":
									if ($this->elements[1] == "TJ") $eraHeader->__set('PayeeTaxID', $this->elements[2]);
									break;
								case "LX":
								case "CLP":
								case "PLB":
								case "SE":
									$this->_counter = $this->_counter - 1; $n1PECondtion = false;
									break;
							}
							if ($n1PECondtion) $this->_counter = $this->_counter + 1;
						}
					}
					break;

				case "LX":
					break;
				
				// Provider Level Detail like Total Claim Amount per provider
				case "TS3":
					$eraHeader->__set('ProviderID', $this->elements[1]);
                    $eraHeader->__set('FacilityCode', $this->elements[2]);
                    $eraHeader->__set('FiscalYear', $this->elements[3]);
                    $eraHeader->__set('ClaimCount', $this->elements[4]);
					$eraHeader->__set('TotalClaimAmount', $this->elements[5]);
					break;

				// Visit Payment Detail
				case "CLP":
					$eraVisit = new ERAVisitPayment();
					
					$eraVisit->__set('PatientControlNumber', $this->elements[1]);
					$eraVisit->__set('ClaimProcessedAs', $this->elements[2]);
					$eraVisit->__set('SubmittedAmt', $this->elements[3]);
					$eraVisit->__set('PaidAmt', $this->elements[4]);
					$eraVisit->__set('PatResponsibilityAmt', $this->elements[5]);
					$eraVisit->__set('ClaimFilingIndicator', $this->elements[6]);
					$eraVisit->__set('PayerControlNumber', $this->elements[7]);
					if (sizeof($this->elements) > 8) {
						$eraVisit->__set('FacilityCode', $this->elements[8]);
						$eraVisit->__set('ClaimFrequencyCode', $this->elements[9]);
					}
					$this->_counter = $this->_counter + 1;
					$clpCondtion = true;
					
					while ($clpCondtion) {
						$this->elements = explode($this->E, $this->segments[$this->_counter]);
						switch (trim($this->elements[0])) {
							
							case "CAS":
								// Writeoff, Adjustment Codes and amounts
								if ($this->elements[1] == "CO" || $this->elements[1] == "PI") {
									for ($cc = 3; $cc <= sizeof($this->elements); $cc += 3) {
										if ($this->elements[$cc - 1] == "45") 
											$eraVisit->__set('WriteOffAmt', $this->elements[$cc]);
										else if($eraVisit->__get('OtherAdjustmentCode1') == null) {
											$eraVisit->__set('OtherAdjustmentGroupCode1', $this->elements[1]);
											$eraVisit->__set('OtherAdjustmentCode1', $this->elements[$cc - 1]);
											$eraVisit->__set('OtherAdjustmentAmt1', $this->elements[$cc]);
										}
										else if ($eraVisit->__get('OtherAdjustmentCode2') == null)
										{
											$eraVisit->__set('OtherAdjustmentGroupCode2', $this->elements[1]);
											$eraVisit->__set('OtherAdjustmentCode2', $this->elements[$cc - 1]);
											$eraVisit->__set('OtherAdjustmentAmt2', $this->elements[$cc]);
										}
										else if ($eraVisit->__get('OtherAdjustmentCode3') == null)
										{
											$eraVisit->__set('OtherAdjustmentGroupCode3', $this->elements[1]);
											$eraVisit->__set('OtherAdjustmentCode3', $this->elements[$cc - 1]);
											$eraVisit->__set('OtherAdjustmentAmt3', $this->elements[$cc]);
										}
										else if ($eraVisit->__get('OtherAdjustmentCode4') == null)
										{
											$eraVisit->__set('OtherAdjustmentGroupCode4', $this->elements[1]);
											$eraVisit->__set('OtherAdjustmentCode4', $this->elements[$cc - 1]);
											$eraVisit->__set('OtherAdjustmentAmt4', $this->elements[$cc]);
										}
										else if ($eraVisit->__get('OtherAdjustmentCode5') == null)
										{
											$eraVisit->__set('OtherAdjustmentGroupCode5', $this->elements[1]);
											$eraVisit->__set('OtherAdjustmentCode5', $this->elements[$cc - 1]);
											$eraVisit->__set('OtherAdjustmentAmt5', $this->elements[$cc]);
										}
										else
										{
										}
									}
								}
								// Other Adjustments
								else if ($this->elements[1] == "OA") {
									if ($this->elements[2] == "23") 
										$eraVisit->__set('OtherAdjustmentAmt', $this->elements[3]);
								}
								// Patient Responsibility
								else if ($this->elements[1] == "PR") {
									if ($this->elements[2] == "1") 
										$eraVisit->__set('DeductableAmt', $this->elements[3]);
									else if ($this->elements[2] == "2") 
										$eraVisit->__set('CoInsuranceAmt', $this->elements[3]);
									else if ($this->elements[2] == "3") 
										$eraVisit->__set('CopayAmt', $this->elements[3]);

									if (sizeof($this->elements) > 5) {
										if ($this->elements[5] == "1") 
											$eraVisit->__set('DeductableAmt', $this->elements[6]);
										else if ($this->elements[5] == "2") 
											$eraVisit->__set('CoInsuranceAmt', $this->elements[6]);
										else if ($this->elements[5] == "3") 
											$eraVisit->__set('CopayAmt', $this->elements[6]);
									}
								}

								break;
							// Patient/Subscriber, Rendering Provider, Cross Over Payer names 
							case "NM1":
								if ($this->elements[1] == "QC"){
									$eraVisit->__set('SubscriberLastName', $this->elements[3]);
									$eraVisit->__set('SubscirberFirstName', $this->elements[4]);
									if (sizeof($this->elements) < 6) break;
									$eraVisit->__set('SubscriberMI', $this->elements[5]);
									$eraVisit->__set('SubscriberID', $this->elements[9]);
								}
								else if ($this->elements[1] == "74") { }
								else if ($this->elements[1] == "82"){
									$eraVisit->__set('RendPrvLastName', $this->elements[3]);
									$eraVisit->__set('RendPrvFirstName', $this->elements[4]);
									$eraVisit->__set('RendPrvMI', $this->elements[5]);
									$eraVisit->__set('RendPrvNPI', $this->elements[9]);
								}
								else if ($this->elements[1] == "TT") {
									$eraVisit->__set('CrossOverPayerName', $this->elements[3]);
									$eraVisit->__set('CrossOverPayerID', $this->elements[9]);
								}
								else if ($this->elements[1] == "IL") {
									$eraVisit->__set('SubscriberLastName', $this->elements[3]);
									$eraVisit->__set('SubscirberFirstName', $this->elements[4]);
									if (sizeof($this->elements) < 6) break;
									$eraVisit->__set('SubscriberMI', $this->elements[5]);
									$eraVisit->__set('SubscriberID', $this->elements[9]);
								}
								break;

							case "MIA":
								break;
							case "MOA":
								break;
								
							// Reference Ids
							case "REF":
								if ($this->elements[1] == "1L") {
									$eraVisit->__set('GroupOrPolicyNum', $this->elements[2]);
								}
								else if ($this->elements[1] == "CE") { }
								else if ($this->elements[1] == "EA") { }
								break;
							
							// Claim Statement dates
							case "DTM":
								if ($this->elements[1] == "232") 
									$eraVisit->__set('ClaimStatementFrom', $this->elements[2]);
								else if ($this->elements[1] == "233") 
									$eraVisit->__set('ClaimStatementTo', $this->elements[2]);
								else if ($this->elements[1] == "050") 
								$eraVisit->__set('ClaimReceivedDate', $this->elements[2]);
								break;
							
							// Visit Contact Number
							case "PER":
								$eraVisit->__set('ClaimContactNumber', $this->elements[2]);
								if ($this->elements[3] == "TE") $eraVisit->__set('ClaimTelephone', $this->elements[4]);
								break;
							
							// Visit Coverage Amount						
							case "AMT":
								if ($this->elements[1] == "AU") $eraVisit->__set('ClaimCoverageAmt', $this->elements[2]);
								break;
							
							// Charege Payments
							case "SVC":
									$eraCharge = new ERAChargePayment();
                                    //$svc01 = $this->elements[1].Split(C);
									$svc01 = explode($this->C, $this->elements[1]);
									
                                    $eraCharge->__set('CPTCode', $svc01[1]);
                                    if (sizeof($svc01) > 2) $eraCharge->__set('Modifier1', $svc01[2]);
                                    if (sizeof($svc01) > 3) $eraCharge->__set('Modifier2', $svc01[3]);
                                    if (sizeof($svc01) > 4) $eraCharge->__set('Modifier3',  $svc01[4]);
                                    if (sizeof($svc01) > 5) $eraCharge->__set('Modifier4',  $svc01[5]);
                                    if (sizeof($svc01) > 6) $eraCharge->__set('CPTDescription', $svc01[6]);
                                    $eraCharge->__set('SubmittedAmt',  $this->elements[2]);
                                    $eraCharge->__set('PaidAmt', $this->elements[3]);
                                    
                                    if(sizeof($this->elements) > 5)
                                        $eraCharge->__set('UnitsPaid', $this->elements[5]);

                                    $this->_counter += 1;
                                    $svcCondtion = true;
                                    $lqCounter = 0;
                                    while ($svcCondtion) {
                                        $this->elements = explode($this->E, $this->segments[$this->_counter]);
                                        switch (trim($this->elements[0])) {
                                            // DOS
											case "DTM":
                                                if ($this->elements[1] == "150") 
													$eraCharge->__set('ServiceDateFrom',$this->elements[2]);
                                                else if ($this->elements[1] == "151") 
													$eraCharge->__set('ServiceDateTo', $this->elements[2]);
                                                else if ($this->elements[1] == "472") 
													$eraCharge->__set('ServiceDateFrom',$this->elements[2]);
                                                break;

                                            case "CAS":
												// Writeoff, adjustments, amounts
                                                if ($this->elements[1] == "CO"|| $this->elements[1] == "PI") {
                                                    for ($cc = 3; $cc <= sizeof($this->elements); $cc += 3) {
														if(sizeof($this->elements) > $cc) {
															if ($this->elements[$cc - 1] == "45") $eraCharge->__set('WriteOffAmt', $this->elements[$cc]);
															else if ($eraCharge->__get('OtherAdjustmentCode1') == null) {
																$eraCharge->__set('OtherAdjustmentGroupCode1', $this->elements[1]);
																$eraCharge->__set('OtherAdjustmentCode1', $this->elements[$cc - 1]);
																$eraCharge->__set('OtherAdjustmentAmt1', $this->elements[$cc]);
															}
															else if ($eraCharge->__get('OtherAdjustmentCode2') == null) {
																$eraCharge->__set('OtherAdjustmentGroupCode2', $this->elements[1]);
																$eraCharge->__set('OtherAdjustmentCode2', $this->elements[$cc - 1]);
																$eraCharge->__set('OtherAdjustmentAmt2', $this->elements[$cc]);
															}
															else if ($eraCharge->__get('OtherAdjustmentCode3') == null) {
																$eraCharge->__set('OtherAdjustmentGroupCode3', $this->elements[1]);
																$eraCharge->__set('OtherAdjustmentCode3', $this->elements[$cc - 1]);
																$eraCharge->__set('OtherAdjustmentAmt3', $this->elements[$cc]);
															}
															else if ($eraCharge->__get('OtherAdjustmentCode4') == null) {
																$eraCharge->__set('OtherAdjustmentGroupCode4', $this->elements[1]);
																$eraCharge->__set('OtherAdjustmentCode4', $this->elements[$cc - 1]);
																$eraCharge->__set('OtherAdjustmentAmt4', $this->elements[$cc]);
															}
															else if ($eraCharge->__get('OtherAdjustmentCode5') == null) {
																$eraCharge->__set('OtherAdjustmentGroupCode5', $this->elements[1]);
																$eraCharge->__set('OtherAdjustmentCode5', $this->elements[$cc - 1]);
																$eraCharge->__set('OtherAdjustmentAmt5', $this->elements[$cc]);
															}
														}
                                                    }
                                                }
												// Other Adjustments
                                                else if ($this->elements[1] == "OA") {
                                                    if ($this->elements[2] == "23") $eraCharge->__set('OtherAdjustmentAmt', $this->elements[3]);
                                                }
												// Patient Resposibility
                                                else if ($this->elements[1] == "PR") {
                                                    if ($this->elements[2] == "1") $eraCharge->__set('DeductableAmt', $this->elements[3]);
                                                    else if ($this->elements[2] == "2") $eraCharge->__set('CoInsuranceAmt', $this->elements[3]);
                                                    else if ($this->elements[2] == "3") $eraCharge->__set('CopayAmt', $this->elements[3]);

                                                    if (sizeof($this->elements) > 5) {
                                                        if ($this->elements[5] == "1") $eraCharge->__set('DeductableAmt', $this->elements[6]);
                                                        else if ($this->elements[5] == "2") $eraCharge->__set('CoInsuranceAmt', $this->elements[6]);
                                                        else if ($this->elements[5] == "3") $eraCharge->__set('CopayAmt', $this->elements[6]);
                                                    }
                                                }
                                                break;
											// Charge Reference #
                                            case "REF":
                                                if ($this->elements[1] == "6R") 
													$eraCharge->__set('ChargeControlNumber', $this->elements[2]);
                                                break;
											// Allowed Amount
                                            case "AMT":
                                                if ($this->elements[1] == "B6") 
													$eraCharge->__set('AllowedAmount', $this->elements[2]);
                                                break;
											// Remark Codes
                                            case "LQ":
                                                if ($this->elements[1] == "HE") {
                                                    $lqCounter += 1;
                                                    if ($lqCounter == 1) $eraCharge->__set('RemarkCode1', $this->elements[2]);
                                                    if ($lqCounter == 2) $eraCharge->__set('RemarkCode2', $this->elements[2]);
                                                    if ($lqCounter == 3) $eraCharge->__set('RemarkCode3', $this->elements[2]);
                                                    if ($lqCounter == 4) $eraCharge->__set('RemarkCode4', $this->elements[2]);
                                                    if ($lqCounter == 5) $eraCharge->__set('RemarkCode5', $this->elements[2]);
                                                    if ($lqCounter == 6) $eraCharge->__set('RemarkCode6', $this->elements[2]);
                                                    if ($lqCounter == 7) $eraCharge->__set('RemarkCode7', $this->elements[2]);
                                                    if ($lqCounter == 7) $eraCharge->__set('RemarkCode8', $this->elements[2]);
                                                    if ($lqCounter == 9) $eraCharge->__set('RemarkCode9', $this->elements[2]);
                                                    if ($lqCounter == 10) $eraCharge->__set('RemarkCode10', $this->elements[2]);
                                                }
                                                break;
                                            case "SVC":
                                            case "CLP":
                                            case "SE":
                                            case "PLB":
                                                $this->_counter = $this->_counter - 1; $svcCondtion = false;
												// Adding the charge payment into array
												array_push($eraVisit->ERAChargePayments, $eraCharge);
                                                break;
                                        }
                                        if ($svcCondtion) $this->_counter = $this->_counter + 1;
                                    }
								break;

							case "SE":
							case "PLB":
							case "CLP":
								$this->_counter = $this->_counter - 1; $clpCondtion = false;
								// Adding the visit payment into array
								array_push($eraHeader->ERAVisitPayments, $eraVisit);
								break;
						}
						if ($clpCondtion) $this->_counter = $this->_counter + 1;
					}
					break;
				case "SE":
				case "GE":
				case "IEA":
					$this->_counter = $this->_counter - 1; $stCondition = false;
					// Adding the header payment into array
					array_push($this->ERAData, $eraHeader);
					break;
			}
			$this->_counter = $this->_counter + 1;
		}
	}		
}


        
    //Creating the parsing object
    $obj = new ERAParser();
    //Calling the Main Parsing Method. Pass the valid file path here.
    $obj->ParseERAFile('C:\Users\azizullah\Downloads\DrAutomatePayments\chargeFile.txt');

    // $obj->ERAData contains the list of EraHeader Object.
    // Era Header contains check information, payer information, payee inforamtion, provider amount
    // and a list of ERAVisitPayment.
    
    //list of ERAVisitPayment contains the payment information of all visits.
    foreach ($obj->ERAData as $checkData) {
       
       echo "************ CHECK INFORMATION ************ " . "\n" ;
       echo "Check Date "		. $checkData->__get('CheckDate').   	"\n" ;
       echo "Check # "			. $checkData->__get('CheckNumber'). 	"\n" ;
       echo "Check Amount "		. $checkData->__get('CheckAmount'). 	"\n" ;
       
       
       foreach ($checkData->ERAVisitPayments as $visitData) {
    	
    		echo "************ VISIT INFORMATION ************ " . "\n" ;
    	
    		echo "Claim. Cntrl # "		. $visitData->__get('PatientControlNumber')	. "\n" ;
    		echo "Payer Cntrl # "		. $visitData->__get('PayerControlNumber')	. "\n" ;
    		
    		echo "Submitted Amount "	. $visitData->__get('SubmittedAmt')			. "\n" ;
    		echo "Paid Amount "			. $visitData->__get('PaidAmt')				. "\n" ;
    		
    		echo "Patient Responsibility ". $visitData->__get('PatResponsibilityAmt')				. "\n" ;
    		
    		echo "Copay Amount "		. $visitData->__get('CopayAmt')				. "\n" ;
    		echo "Deductible Amount "	. $visitData->__get('DeductableAmt')		. "\n" ;
    		echo "CoIns. Amount "		. $visitData->__get('CoInsuranceAmt')		. "\n" ;
    		
    		foreach ($visitData->ERAChargePayments as $ChargeData) {
    		
    			echo "	************ CHARGE INFORMATION ************ " . "\n" ;
    	
    	        echo "Service line #    "      . $ChargeData->__get('ChargeControlNumber') . "\n";
    	        echo "Date of Service   "	. $ChargeData->__get('ServiceDateFrom')			. "\n" ;
    	        
    			echo "CPT/HCPCS/Clde  "		. $ChargeData->__get('CPTCode')	. "\n" ;
    			echo "Submitted Amount  "		. $ChargeData->__get('SubmittedAmt')	. "\n" ;
    			echo "Paid Amount "	. $ChargeData->__get('PaidAmt')			. "\n" ;
    			
    			echo "Copay Amount "		. $ChargeData->__get('CopayAmt')				. "\n" ;
    			echo "Deductible Amount "	. $ChargeData->__get('DeductableAmt')		. "\n" ;
    			echo "CoIns. Amount "		. $ChargeData->__get('CoInsuranceAmt')		. "\n" ;
    			
    			echo "Adjustment Group Code 1  "		. $ChargeData->__get('OtherAdjustmentGroupCode1')		. "\n" ;
				echo "Adjustment Code 1        "		. $ChargeData->__get('OtherAdjustmentCode1')		. "\n" ;
    			echo "Adjustment Amount 1      "		. $ChargeData->__get('OtherAdjustmentAmt1')		. "\n" ;
    			
    			echo "Adjustment Group Code 2  "		. $ChargeData->__get('OtherAdjustmentGroupCode2')		. "\n" ;
    			echo "Adjustment Code 2        "		. $ChargeData->__get('OtherAdjustmentCode2')		. "\n" ;
    			echo "Adjustment Amount 2      "		. $ChargeData->__get('OtherAdjustmentAmt2')		. "\n" ;
    			
    			
    			echo "Remark Code 1      "		. $ChargeData->__get('RemarkCode1')		. "\n" ;
    			echo "Remark Code 2      "		. $ChargeData->__get('RemarkCode2')		. "\n" ;
    			
    			
    		}
       }
    }
    
    
?>

</body>
</html>