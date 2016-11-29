<?php

	if(!function_exists('curl_file_create')) {		
		function curl_file_create($filename, $mimetype = '', $postname = '') {
			return "@$filename;filename=".($postname ?  : basename($filename)).($mimetype ? ";type=$mimetype" : '');			
		}		
	}


	function generateRandomSelection($min, $max, $counter) {
		
		$result = array();
		if($min > $max) return $result;
		$counter = min(max($counter, 0), $max-$min+1);
		
		while(count($result) < $counter) {
		
			$val = rand($min, $max-count($result));			
			foreach($result as $used) 
				if($used <= $val) $val++; 
				else break;
			
			$result[] = dechex($val);
			sort($result);				
		
		}
		
		shuffle($result);
		
		return $result;
	}
	
	
	function recognize($file, $key, $lang, $format) {
		
	/*	$uuid = generateRandomSelection(0, 30, 64);
		$uuid = implode($uuid);
		$uuid = implode($uuid);
		$uuid = substr($uuid,1,32); */
		
		$stderr = fopen('errlog.txt', 'w');

		$curl = curl_init();
		$url = 'https://asr.yandex.net/asr_xml?'.http_build_query(array(
			'key'=>$key,
		 // 'uuid' => $uuid,
			'uuid' => 'f1a213cb755628b58fb536d496daa1e6',
			'topic' => 'queries',
			'lang'=>$lang
		));
		
		curl_setopt($curl, CURLOPT_STDERR, $stderr);
		curl_setopt($curl, CURLOPT_URL, $url);
		$data = file_get_contents(realpath($file));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: audio/x-wav'));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array($format));
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		
		$response = curl_exec($curl);
		$err = curl_errno($curl);
		curl_close($curl);
    
		if ($err)
			throw new exception("curl err $err");
		echo $response;		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	