<?
$TOKEN_ID='45963c3df2dca5449364065a46df68698f2a9916da1451dd2902e0b99a293fadcb306f8be8c974ef31e5e232';

# Staging Token 0adddba0844125469eb72bfba2169a42e2d9ed1726b4350d44c8505d71dbf10bb2f7437785a753e3ddba718b';
$DEMO_CALLER_ID='4074181800';
$host = "localhost";
$user = "voxeo_demo";
$pass = "voxeo_demo";
$db = "voxeo_demo";


function getCoordinates($l){
	$dataCenters = array(
		'vegas' => 	array('lat'=>36.14364,	'long'=>-115.07673),
		'london'=>	array('lat'=>51.52257,	'long'=>-0.61712),
		'orlando'=>	array('lat'=>28.54420,	'long'=>-81.37911),
		'atlanta'=>	array('lat'=>33.75544,	'long'=>-84.39158),
		'beijing'=>	array('lat'=>39.90549,	'long'=>116.22296),
		'hardrock'=>array('lat'=>28.476299,'long'=>-81.464867),
		'frankfurt'=>array('lat'=>50.09661,'long'=>8.64349)
		);
	return $dataCenters[strtolower($l)];
}

function connectDB(){
	global $host,$user,$pass,$db,$connection,$db;	
	
	$connection = mysql_connect($host, $user, $pass) 
		  	or die("Could not connect to host.");
		
	$db_selected = mysql_select_db($db, $connection) 
		  	or die("Could not find database.");
}

function newCall($mySessionID,$phoneNumber,$playerName,$flashPhone){
	global $DEMO_CALLER_ID,$TOKEN_ID;
	connectDB();
	if( ($playerName==null)||($phoneNumber==null)||($mySessionID==null)){
		return "error";
	}
	$query = sprintf("INSERT INTO sessions (id,location,phoneNumber,playerName) VALUES 	('%s','%s','%s','%s')",
	mysql_real_escape_string($mySessionID), 
	mysql_real_escape_string("hardrock"),
	mysql_real_escape_string($phoneNumber),
	mysql_real_escape_string(urldecode($playerName))
	);
	$result = mysql_query($query);
	$ch = curl_init('http://api.voxeo.net/CCXML10.start?tokenid='.$TOKEN_ID.'&mySessionID='.$mySessionID.'&callerID='.$DEMO_CALLER_ID.'&phoneNumber='.$phoneNumber.'&playerName='.$playerName.'&flashPhone='.$flashPhone);
	curl_exec ($ch);
	curl_close ($ch);
}

	function recordExists($mySessionID){
		connectDB();
		$returnVar;
		$sql="SELECT * FROM sessions WHERE id='".$mySessionID."'";
			$query = mysql_query($sql);	
				if(mysql_num_rows($query)){
					$returnVar= true;
					}else{
						$returnVar= false;
					}
				mysql_free_result($query);
				return $returnVar;
	}

function updateLocation($location,$mySessionID){
	connectDB();
	$sql = "UPDATE sessions SET location='".$location."' WHERE id='".$mySessionID."'";
		$query =	mysql_query($sql);
		if (!$query) {
			return "error";
		}
		return $query;
}

function getLocation($mySessionID){
		connectDB();
		$sql = "SELECT location from sessions WHERE id='".$mySessionID."'";
		$result=mysql_query($sql);
		if (!$result) {
			return "error";
		}
		$r=mysql_fetch_assoc($result);
		return $r['location'];
}
?>