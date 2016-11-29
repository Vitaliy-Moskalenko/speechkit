<?php

	error_reporting(E_ERROR | ~E_WARNING | ~E_NOTICE);
	
	include_once('inc/header.php');	
	include_once('yandexThemAll.php');	

	if(isset($_POST['send']) && $_POST['send'] == 1) {
		
		$dateStamp = date('ymd');		
		
		$filename = basename($_FILES['myfile']['name']);		
		$uploadfile = "upload/".$filename;
		
		if(copy($_FILES['myfile']['tmp_name'], $uploadfile)) echo '<h3 style="color:green;">Файл успешно загружен на сервер</h3>';
        else { echo '<h3 style="color:red;">Ошибка! Не удалось загрузить файл на сервер!</h3>'; exit; }
		
		$filepath = substr($_SERVER['SCRIPT_FILENAME'], 0, 22).$uploadfile;
		
		$postdata = array("project_name" => "test_project_1".$dateStamp,         
	                       "source_lang" => $_POST['lang'],   
				      //   "target_lang" => $_POST['dst'],
						   "upload" => "@".$filepath);
						   
						   
		$key = '91e3170c-3ffe-4c4a-9cb1-0f1daa7820b6';
		
		if(isset($_POST['format']) && $_POST['format'] == 'MP3') $format = 'Content-Type: audio/x-mpeg-3';
		else $format = 'Content-Type: audio/x-wav';		
		
		if(isset($_POST['lang'])) $lang = $_POST['lang'];
		else $lang = 'ru-RU';	
		
		recognize($uploadfile, $key, $lang, $format);
		echo '<h2>done..</h2>';				   
		
	}

    $filepath = substr($_SERVER['SCRIPT_FILENAME'], 0, 22);
	 
	 
?>


	<div id="page">

		<form method="POST" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" name="mc-uploader" id="mc-uploader">		
		    <input type="hidden" name="send" value="1" />
		    <input type="file" name="myfile" id="myFile" size="40" /><br/><br/>
		    <input type="hidden" name="project_name" value="my_test_project_1" />
			<input type="hidden" name="source_lang" value="en-US"  />
		<!--	<input type="hidden" name="target_lang" value="ru-RU"/>  -->
	 		<input type="submit" value="Распознать файл" />	
            <div class="langs">Язык файла для распознавания
				<select name="lang">
					<option>ru-RU</option>
					<option>en-US</option>
					<option>tr-TR</option>		
					<option>uk-UK</option>					
				</select>			
			</div>
			<div class="langs">Формат аудиофайла<br/>
				<select name="format">
					<option>WAV</option>
					<option>MP3</option>
				</select>			
			</div>  
	
		</form>
		
		<br/><br/><br/><br/><br/><br/><br/>			
		<a href="index.php">Home</a>
	
	</div>
	
	

</body></html>


<?php

	if(isset($strerr)) fclose($strerr);

?>