<?php
	function passwd($number, $valid_char, $len, $method, $random){
		$json = "{\"count\" : $number, \"password\" : [";
		$divider = "";
		for($i = 1; $i <= $number; $i++){
			$tmp = "";
			switch ($method){
				case 0:
					$tmp =  pass_1($valid_char, $len, $random);
					break;
				default:
					$tmp =  pass_1($valid_char, $len, $random);
					break;
			}
			$json .= "$divider\"$tmp\"";
			$divider = ",";

		}
		$json .= "]}";
		return $json;
	}

	function pass_1($valid_char, $len, $random){
		$tmp = "";
		$len = strlen($valid_char);
		for($i = 0; $i < $len; $i++){
			$tmp .= $valid_char[random(16, $random) % $len];
		}
		return $tmp;
		
	}
	function random($bit, $method){
		switch ($method){
			case 0:
				return random_1($bit);
				break;
			case 1:
				return random_2($bit);
				break;
			default:
				return random_1($bit);
				break;
		}
	}
	function random_1($bit){
		return rand(0, pow(2, $bit) - 1);
	}
	function random_2($bit){
		$tmp = 0;
		$c = 0;
		for($i = 0; $i < $bit; $i++){
			$r = rand(0,3);
			switch ($r){
				case 1 : 
					$tmp = $tmp * 2 ;
					break;
				case 2 : 
					$tmp = $tmp * 2 + 1 ;
					break;
				default :
					$i--;
					break;
			}
			$c++;
		}
		// echo $c."<br/>";
		return $tmp;
	
	}
	// echo passwd($POST, "0123456789", 6, 0, 1);
	$cur_time = microtime(true);
	$tmp = "";

	if(isset($_POST['number'], $_POST['valid_char'], $_POST['len'], $_POST['method'], $_POST['random']) 
   		&& ctype_digit($_POST['number'])
   		&& ctype_digit($_POST['len'])
   		&& ctype_digit($_POST['method'])
   		&& ctype_digit($_POST['random'])
	)
		$tmp = passwd(intval($_POST['number']), $_POST['valid_char'], intval($_POST['len']), intval($_POST['method']), intval($_POST['random']));
	else 
		$tmp = "{\"count\": 0, \"password\":[]}\n";

	echo "{\"time_ms\":".(microtime(true) - $cur_time).",\"data\":$tmp}\n"
?>
