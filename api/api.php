<html>
<head>
	<script type="text/javascript" src="http://www.google.com/jsapi?hl=en&amp;key=ABQIAAAAmT4HTUYKdvGqcdPCdYMIchRI67tzt4RgYf9_Oo6dkCFUpwfw1BS0ItGt6lkqTLG-jMDGkI63EPoFRw"></script>	
	<script type="text/javascript" charset="utf-8">google.load("jquery", "1.4.2");</script>
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
//			startCall($mySessionID,$phoneNumber,$playerName,$flashPhone);
			
			?>
			<script type="text/javascript" charset="utf-8">
				//$.get('http://session.voxeo.net/CCXML10.start', { tokenid: '0adddba0844125469eb72bfba2169a42e2d9ed1726b4350d44c8505d71dbf10bb2f7437785a753e3ddba718b', callerid: "4074181800", mySessionID: '<? echo $mySessionID; ?>',phoneNumber: '<? echo $phoneNumber; ?>',playerName: '<?echo $playerName; ?>',flashPhone: '<?echo $flashPhone; ?>' } );
			//	$.get('api/api.php', { mySessionID:mySessionID,playerName: playerName,phoneNumber:phoneNumber,flashPhone:flashPhone,action:"new" } );
				
			</script>
			<?
		}elseif($_GET['action']=='update'){
			updateLocation($location,$mySessionID);
		}
	}else{
		echo "Required parameters missing";
	}
?>
</head>
<body>
		</body>
		</html>
