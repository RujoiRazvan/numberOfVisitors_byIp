<!DOCTYPE html >
<head>
	<title>Test website visitor counter</title>
</head>
<body bgcolor="#99CC99">
	<?php 
	date_default_timezone_set("Europe/Bucharest");
	$counterToday = fopen("counterToday.txt", "r+"); 
	$counterTotal = fopen("counterTotal.txt", "r+");
	if(!$counterToday){ 
			echo "could not open the file" ; 
		} else { 
			$counter = ( int ) fread ($counterToday,20) ; 
		
			$ipRazvan = 1548808798;
			//echo $ipRazvan;
			//echo "\n";
			$ipClient = ip2long(getUserIpAddr());
			//echo $ipClient;
			if($ipRazvan == $ipClient){
			    $counter++ ; 
			    $ipFile = fopen("ip.txt", "a");
			    fwrite($ipFile,"\n");
			    fwrite($ipFile, long2ip($ipClient));
			    fwrite($ipFile, " ");
			    fwrite($ipFile,date("Y.m.d"));
			    fwrite($ipFile, " ");
			    fwrite($ipFile,date("h:i:sa"));
			    fclose($ipFile);
			}
			//echo " <strong> Numar de vizitatori astazi: ". $counter . " </strong > " ; 
			$counterToday = fopen("counterToday.txt", "w" ) ; 
			fwrite($counterToday, $counter);
			fclose($counterToday);
			$minute = date("i");
            $ora = date("h");
            $counterToday = fopen("counterToday.txt", "r");
            $totalNumber =  fgets($counterTotal);
            $todayNumber = fgets($counterToday);
            //echo " <strong> Numar de vizitatori in total: ". $totalNumber . " </strong > " ; 
            $minute = date("i");
            $ora = date("H");
            if($ora >= 23 && $minute >= 59){
                $counter = 0;
                $TotalNou = $totalNumber + $todayNumber;
                //echo $TotalNou;
                fclose($counterTotal);
                $counterTotal = fopen("counterTotal.txt", "w+");
                fwrite($counterTotal, $TotalNou);
                $zero = 0;
                fclose($counterToday);
                $counterToday = fopen("counterToday.txt", "c");
                fwrite($counterToday, 0);
                fclose($counterToday);
            }
	} 
    function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
    }
?>  
	<h1>Test Website visitor counter by IP</h1> </body>
</html>
