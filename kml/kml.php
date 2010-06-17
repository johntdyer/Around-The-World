<? echo('<?xml version="1.0" encoding="UTF-8"?>'); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<kml xmlns="http://www.opengis.net/kml/2.2">
		<NetworkLink>
			<name>Data Centers</name>
			<open>1</open>
			<refreshVisibility>1</refreshVisibility>
			<flyToView>1</flyToView>
			<Link>
				<href>http://advancsolutions.com/demo/kml/location.php</href>
				<cookie>mySessionID=<?echo $_GET['mySessionID'] ;?></cookie>				
				<httpQuery>mySessionID=<?echo $_GET['mySessionID'] ;?></httpQuery>
				<refreshInterval>2</refreshInterval>
				<viewRefreshMode>onStop</viewRefreshMode>
				<viewRefreshTime>1</viewRefreshTime>
			</Link>
		</NetworkLink>
</kml>