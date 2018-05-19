<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Buy Your Way to a Better Education!</title>
		<link href="buyagrade.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php
			$nameErr = $sectionErr =$cardErr =" ";
			$name = $section= $creditcard = $cardT =" ";

			if($_SERVER["REQUEST_METHOD"] == "POST"){

				if(empty($_POST ['name'])){
					$nameErr = "Name is required";

				}else{
					$name = test_input($_POST['name']);
					if(!preg_match("/^[a-zA-Z ]*$/", $name)){
						$nameErr="Only letters and white space allowed";
						echo $nameErr;
					}
				}
			
				if(empty($_POST['section'])){
					$sectionErr="Section is required";
					echo $sectionErr;
				}else{
					$section = test_input($_POST['section']);
					
				}

				if(empty($_POST['creditcard'])){
					$creditcard="Creditcard is required";
					$cardT ="Creditcard type is required";
				}
				else{
					$creditcard= test_input($_POST['creditcard']);
					$cardT = test_input($_POST['cardT']);
				
				}
			}

			function test_input($data) {
  			$data = trim($data);
 			$data = stripslashes($data);
  			$data = htmlspecialchars($data);
  			return $data;
  			
			}

		?>

		<?php
			if(empty($_POST['name']) && empty($_POST['section']) && empty($_POST['creditcard']) && empty($_POST['cardT'])){
					echo "<a href='tryAgain.html'>";
					echo "</a>";	
			}
			else{
				echo "<h1> Thanks, sucker!</h1>";
				echo "<p>Your information has been recorded.</p>";
				
				echo "<p>Name </p>";
				echo $name;
				echo "<p>Section</p>";
				echo $section;
				echo "<p>Creditcard</p>";
				echo $creditcard;
				echo "(" . $cardT . ")";

				echo "<h3> Here are all the suckers who have submitted here: </h3>";
				
				$suckersFile = fopen("suckers.txt", "a+");
				if(!file_exists("suckers.txt")){
					echo "File not found";
					return;
				}

				if($_POST){
					$name=$_POST['name'];
					$section=$_POST['section'];
					$creditcard=$_POST['creditcard'];
					$cardT=$_POST['card'];
					file_put_contents('suckers.txt', $name . ";" . $section .
						";" . $creditcard . ";" . $cardT . "\n" , FILE_APPEND);
				}

				$file = file('suckers.txt');

				echo "<table border='0'>";
				foreach($file as $row){
					$row = explode(' ', $row);
					echo "<tr>";

					 foreach ($row as $data) {
					 	echo "<td>" . $data . "</td>";
					 }
					 echo "</tr>";
				}

				echo "</table>";
			}

		?>

		<!--<?php
			/*echo "<h1> Thanks, sucker!</h1>";
			echo "<p>Your information has been recorded.</p>";
			
			echo "<p>Name </p>";
			echo $name;
			echo "<p>Section</p>";
			echo $section;
			echo "<p>Creditcard</p>";
			echo $creditcard;
			echo "(" . $cardT . ")";

			echo "<h3> Here are all the suckers who have submitted here: </h3>";
			
			$suckersFile = fopen("suckers.txt", "a+");
			if(!file_exists("suckers.txt")){
				echo "File not found";
				return;
			}

			if($_POST){
				$name=$_POST['name'];
				$section=$_POST['section'];
				$creditcard=$_POST['creditcard'];
				$cardT=$_POST['card'];
				file_put_contents('suckers.txt', $name . ";" . $section .
					";" . $creditcard . ";" . $cardT . "\n" , FILE_APPEND);
			}

			$file = file('suckers.txt');

			echo "<table border='0'>";
			foreach($file as $row){
				$row = explode(' ', $row);
				echo "<tr>";

				 foreach ($row as $data) {
				 	echo "<td>" . $data . "</td>";
				 }
				 echo "</tr>";
			}

			echo "</table>";*/
			
		?>-->
	</body>
</html>