<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Around The World in 80 Seconds, Kinda</title>
		<LINK href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/growl.css">	
		<link href="css/phono.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="http://www.google.com/jsapi?hl=en&amp;key=ABQIAAAAmT4HTUYKdvGqcdPCdYMIchSp2RdxVNDznV5ZBnMxyVSemJikNhQlGWMzvqUgCzpjEK67J9TDS4FqyA"></script>
		<script src="js/kml.js" type="text/javascript" charset="utf-8"></script>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js"></script>	
		<script type="text/javascript" src="lib/FABridge.js"></script>
		<script type="text/javascript" src="lib/flashembed.min.js"></script>
		<script type="text/javascript" src="lib/phono.js"></script>
		<script src="js/jQueryCookie.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jQueryGUID.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.growl.js" type="text/javascript"></script>
		<script src="js/jquery.sound.js" type="text/javascript"></script>
		
		<script type="text/javascript" charset="utf-8">
		var number="";
		var phoneRegistered=false;

		mySessionID=document.guid;
		
		$(document).ready(function(){
					$.Growl.show({
						'title'  : "Welcome",
						'message': "Please key in your number and press start",
						'icon'   : "voxeo",
						"speed": 500,
						'timeout': 15000
					});
			$(".digit").click(function(){
				if((number.length+1)>13){
					console.log("Warning: To many digits keyed in");
					//Growl alert more then 10 digits
					$.Growl.show({
						'title'  : "Warning",
						'message': "To many digits, only ten digits (407)867-5309",
						'icon'   : "warning",
						"speed": 500,
						"timeout": 1500
					});

					$("#phone-screen").text(formatDisplay(this.number));
					return false;
				}else{
					number+=$(this).attr("name");
					console.log("Keypad Input-> " + number);
					$("#phone-screen").text(formatDisplay(number));	
					return false;
				}
				return false;
			});
			
			window.setInterval(function() {
				try {
						if(call != null) {
							//$("#callState").text(call.state());  // Maybe put this on screen?
							// Using Growl now
						}
					}
					catch(e) {
						window.console.log("ERROR " + e);
					}
					},500);
		});
		
		function startGame(){
			if(!phoneRegistered){
					$.Growl.show({
						'title'  : "Error",
						'message': "Phone is not registered to network yet",
						'icon'   : "error",
						"speed": 500,
						"timeout": 3000
					});
			}else{
				if(number.length==13)
				{
					mySessionID=document.guid;
					URL = 'http://demos.voxeo.com/roundTheWorld/kml/kml.php?mySessionID='+mySessionID
						$("kml-url").val(document.URL);
							phoneNumber=fetchDisplay(number);  // Cleans up phone number (407)4740214 => 4074740214
							playerName =  $('#playerName').val();
								if(document.guid!=null)	$.get('api/api.php', { mySessionID: mySessionID,playerName: playerName,phoneNumber: phoneNumber,flashPhone: flashPhone,action: "new" } );
							$.Growl.show({
									'title'  : "Started",
									'message': "The Voxeo hosted Network is now calling you ",
									'icon'   : "voxeo",
									"speed": 500,
									"timeout": 3000
							});
						buttonClick();
				}	else 
				{
					$.Growl.show({
						'title'  : "Error",
						'message': "Not enough digits in phone number",
						'icon'   : "error",
						"speed": 500,
						"timeout": 3000
					});
				}
			}
		}
		function pageLoad(){
			init();
			if(document.guid==null){
				document.guid = jQuery.Guid.Value();
				window.console.log("Player SessionID: " + document.guid);
			}
		}
</script>
</head>
	<body onLoad="pageLoad();">
		<div id="header">
			<img src="img/atwheader2.png">
		</div>
		<div id="content">
			<div id="phone01" style="height: 1px; width: 1px; background-color:#000;"></div>
			<script type="text/javascript" charset="utf-8">
				var call;
				var phone = $.phono({
														flashElementId:"phone01",
														onConnect: function(event) {
															//window.console.log("callback connected");
															flashPhone=event.phone.sessionId;
															phoneRegistered=true;
																$.sound.play('audio/rings/Twinkles.wav');
																// Grown Alert
																$.Growl.show({
																	'title'  : "Ready",
																	'message': "Phone is now registered on Voxeo's Network",
																	'icon'   : "voxeo",
																	"speed": 500,
																	"timeout": 3000
																});
														},
														onFlashPermissionShow: function(event){
															//$('phone01').css	 MAKE DIV BIGGER
														},	
														onFlashPermissionHide: function(event){
															// MAKE DIV SMALLER
														},
														onIncomingCall: function(event) {
															call = event.call;
															// Ring Tone?
															call.answer();
														//	ring = $.sound.play('audio/rings/ring.wav');   // Need to edit ring
															$.Growl.show({
																'title'  : "Call",
																'message': "Inbound Call (Auto Answer On)",
																'icon'   : "voxeo",
																"speed": 500,
																"timeout": 2000
															});
														}
													});
