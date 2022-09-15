Hi,

Here is the details on this project.
We have following classes in this project. 

ClaimHeader			=> 	Data\Feilds Class, In Which We are setting Submitter\Receiver Level Feilds
ClaimData			=> 	Data\Feilds Class, In Which We are setting Claim Level Feilds
ChargeData			=> 	Data\Feilds Class, In Which We are setting Server Line Level Feilds

ClaimGenerator		=>	Main Class, whose functions you will call for EDI File Generation.
						It has following function that will be used to generate the file.
						
						Generate837Transaction($Header, $Claims, $EDIFilePath)
						
						$Header			=>	Instance of ClaimHeader
						$Claims 		=>	List of ClaimData Instance
						$EDIFilePath 	=>	Output File Path, where EDI File will be saved.
					
ClaimTest.php
=============
Please go through this file, I have given the example of how to use it.
It has all the details.
					
					
ClaimOutput			=>	This is the output object, that you will receive.
						
						This Class has following feilds
						
						public $Transaction837  		// This is the EDI Transaction (Final Output, that will sent to Payer\Clearing House)
						public $ErrorMessage;			// This Feild, tells us if there is any Error. Error Means Nothing happens succesfully. 
														// You will have to fix Erorr Msg.
						
						public $ProcessedClaims = 0;	// ProcessedClaims, Means how many claims are present in EDI File.

						// Array of ClaimResult Object
						public $ListOfClaims = array();	// This list will show the status of Each Claim, that you have sent for EDI Generation
	
						public $ValidationMsg;			// Validation Message, that will be due to missing information
						public $PatientControlNumber;	// Patient Control Number - Identifier of Claim

						public $Processed;				// If Processed = true, it means it has been included in EDI File
														// If it is false, it will have ValidationMsg
						public $ProcessedDate;			// ProcessedDate, time at which it is processed

