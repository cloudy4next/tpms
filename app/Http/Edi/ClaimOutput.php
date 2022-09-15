<?php
namespace App\Http\Edi;
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

