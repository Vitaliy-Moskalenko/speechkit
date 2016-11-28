<?php

	if(isset($_POST['send']) && $_POST['send'] == 1) {
		
		$stderr = fopen('errlog.txt', 'w');
		
		$filename = basename($_FILES['myfile']['name']);
		$uploadfile = "upload/".$filename;
		
		if(copy($_FILES['myfile']['name'], $uploadfile)) echo '<h3 style="color:green;">Файл успешно загружен на сервер</h3>';
        else { echo '<h3 style="color:red;">Ошибка! Не удалось загрузить файл на сервер!</h3>'; exit; }
		
		$filepath = substr().$uploadfile;
		
		$postdata = array("project_name" => "test_project_1".$dateStamp,         
	                       "source_lang" => $_POST['src'],   
						//   "target_lang" => $_POST['dst'],
						   "upload" => "@".$filepath);
		
	}

     $filepath = substr($_SERVER['SCRIPT_FILENAME'], 0, 22);

    echo "<h2>".$_SERVER['SCRIPT_FILENAME']."</h2>";
	echo "<h2>$filepath</h2>";
	 
	 
	 
	 
	 
?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<!--  <script type="text/javascript" src="js/jquery.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="css/large.css" /> 
<head><body>

	<div id="page">

		<form method="POST" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" name="mc-uploader" id="mc-uploader">		
		    <input type="hidden" name="send" value="1" />
		    <input type="file" name="myfile" id="myFile" size="40" /><br/><br/>
		    <input type="hidden" name="project_name" value="my_test_project_1" />
			<input type="hidden" name="source_lang" value="en-US"  />
			<input type="hidden" name="target_lang" value="ru-RU"/> 
	 		<input type="submit" value="Распознать файл" />	
            <div class="langs">Язык файла для распознавания
				<select name="src">
					<option>ru-RU</option>
					<option>en-US</option>
					<option>tr-TR</option>		
					<option>uk-UK</option>					
				</select>			
			</div>
		<!--	<div class="langs">Язык перевода
				<select name="dst">
					<option>ru-RU</option>
					<option>en-US</option>
					<option>fr-FR</option>				
				</select>			
			</div>  -->
	
		</form>
		
		<br/><br/><br/><br/><br/><br/><br/>			
		<a href="index.php">Home</a>
	
	</div>
	
	

</body></html>


<?php

	if(isset($strerr)) fclose($strerr);

?>