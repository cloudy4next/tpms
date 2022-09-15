<?php

namespace App\Http\Edi;
include "ClaimHeader.php";
include "ClaimData.php";
include "ClaimOutput.php";

class ClaimGenerator
{

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

    function Generate837Transaction($Header, $Claims, $EDIFilePath)
    {

        $output = new ClaimOutput();

        if (is_null($Header) or is_null($Claims) or sizeof($Claims) == 0) {
            $output->ErrorMessage = 'Header, Claims or Charges can not be Empty.';
            return $output;
        } else if ($Header->ISA13CntrlNumber == '') {
            $output->ErrorMessage = "ISA13 Control Number can not be Empty.";
            return $output;
        } else if ($Header->ISA15UsageIndi == '') {
            $output->ErrorMessage = "ISA15 Usage Indicator can not be Empty.";
            return $output;
        }

        $ClaimSTR = '';
        $ClaimSTR .= $this->GenerateHeader($Header);

        foreach ($Claims as $CLM) {

            $msg = $this->Validate($Header, $CLM);
            if ($msg != '') {
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
            foreach ($CLM->ListOfChargesData as $CH) {
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


        if ($this->ProcessedClaims > 0) {
            $output->ProcessedClaims = $this->ProcessedClaims;
            $output->Transaction837 = $ClaimSTR;

            // Write the contents back to the file
            if ($EDIFilePath != '') {
                file_put_contents($EDIFilePath, $ClaimSTR);
            }
        }

        return $output;
    }

    function GenerateHeader($header)
    {

        $E = $this->E;
        $C = $this->C;
        $S = $this->S;
        $R = $this->R;

        $yyMMdd = date('ymd');
        $yyyyMMdd = date('Ymd');
        $hhmm = date('Hi', time());

        if ($header->ISA01AuthQual == '') $header->ISA01AuthQual = '00';
        $header->ISA02AuthInfo = str_pad($header->ISA02AuthInfo, 10, ' ', STR_PAD_RIGHT);
        if ($header->ISA03SecQual == '') $header->ISA01AuthQual = '00';
        $header->ISA04SecInfo = str_pad($header->ISA04SecInfo, 10, ' ', STR_PAD_RIGHT);
        if ($header->ISA05SenderQual == '') $header->ISA05SenderQual = 'ZZ';
        $header->ISA06SenderID = str_pad($header->ISA06SenderID, 15, ' ', STR_PAD_RIGHT);
        if ($header->ISA07ReceiverQual == '') $header->ISA07ReceiverQual = 'ZZ';
        $header->ISA08ReceiverID = str_pad($header->ISA08ReceiverID, 15, ' ', STR_PAD_RIGHT);

        $headerSTR = '';

        $headerSTR = 'ISA' . $E . $header->ISA01AuthQual . $E . $header->ISA02AuthInfo . $E .
            $header->ISA03SecQual . $E . $header->ISA04SecInfo . $E .
            $header->ISA05SenderQual . $E . $header->ISA06SenderID . $E .
            $header->ISA07ReceiverQual . $E . $header->ISA08ReceiverID . $E .
            $yyMMdd . $E . $hhmm . $E . $R . $E . '00501' . $E . $header->ISA13CntrlNumber . $E .
            '1' . $E . $header->ISA15UsageIndi . $E . $C . $S;

        $headerSTR .= 'GS' . $E . 'HC' . $E . $header->GS02SenderID . $E .
            $header->GS03ReceiverID . $E . $yyyyMMdd . $E . $hhmm . $E .
            $header->ISA13CntrlNumber . $E . 'X' . $E . '005010X222A1' . $S;

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

    function GenerateBillingProvider($CLM)
    {

        $bPrvSTR = '';
        $this->hlCounter += 1;
        $this->hlBPrvCounter = $this->hlCounter;

        $E = $this->E;
        $C = $this->C;
        $S = $this->S;
        $R = $this->R;

        $bPrvSTR .= 'HL' . $E . $this->hlCounter . $E . $E . '20' . $E . '1' . $S;
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

        $bPrvSTR .= 'N3' . $E . $CLM->BillPrvAddress1;
        if (trim($CLM->BillPrvAddressLine2) != '')
            $bPrvSTR .= $E . $CLM->BillPrvAddressLine2;
        $bPrvSTR .= $S;

        $bPrvSTR .= 'N4' . $E . $CLM->BillPrvCity . $E . $CLM->BillPrvState . $E . $CLM->BillPrvZipCode . $S;
        if ($CLM->BillPrvTaxID != '')
            $bPrvSTR .= 'REF' . $E . 'EI' . $E . $CLM->BillPrvTaxID . $S;
        else if ($CLM->BillPrvSSN != '')
            $bPrvSTR .= 'REF' . $E . 'SY' . $E . $CLM->BillPrvSSN . $S;

        if ($CLM->BillPrvTelephone != '')
            $bPrvSTR .= 'PER' . $E . 'IC' . $E . $CLM->BillPrvContactName . $E . 'TE' . $E . $CLM->BillPrvTelephone . $S;

        if ($CLM->BillPrvPayToAddr != '') {
            $bPrvSTR .= 'NM1' . $E . '87' . $E . '2' . $S;
            $bPrvSTR .= 'N3' . $E . $CLM->BillPrvPayToAddr;

            if (trim($CLM->BillPrvPayToAddrLine2) != '')
                $bPrvSTR .= $E . $CLM->BillPrvPayToAddrLine2;
            $bPrvSTR .= $S;

            $bPrvSTR .= 'N4' . $E . $CLM->BillPrvPayToCity . $E . $CLM->BillPrvPayToState . $E . $CLM->BillPrvPayToZip . $S;
        }

        return $bPrvSTR;
    }

    function GenerateClaim($CLM)
    {

        $E = $this->E;
        $C = $this->C;
        $S = $this->S;
        $R = $this->R;

        $claimSTR = '';
        $lxCounter = 0;

        $this->hlCounter += 1;
        $this->hlSbrCounter = $this->hlCounter;
        $hl04 = '';
        if ($CLM->PatientRelationShip == '18')
            $hl04 = '0';
        else $hl04 = '1';

        $claimSTR .= 'HL' . $E . $this->hlCounter . $E . $this->hlBPrvCounter . $E . '22' . $E . $hl04 . $S;
        $claimSTR .= 'SBR' . $E . $CLM->ClaimType . $E . $CLM->PatientRelationShip . $E . $CLM->SbrGroupNumber . $E . $CLM->SbrGroupName
            . $E . $CLM->SbrMedicareSecTypeV . $E . $E . $E . $E . $CLM->PayerType . $S;

        $claimSTR .= 'NM1' . $E . 'IL' . $E . '1' . $E . $CLM->SBRLastName . $E . $CLM->SBRFirstName . $E . $CLM->SBRMiddleInitial . $E . $E . $E . 'MI' . $E . $CLM->SBRID . $S;

        $claimSTR .= 'N3' . $E . $CLM->SBRAddress;
        if (trim($CLM->SBRAddressLine2) != '')
            $claimSTR .= $E . $CLM->SBRAddressLine2;
        $claimSTR .= $S;


        $claimSTR .= 'N4' . $E . $CLM->SBRCity . $E . $CLM->SBRState . $E . $CLM->SBRZipCode . $S;

        if ($CLM->SBRDob != '')
            $claimSTR .= 'DMG' . $E . 'D8' . $E . $CLM->SBRDob . $E . $CLM->SBRGender . $S;
        if ($CLM->SBRSSN != '')
            $claimSTR .= 'REF' . $E . 'SY' . $E . $CLM->SBRSSN . $S;

        $claimSTR .= 'NM1' . $E . 'PR' . $E . '2' . $E . $CLM->PayerName . $E . $E . $E . $E . $E . 'PI' . $E . $CLM->PayerID . $S;
        if ($CLM->PayerAddress != '') {
            $claimSTR .= 'N3' . $E . $CLM->PayerAddress;
            if (trim($CLM->PayerAddressLine2) != '')
                $claimSTR .= $E . $CLM->PayerAddressLine2;
            $claimSTR .= $S;

            $claimSTR .= 'N4' . $E . $CLM->PayerCity . $E . $CLM->PayerState . $E . $CLM->PayerZipCode . $S;
        }
        if ($CLM->BillPrvSecondaryID != '')
            $claimSTR .= 'REF' . $E . 'G2' . $E . $CLM->BillPrvSecondaryID . $S;

        if ($CLM->PatientRelationShip != '18') {
            $this->hlCounter += 1;
            $claimSTR .= 'HL' . $E . $this->hlCounter . $E . $this->hlSbrCounter . $E . '23' . $E . '0' . $S;
            $claimSTR .= 'PAT' . $E . '19' . $S;
            $claimSTR .= 'NM1' . $E . 'QC' . $E . '1' . $E . $CLM->PATLastName . $E . $CLM->PATFirstName;
            if ($CLM->PATMiddleInitial != '')
                $claimSTR .= $E . $CLM->PATMiddleInitial;
            $claimSTR .= $S;
            $claimSTR .= 'N3' . $E . $CLM->PATAddress;
            if (trim($CLM->PATAddressLine2) != '')
                $claimSTR .= $E . $CLM->PATAddressLine2;
            $claimSTR .= $S;

            $claimSTR .= 'N4' . $E . $CLM->PATCity . $E . $CLM->PATState . $E . $CLM->PATZipCode . $S;
            $claimSTR .= 'DMG' . $E . 'D8' . $E . $CLM->PATDob . $E . $CLM->PATGender . $S;
        }

        $claimSTR .= 'CLM' . $E . $CLM->PatientControlNumber . $E . $CLM->ClaimAmount . $E . $E . $E
            . $CLM->POSCode . $C . 'B' . $C . $CLM->ClaimFreqCode . $E . 'Y' . $E . 'A' . $E . 'Y' . $E . 'Y';
        if ($CLM->AccidentType != '') {
            $claimSTR .= $E . $E . $CLM->AccidentType;
            if ($CLM->AccidentState != '')
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

        if ($CLM->ReferralNumber != '')
            $claimSTR .= 'REF' . $E . '9F' . $E . $CLM->ReferralNumber . $S;
        if ($CLM->PriorAuthNumber != '')
            $claimSTR .= 'REF' . $E . 'G1' . $E . $CLM->PriorAuthNumber . $S;
        if ($CLM->PayerClaimCntrlNum != '')
            $claimSTR .= 'REF' . $E . 'F8' . $E . $CLM->PayerClaimCntrlNum . $S;
        if ($CLM->CliaNumber != '')
            $claimSTR .= 'REF' . $E . 'X4' . $E . $CLM->CliaNumber . $S;

        if ($CLM->MedicalRecordNumber != '')
            $claimSTR .= 'REF' . $E . 'EA' . $E . $CLM->MedicalRecordNumber . $S;

        if ($CLM->ClaimNotes != '')
            $claimSTR .= 'NTE' . $E . 'ADD' . $E . $CLM->ClaimNotes . $S;

        $claimSTR .= 'HI' . $E . 'ABK' . $C . str_replace('.', '', $CLM->ICD1Code);
        if ($CLM->ICD2Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD2Code);
        if ($CLM->ICD3Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD3Code);
        if ($CLM->ICD4Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD4Code);
        if ($CLM->ICD5Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD5Code);
        if ($CLM->ICD6Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD6Code);
        if ($CLM->ICD7Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD7Code);
        if ($CLM->ICD8Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD8Code);
        if ($CLM->ICD9Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD9Code);
        if ($CLM->ICD10Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD10Code);
        if ($CLM->ICD11Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD11Code);
        if ($CLM->ICD12Code != '') $claimSTR .= $E . 'ABF' . $C . str_replace('.', '', $CLM->ICD12Code);

        $claimSTR .= $S;

        //HI    -   Anesthesia related
        //HCP   -   $claimSTR Pricing/Reprincing info

        if ($CLM->RefPrvLastName != '') {
            $claimSTR .= 'NM1' . $E . 'DN' . $E . '1' . $E . $CLM->RefPrvLastName . $E . $CLM->RefPrvFirstName . $E . $CLM->RefPrvMI . $E . $E . $E . 'XX' . $E . $CLM->RefPrvNPI . $S;
        }
        if ($CLM->RendPrvLastName != '') {
            $rendEntity = '';
            if ($CLM->RendPrvFirstName != '') $rendEntity = '1';
            else $rendEntity = '2';

            $claimSTR .= 'NM1' . $E . '82' . $E . $rendEntity . $E . $CLM->RendPrvLastName;
            if ($CLM->RendPrvNPI != '')
                $claimSTR .= $E . $CLM->RendPrvFirstName . $E . $CLM->RendPrvMI . $E . $E . $E . 'XX' . $E . $CLM->RendPrvNPI;
            else if ($CLM->RendPrvLastName != '')
                $claimSTR .= $E . $CLM->RendPrvFirstName;
            $claimSTR .= $S;

            if ($CLM->RendPrvTaxonomy != '') $claimSTR .= 'PRV' . $E . 'PE' . $E . 'PXC' . $E . $CLM->RendPrvTaxonomy . $S;
            if ($CLM->RendPrvSecondaryID != '') $claimSTR .= 'REF' . $E . 'G2' . $E . $CLM->RendPrvSecondaryID . $S;
        }
        if ($CLM->LocationOrgName != '') {
            $claimSTR .= 'NM1' . $E . '77' . $E . '2' . $E . $CLM->LocationOrgName;
            if ($CLM->LocationNPI != '') $claimSTR .= $E . $E . $E . $E . $E . 'XX' . $E . $CLM->LocationNPI;
            $claimSTR .= $S;
            if ($CLM->LocationAddress != '') {
                $claimSTR .= 'N3' . $E . $CLM->LocationAddress;
                if (trim($CLM->LocationAddressLine2) != '')
                    $claimSTR .= $E . $CLM->LocationAddressLine2;
                $claimSTR .= $S;

                $claimSTR .= 'N4' . $E . $CLM->LocationCity . $E . $CLM->LocationState . $E . $CLM->LocationZip . $S;
            }
        }
        if ($CLM->SuperPrvLastName != '') {
            $claimSTR .= 'NM1' . $E . 'DQ' . $E . '1' . $E . $CLM->SuperPrvLastName . $E . $CLM->SuperPrvFirstName . $E . $CLM->SuperPrvMI . $E . $E . $E . 'XX' . $E . $CLM->SuperPrvNPI . $S;
        }

        //SECONDARY $claimSTR
        if ($CLM->ClaimType == 'S') {
            $claimSTR .= 'SBR' . $E . 'P' . $E . $CLM->OtherSBRPatRelationV . $E . $CLM->OtherSBRGroupNumber . $E . $CLM->OtherSBRGroupName
                . $E . $E . $E . $E . $E . $CLM->PayerType . $S;

            $claimSTR .= 'AMT' . $E . 'D' . $E . $CLM->PrimaryPaidAmt . $S;
            $claimSTR .= 'OI' . $E . $E . $E . 'Y' . $E . $E . $E . 'Y' . $S;
            $claimSTR .= 'NM1' . $E . 'IL' . $E . '1' . $E . $CLM->OtherSBRLastName . $E . $CLM->OtherSBRFirstName . $E . $CLM->OtherSBRMI . $E . $E . $E . 'MI' . $E . $CLM->OtherSBRId . $S;
            if ($CLM->OtherSBRAddress != '') {
                $claimSTR .= 'N3' . $E . $CLM->OtherSBRAddress;
                if (trim($CLM->OtherSBRAddressLine2) != '')
                    $claimSTR .= $E . $CLM->OtherSBRAddressLine2;
                $claimSTR .= $S;

                $claimSTR .= 'N4' . $E . $CLM->OtherSBRCity . $E . $CLM->OtherSBRState . $E . $CLM->OtherSBRZipCode . $S;
            }
            $claimSTR .= 'NM1' . $E . 'PR' . $E . '2' . $E . $CLM->OtherPayerName . $E . $E . $E . $E . $E . 'PI' . $E . $CLM->OtherPayerID . $S;
            if ($CLM->OtherPayerAddress != '') {
                $claimSTR .= 'N3' . $E . $CLM->OtherPayerAddress;
                if (trim($CLM->OtherPayerAddressLine2) != '')
                    $claimSTR .= $E . $CLM->OtherPayerAddressLine2;
                $claimSTR .= $S;

                $claimSTR .= 'N4' . $E . $CLM->OtherPayerCity . $E . $CLM->OtherPayerState . $E . $CLM->OtherPayerZipCode . $S;
            }
            $claimSTR .= 'REF' . $E . 'F8' . $E . $CLM->PayerClaimCntrlNum . $S;
        }
        //
        $this->ProcessedClaims += 1;

        return $claimSTR;
    }

    function GenerateCharge($CH, $CLM)
    {
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

        if ($CH->DateofServiceFrom != '' and $CH->DateOfServiceTo != '' and $CH->DateofServiceFrom != $CH->DateOfServiceTo)
            $ChargeSTR .= 'DTP' . $E . '472' . $E . 'RD8' . $E . $CH->DateofServiceFrom . '-' . $CH->DateOfServiceTo . $S;
        else
            $ChargeSTR .= 'DTP' . $E . '472' . $E . 'D8' . $E . $CH->DateofServiceFrom . $S;

        $ChargeSTR .= 'REF' . $E . '6R' . $E . $CH->LineItemControlNum . $S;
        if ($CH->ServiceLineNotes != '') $ChargeSTR .= 'NTE' . $E . 'ADD' . $E . $CH->ServiceLineNotes . $S;

        if ($CH->DrugNumber != '') $ChargeSTR .= 'LIN' . $E . $E . 'N4' . $E . $CH->DrugNumber . $S;
        if ($CH->DrugCount != '') $ChargeSTR .= 'CTP' . $E . $E . $E . $E . $CH->DrugCount . $E . $CH->DrugUnit . $S;


        if ($CLM->ClaimType == 'S') {
            $ChargeSTR .= 'SVD' . $E . $CLM . OtherPayerID . $E . $CH->PrimaryPaidAmt . $E . 'HC' . $C . $CH->PrimaryCPT;

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
                $ChargeSTR .= 'CAS' . $E . 'CO' . $E . '45' . $E . $CH->PrimaryWriteOffAmt . $S;

            if ($CH->PrimaryDeductable . Amt() != 0 && $CH->PrimaryCoIns . Amt() != 0)
                $ChargeSTR .= 'CAS' . $E . 'PR' . $E . '1' . $CH->PrimaryDeductable . $E . '1' . $E . '2' . $E . $CH->PrimaryCoIns . '1' . S;
            else if ($CH->PrimaryDeductable . Amt() != 0)
                $ChargeSTR .= 'CAS' . $E . 'PR' . $E . '1' . $E . $CH->PrimaryDeductable . $E . '1' . $S;
            else if ($CH->PrimaryCoIns . Amt() != 0)
                $ChargeSTR .= 'CAS' . $E . 'PR' . $E . '2' . $E . $CH->PrimaryCoIns . $E . '1' . $S;

            if ($CH->PrimaryPaidDate != '')
                $ChargeSTR .= 'DTP' . $E . '573' . $E . 'D8' . $E . $CH->PrimaryPaidDate . $S;
        }

        $dt = date('Y-m-d\TH:i:sP');

        $CH->Processed = true;
        $CH->ProcessedDate = $dt;

        $CLM->Processed = true;
        $CLM->ProcessedDate = $dt;

        return $ChargeSTR;
    }

    function GenerateTrailer($Header)
    {
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


    function Validate($Header, $CLM)
    {
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
        else if ($CLM->PatientRelationShip != "18") {
            if ($CLM->PATLastName == '' or $CLM->PATFirstName == '')
                $msg = "Patient Name is requried";
            else if ($CLM->PATAddress == '' or $CLM->PATCity == '' or $CLM->SBRState == ''
                or $CLM->PATZipCode == '')
                $msg = "Patient Address, City, State and Zip Code are required";
        }

        if ($msg != '')
            return $msg;

        foreach ($CLM->ListOfChargesData as $CH) {
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





