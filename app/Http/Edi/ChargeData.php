<?php
namespace App\Http\Edi;
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

