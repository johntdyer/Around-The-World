<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<title>Demo</title>
	<LINK href="css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://www.google.com/jsapi?hl=en&amp;key=ABQIAAAAmT4HTUYKdvGqcdPCdYMIchRI67tzt4RgYf9_Oo6dkCFUpwfw1BS0ItGt6lkqTLG-jMDGkI63EPoFRw"></script>
	<script src="js/kml.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
		google.load("jquery", "1.4.2");
	</script>
	
	<script src="js/jQueryCookie.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jQueryGUID.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript" charset="utf-8">
		mySessionID=document.guid;
		
		function startGame(){
			mySessionID=document.guid;
			URL = 'http://advancsolutions.com/demo/kml/kml.php?mySessionID='+mySessionID
			$("kml-url").val(document.URL);
			phoneNumber =  $('#phoneNumber').val();
			playerName =  $('#playerName').val();
			flashPhone =  $('#flashPhone').val();
			if(document.guid!=null){
				$.get('api/api.php', { mySessionID: mySessionID,playerName: playerName,phoneNumber: phoneNumber,flashPhone: flashPhone,action: "new" } );
			}
			buttonClick();
		}
		
		function pageLoad(){
			init();
			if(document.guid==null){
				document.guid = jQuery.Guid.Value();	
			}
		}
</script>

</head>


	<body onload="pageLoad();">

		<div id="header">
		<div id="headertext">
			<p>Around the World</p>
		</div>
		</div>

		<div id="left-sidebar">
				<form action="#" method="get" name="startForm" accept-charset="utf-8">

					<img src="img/fake_phone.png">
					<p><input type="text" id="flashPhone" value="4074740214"	/> <- Flash Phone
					<p><input type="text" id="phoneNumber" name="phoneNumber" value="4079154335"	/> Your Number
					<p><input type="text" id="playerName"	value="John"	/>Your Name
						
					<p><input type="hidden" name="kml" id="kml-url" size="50" value=""><br>
					<p><input type="submit" onclick="startGame()" value="Call Me &rarr;"></p>
				</form>
			</div>

			<div id="content">
				<div id="map3d" style="border: 1px solid silver; width: 1350px; height: 584px;"></div>
				    <div>Installed Plugin Version: <span id="installed-plugin-version" style="font-weight: bold;">Loading...</span></div>
			</div>
</body>
</html>
