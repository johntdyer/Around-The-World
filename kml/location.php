<kml xmlns="http://earth.google.com/kml/2.0">
<Document>
<?
include ('../lib/functions.php');

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$mySessionID = $_GET['mySessionID'];
	//Generate a marker at Latitude: 32, Longitude: -110, called Demo, with description: This is a demo
#		generateMarker($arrayVar[0], "Voxeo Data Center",getCoordinates(strtolower($arrayVar[0])));
generateMarker(getLocation($mySessionID), "Voxeo Data Center",getCoordinates(getLocation($mySessionID)));
//Below is code for an overlay, and under that is the function that generates the Placemark
?>
<ScreenOverlay>
  <description><![CDATA[ <a href="http://kaaosa.com">Kaaosa.com</a> is back! ]]></description>
  <name>Voxeo.com</name>
  <Icon>
    <href>http://demos.voxeo.com/roundTheWorld/img/voxeo.gif</href>
  </Icon>
  <visibility>1</visibility>
	<refreshInterval>2</refreshInterval>
	<viewRefreshMode>onInterval</viewRefreshMode>
	<viewRefreshTime>2</viewRefreshTime>
  <overlayXY x="0" y="1" xunits="fraction" yunits="fraction"/>
  <screenXY x="0" y="1" xunits="fraction" yunits="fraction"/>
</ScreenOverlay>

</Document>
</kml>

<?
//Function to generate user markers
function generateMarker($title, $desc, $coordinates) { ?>

<Placemark>
  <description><![CDATA[ <? echo $desc; ?> ]]></description>
  <name><? echo $title; ?></name>
  <LookAt>
    <longitude><? echo $coordinates['long']; ?></longitude>
    <latitude><? echo $coordinates['lat']; ?></latitude>
    <range>50.00</range>
    <tilt>50</tilt>
    <heading>0</heading>
		<altitude>5000</altitude>
  </LookAt>
  <Point>
    <coordinates><? echo $coordinates['long'].",".$coordinates['lat']; ?></coordinates>
  </Point>
</Placemark>
<? } ?>

