<?php

//include "ClaimGenerator.php";

//Creating the EDI 837 Generation object

$generate = new \App\Http\Edi\ClaimGenerator();
$header = new \App\Http\Edi\ClaimHeader();
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

$claim = new \App\Http\Edi\ClaimData();
// Billing Provider\Practice\Facility
$claim->BillPrvOrgName = 'ABCOR HOME HEALTH';
$claim->BillPrvFirstName = '';
$claim->BillPrvEntityType = '2';
$claim->BillPrvNPI = '';				// this will be empty in your case

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
$charge1 = new \App\Http\Edi\ChargeData();
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

$charge2 = new \App\Http\Edi\ChargeData();

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
$claim2 = new \App\Http\Edi\ClaimData();
$claim2->BillPrvOrgName = 'ABC Provider';
$claim2->BillPrvNPI = '1111111111';
$claim2->BillPrvAddress1 = '89A ADDRESS';
$claim2->BillPrvCity = 'GLEN COVE';
$claim2->BillPrvState = 'NY';
$claim2->BillPrvZipCode = '12345';

// Commented this line, so that we get Validation Msg for your demonstration.
//$claim2->BillPrvTaxID = '000254123';

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


$charge1 = new \App\Http\Edi\ChargeData();
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

echo "Processed Claims: " . $output->ProcessedClaims . '</br>' ;

// 	Based on the Output, you can maintain the SubmissionHistoryLog (batch wise) with following columns
//	ID, Edi837FilePath, NumberOfClaims, Amount, Date etc.


// Check For Not Processed Claims, that are put on hold due to required data missing.
foreach ($output->ListOfClaims as $CLM)
{
	// If Processed is True, that means this claim has been included in the claim string.
	// You can mark the claim Processed in your system, based on this variable.
	if ($CLM->Processed)
	{
		echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Processed: ' . $CLM->Processed . ', Processed Date: ' . $CLM->ProcessedDate . '</br>';
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
			echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Validation Msg. ' . $CLM->ValidationMsg . '</br>';
	}
}


