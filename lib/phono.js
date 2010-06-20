(function($) {

	function isNull(check, def) {
		if(check==null) {
			return def;
		}
		else {
			return check;
		}
	}
	
	function wrapCall(phone, $flash, options) {
		
		var call = {};
		
		call = {
			to: options.to,
			dispatcher: $(call),
			$flash: $flash,
			state: function() {
				return call.$flash.getState();
			},
			bind: function(name, listeners) {
				call.dispatcher.bind(name, listeners);
			},
			unbind: function(name, listeners) {
				call.dispatcher.unbind(name, listeners);
			}
		};
		
		$.each(["answer","accept","hangup","digit"], function(i, name) {
			call[name] = function() {
			    var args = [];
			    for ( var i=0; i<arguments.length; i++ ) {
			        args.push(arguments[i]);
			    }
				call.$flash.call(name, args);
			}
		});
		
		$.each(["talking","muted","hold","volume"], function(i, name) {
			call[name] = function(value) {
				if(arguments.length == 0) {
					window.console.log("call get: " + name);
					return call.$flash.get(name);
				}
				else {
					window.console.log("call set: " + name + "=" + value);
					call.$flash.set(name, value);
				}
			}
		});
		
		$.each(options, function(k,v) {
			if(k.match("^on")) {
				call.bind(k.substr(2).toLowerCase(), v);
			}
			else if(k == "headers") {
			}
			else {
				call.$flash.set(k,v);
			}
		});
		
		call.$flash.addEventListener(null, function(event) {
	        call.dispatcher.trigger($.extend({
	            call: call,
	            phone: phone,
	            reason: event.getReason()
	        }, $.Event(event.getType().toLowercase())),[call]);
		});	
		
		return call;
	}
	
	jQuery.phono = function(options) {
		
		var DEFAULT_GATEWAY = "gordon112.orl.voxeo.net";
		
		var phone = {};
		
		phone = {
			dispatcher: $(phone),
			connect: function(server) {
				this.$flash.connect(isNull(server, DEFAULT_GATEWAY));
			},
			bind: function(name, listeners) {
				phone.dispatcher.bind(name, listeners);
			},
			unbind: function(name, listeners) {
				phone.dispatcher.unbind(name, listeners);
			},
			state: function() {
				return phone.$flash?phone.$flash.getState():"initializing";
			},
			text: function(to, body) {
				return phone.$flash.text(to, body);
			},
			dial: function(to, options) {
				options = isNull(options,{});
				options.to = to;
				var call = wrapCall(phone, phone.$flash.createCall(), options);
				call.$flash.start();
				return call;
			}
		};
		
    	phone.bind("connect", function(event) {
    		window.console.log("session id = " + wrapper.getSessionId());
    		phone.sessionId = wrapper.getSessionId();
    	});
    	
		$.each(options, function(k,v) {
			if(k.match("^on")) {
				phone.bind(k.substr(2).toLowerCase(), v)
			}
			else {
				phone[k] = v;
			}
		});
		
		var bridgeId = phone.flashElementId;
		
	    FABridge.addInitializationCallback(bridgeId, function(){
	    	wrapper = phone.$flash = this.create("Wrapper").getPhone();
	    	wrapper.setId(bridgeId);
	    	wrapper.addEventListener(null, function(event) {
	    		
	    		var eventName = (event.getType()+"").toLowerCase();
            	window.console.log("Event: " + eventName);
            	
            	if(event["getCall"] != undefined) {
            		var call = event.getCall();
        			call = wrapCall(phone, call, {to:phone.sessionId});
            	}
            	
                phone.dispatcher.trigger($.extend({
                    phone: phone,
                    call: call,
                    reason: event.getReason()
                }, $.Event(eventName)),[phone]);
	    	});
	    	wrapper.connect(isNull(phone.gateway, DEFAULT_GATEWAY));
	    });
	    flashembed(bridgeId, "lib/Gordon.swf", {bridgeName:bridgeId});
	    
	    return phone;
	    
	}

})(jQuery);

