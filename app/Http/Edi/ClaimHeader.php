<?php
namespace App\Http\Edi;
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

	// GS02 - Application Sender�s Code
	public $GS02SenderID;
	// GS03 - Application Receiver�s Code
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

