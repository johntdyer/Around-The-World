<html>
<head>
<?
//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include ('../lib/functions.php');

		if(isset($_GET['mySessionID'])){
		
		$mySessionID=$_GET['mySessionID'];
		$playerName=$_GET['playerName'];
		$phoneNumber=$_GET['phoneNumber'];
		$location=$_GET['location'];
		$flashPhone=$_GET['flashPhone'];
		
		if($_GET['action']=='new'){
			newCall($mySessionID,$phoneNumber,$playerName,$flashPhone);

		}elseif($_GET['action']=='update'){
			updateLocation($location,$mySessionID);

		}
	}else{
		$r = "Required parameters missing";
	}
?>
</head>
<body>
<?	
if($r!=""){
	echo $r;
} 
?>
</body>
</html>