/*
													function makeCall() {
														numberToDial = $("#destinationTxt").val();
														window.console.log("dialing " + numberToDial);
															call = phone.dial(numberToDial, {
																pushToTalk: true,
																headers: {
																	foo:"bar",
																	bling:"blaz"
																},
																onAnswer: function(event) {
																	window.console.log("callback answered");
																},
																onHangup: function() {
																	window.console.log("callback hangup");
																}
															});
															window.console.log(call);
														}
*/
														function replaceAll(text, strA, strB){
															while ( text.indexOf(strA) != -1){
																text = text.replace(strA,strB);
															}
															return text;
														}
															
														function formatDisplay(i){
																if(i.length==3){
																	number='('+number+')';
																	return number;
																}else if(i.length==8){
																	number=number+'-';
																	return number;
																}
																return i;
															}
															
														function fetchDisplay(str){
															console.log("Input" + str);
															text=replaceAll(replaceAll(str,"(",""),")","");
															r = text.replace("-","");
															console.log("Output" + r);
															return r;
														}
				</script>

				<div id="dialer">
					<div id="phone">
						<div id="phone-screen">
		 					<span id="callState"></span>
						</div>
			<div id="middle"></div>
	<div class="digit-hldr">
		<a href="#" name="1" class="digit"> <span class="number">1</span></a>
		<a href="#" name="2" class="digit"> <span class="number">2</span><br/><span class="abc">ABC</span></a>
		<a href="#" name="3" class="digit"> <span class="number">3</span><br/><span class="abc">DEF</span></a>                
		<a href="#" name="4" class="digit"> <span class="number">4</span><br/><span class="abc">GHI</span></a>
		<a href="#" name="5" class="digit"> <span class="number">5</span><br/><span class="abc">JKL</span></a>
		<a href="#" name="6" class="digit"> <span class="number">6</span><br/><span class="abc">MNO</span></a>                
		<a href="#" name="7" class="digit"> <span class="number">7</span><br/><span class="abc">PQRS</span></a>
		<a href="#" name="8" class="digit"> <span class="number">8</span><br/><span class="abc">GHI</span></a>
		<a href="#" name="9" class="digit"> <span class="number">9</span><br/><span class="abc">WXYZ</span></a>                
		<a href="#" name="*" class="digit"> <span class="number">*</span></a>
		<a href="#" name="0" class="digit"> <span class="number">0</span><br/><span class="abc">+</span></a>
		<a href="#" name="#" class="digit"> <span class="number">#</span></a>
		<br class="clearfix"/>
	</div>
		<div class="control-hldr">
			<a href="#" class="control-btn call" onClick="startGame();"><span>Start</span></a>
			<a href="http://www.voxeo.com" target="_blank" title="www.Voxeo.com" class="logo-icon"></a>
			<a href="#" class="control-btn talk"><span>Talk</span></a>
			<br class="clearfix"/>
		</div>
	</div>
	</div>
					<form action="#" method="get" name="startForm" accept-charset="utf-8">
					<div id="hidden">
					</br>
					<input type="text" id="playerName"	value="John"	/>Your Name
					<input type="hidden" name="kml" id="kml-url" size="50" value=""><br>
				</form>
				</div>				
				<div id="map">
					
				<div id="map3d" style="border: 1px solid silver; width: 1150px; height: 584px;"></div>
				    <div id="hidden"<div>Installed Plugin Version: <span id="installed-plugin-version" style="font-weight: bold;">Loading...</span></div></div>
				</div>
				<!-- </br>
				</br></br></br></br></br></br></br></br></br></br> 
				Yar har fiddle dee dee do what you want because a pirate is free -->
		</div>
</body>
</html>
