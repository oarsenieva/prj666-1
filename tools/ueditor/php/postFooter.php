<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$data = $_POST['data'];

		$clientId = $_POST['clientid'];
		$fileUrl = "../../../companyInfo/footer/".$clientId.".txt";

		$myfile = fopen($fileUrl, "w");
		fwrite($myfile, $data);
		fclose($myfile);

		echo "Your About us page has been update";
	}else{
		echo "Your page has not been updated due to some errors";
	}
?>