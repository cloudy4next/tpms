<?php

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
$header->SubmitterOrgName = 'TEST HOME HEALTH';
$header->SubmitterID = '101410';    	// ASIGNED BY ZIMRED

$header->SubmitterContactName = 'IT SUPERVISOR';
$header->SubmitterTelephone = '8470008291';
$header->SubmitterEmail = '';
// 
$header->ReceiverOrgName = 'ZIRMED';
$header->ReceiverID = 'ZIRMED';

// USE IT AS FALSE.
$header->RelaxNpiValidation = true;		// Set this true, because in your case NPI is not used.

// Claim 1 Data -   Subscriber and Patient is SAME
// Secondary Claim

$claim = new ClaimData();
// Billing Provider\Practice\Facility
$claim->BillPrvOrgName = 'TEST HOME HEALTH';
$claim->BillPrvFirstName = '';
$claim->BillPrvEntityType = '2';
$claim->BillPrvNPI = '1234567890';				// this will be empty in your case

// Practice\Billing Provider Address
$claim->BillPrvAddress1 = '3201 N WILKE RD';
$claim->BillPrvAddressLine2 = ' ';
$claim->BillPrvCity = 'UNKNOWN HEIGHTS';
$claim->BillPrvState = 'IL';
$claim->BillPrvZipCode = '600040000';

// Billing Provider Tax ID\EIN
$claim->BillPrvTaxID = '203030111';

// Billing Provider Secondary ID
$claim->BillPrvSecondaryID = '401030600902';		// copied from your edi file

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
// For Secondary Claim = 'S'
// For Primary Claim = 'P'
$claim->ClaimType = 'S';
$claim->SbrGroupNumber = '';

// If claim is Secondary, then here Secondary Subscriber/Insured Name should be set
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
// If claim is Secondary, then here Secondary Payer Name should be set
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


// primary Subscriber Relation Ship With Patient
// 18 for self
$claim->OtherSBRPatRelationV = '18';
// primary Subscriber Group Number
$claim->OtherSBRGroupNumber = '';
// Other Subscriber Group Name
$claim->OtherSBRGroupName = '';
// Other Payer Type
$claim->OtherPayerTypeValue = 'CI';

// Primary Paid Amount
$claim->PrimaryPaidAmt = '30';
	

// Primary Subscriber Name, Address
$claim->OtherSBRLastName = 'TENKE';
$claim->OtherSBRFirstName= 'JOHN';
$claim->OtherSBRMI= '';
$claim->OtherSBRId= '890653812';
$claim->OtherSBRAddress= '20 LEUCE PL';
$claim->OtherSBRAddressLine2= '';
$claim->OtherSBRCity= 'GLEN COVE';
$claim->OtherSBRState= 'NY';
$claim->OtherSBRZipCode= '11542';

// Primary Payer Name
$claim->OtherPayerName = 'SECONDARY PAYER NAME';
// Primary Payer ID
$claim->OtherPayerID = '66208';
// Pimary Payer Address
$claim->OtherPayerAddress = 'SEC PAYER';
$claim->OtherPayerAddressLine2 = '';
$claim->OtherPayerCity = 'CITY';
$claim->OtherPayerState = 'NY';
$claim->OtherPayerZipCode = '12345';


// For Secondary Visit: Set Payer Claim Control Number -> This would be received from 835
$claim->PayerClaimCntrlNum = '423432424';


// Service Lines
$charge1 = new ChargeData();
$charge1->CptCode = '9989M';      // CPT
$charge1->ChargeAmount = 100;    // Charge Amount
$charge1->Units = '1';           // Units
$charge1->Pointer1 = '1';         // Pointer 1
$charge1->Pointer2 = '';         // Pointer 2
$charge1->Pointer3 = '';         // Pointer 3
$charge1->Pointer4 = '';         // Pointer 4
$charge1->POS = '';             // POS - Don't set if, POS is same of All Charges and same with Claim POS
$charge1->DateofServiceFrom = '20190706';      // Date of Service
$charge1->DateOfServiceTo = '';
$charge1->LineItemControlNum = '5853175';        // Charge Control Number - Unique Number - Era Payment will be mapped with this.
$charge1->LIDescription = 'HOMEMAKER SERVICES';	// this is used in your case for few types of visits.


// Primary Paid Amount against the CPT
	$charge1->PrimaryPaidAmt = 30;
	// Primary CPT\HCPCS Code
	$charge1->PrimaryCPT = '9989M';
	// Primary Modifier 1
	$charge1->PrimaryMod1 = '';
	// Primary Modifier 2
	$charge1->PrimaryMod2 = '';
	// Primary Modifier 3
	$charge1->PrimaryMod3 = '';
	// Primary Modifier 4
	$charge1->PrimaryMod4 = '';
	// Primary Paid Units
	$charge1->PrimaryUnits = '1';
	// Primary WriteOff AMount
	$charge1->PrimaryWriteOffAmt = '20';
	// Primary Other WriteOff Amount
	// Primary Co Insurance
	$charge1->PrimaryCoIns = '';
	// Primary Deductible
	$charge1->PrimaryDeductable = '50';
	// Primary Adjudicated Quantity
	// Primary Paid Amount
	$charge1->PrimaryPaidDate = '20190806';
	
    // Adding Claim's Charges into List
    array_push($claim->ListOfChargesData, $charge1);
    
    // Adding Claims into Claims List
    array_push($listOfClaims, $claim);


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
