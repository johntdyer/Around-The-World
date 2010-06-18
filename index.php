<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<title>Demo</title>
	<LINK href="css/style.css" rel="stylesheet" type="text/css">
<!--	<script type="text/javascript" src="http://www.google.com/jsapi?hl=en&amp;key=ABQIAAAAmT4HTUYKdvGqcdPCdYMIchRI67tzt4RgYf9_Oo6dkCFUpwfw1BS0ItGt6lkqTLG-jMDGkI63EPoFRw"></script>   advancsolutions.com key -->	
		<script type="text/javascript" src="http://www.google.com/jsapi?hl=en&amp;key=ABQIAAAAmT4HTUYKdvGqcdPCdYMIchSyNaptjNy8GpH-izRmsBnlJuK4MxRc7IxgCFeZ7alyNbmYJ0NQEQDQpg"></script>
		<script src="js/kml.js" type="text/javascript" charset="utf-8"></script>
	
	<!-- Phone -->
	
	<link href="css/phono.css" rel="stylesheet" type="text/css" /> 
	<link type="text/css" rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/redmond/jquery-ui.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js"></script>	
	<script type="text/javascript" src="lib/FABridge.js"></script>
	<script type="text/javascript" src="lib/flashembed.min.js"></script>
	<script type="text/javascript" src="lib/phono.js"></script>
	<script src="js/jQueryCookie.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jQueryGUID.js" type="text/javascript" charset="utf-8"></script>

	

	
	<script type="text/javascript" charset="utf-8">




		var number="";

		$(document).ready(function(){
			
			$(".digit").click(function(){
				if((number.length+1)>10){
					console.log("more then 10 digits");
					alert("10 digit number 4075551212")
					return false;
					$("#screen").val(this.number);
				}else{
					number+=$(this).attr("name");
					console.log(number);
					$("#screen").val(number);	
				}
				return false;
			});
			
			window.setInterval(function() {
          try {
              $("#screen").text(phone.state());
              if(call != null) {
                  $("#callState").text(call.state());  // Maybe put this on screen?
              }
          }
          catch(e) {
              window.console.log("ERROR " + e);
          }
      },500);


		});
		
		
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


	<body onLoad="pageLoad();">
		<div id="header">
<!--		<img src="img/atwheader2.png">-->
		</div>
    
		<div id="content">
			<div id="phone01" style="height: 10px; width: 10px"></div>
			<script type="text/javascript" charset="utf-8">
				   var call;
		        var phone = $.phono({
		            flashElementId:"phone01",
		            onConnect: function(event) {
		                window.console.log("callback connected");
		                $("#sessionId").text(event.phone.sessionId);

		            },
								onFlashPermissionShow: function(event){
			//					$('phone01').css	 MAKE DIV BIGGER
								},	
								onFlashPermissionHide: function(event){
									// MAKE DIV SMALLER
								},
		            onIncomingCall: function(event) {
		                call = event.call;
		            }
		        });

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
			</script>

      Call State <span id="callState"></span><br/>
      Session ID <span id="sessionId"></span><br/>
				<div id="dialer">

					<div id="phone">
					
					<script type="text/javascript" charset="utf-8">
					
					</script>
					
	<div id="phone-screen">
		<textarea col="10" rows="1" type="text" id="screen"> </textarea>
	</div>
	<div class="digit-hldr">
<!--		<a href="#" onClick="addValue('1');return false;" name="1" class="digit"><span class="number">1</span></a>-->
		<a href="#" name="1" class="digit" onClick="call.digit('1')"> <span class="number">1</span></a>
		<a href="#" name="2" class="digit" onClick="call.digit('2')"> <span class="number">2</span><br/><span class="abc">ABC</span></a>
		<a href="#" name="3" class="digit" onClick="call.digit('3')"> <span class="number">3</span><br/><span class="abc">DEF</span></a>                
		<a href="#" name="4" class="digit" onClick="call.digit('4')"> <span class="number">4</span><br/><span class="abc">GHI</span></a>
		<a href="#" name="5" class="digit" onClick="call.digit('5')"> <span class="number">5</span><br/><span class="abc">JKL</span></a>
		<a href="#" name="6" class="digit" onClick="call.digit('6')"> <span class="number">6</span><br/><span class="abc">MNO</span></a>                
		<a href="#" name="7" class="digit" onClick="call.digit('7')"> <span class="number">7</span><br/><span class="abc">PQRS</span></a>
		<a href="#" name="8" class="digit" onClick="call.digit('8')"> <span class="number">8</span><br/><span class="abc">GHI</span></a>
		<a href="#" name="9" class="digit" onClick="call.digit('9')"> <span class="number">9</span><br/><span class="abc">WXYZ</span></a>                
		<a href="#" name="*" class="digit" onClick="call.digit('0')"> <span class="star">*</span></a>
		<a href="#" name="0" class="digit" onClick="call.digit('*')"> <span class="number">0</span><br/><span class="abc">+</span></a>
		<a href="#" name="#" class="digit" onClick="call.digit('#')"> <span class="number">#</span></a>
		<br class="clearfix"/>
	</div>
		<div class="control-hldr">
			<a href="#" class="control-btn call"><span>Start</span></a>

       
			<a href="http://www.voxeo.com" target="_blank" title="www.Voxeo.com" class="logo-icon"></a>
			<a href="#" class="control-btn talk"><span>Talk</span></a>
			<br class="clearfix"/>
		</div>
					<input type="button" value="Accept" onClick="call.answer()"/>
					</div>
			</div>
					<form action="#" method="get" name="startForm" accept-charset="utf-8">
          <input type="text" id="sessionId">					
					<div id="hidden">
					<input type="text" id="flashPhone" value="4074740214"	/> <- Flash Phone
					Your Number
					</br>
					<input type="text" id="phoneNumber" name="phoneNumber" value="4079154335"	/> 
					<input type="text" id="playerName"	value="John"	/>Your Name
					<input type="hidden" name="kml" id="kml-url" size="50" value=""><br>
					<input type="submit" id="buttonspan" onClick="startGame()" value="Call Me &rarr; "></div>
				</form>
				</div>
				
				<div id="map">
				<div id="map3d" style="border: 1px solid silver; width: 1350px; height: 584px;"></div>
				    <div id="hidden"<div>Installed Plugin Version: <span id="installed-plugin-version" style="font-weight: bold;">Loading...</span></div></div>
				</div>
				<!-- </br>
				</br>
				</br>
				</br>
				</br>
				</br>
				</br>
				</br>
				</br>
				</br>
				</br> 
				Yar har fiddle dee dee do what you want because a pirate is free --!>
		</div>
</body>
</html>
