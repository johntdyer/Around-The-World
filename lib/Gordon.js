/*
Copyright 2010 Voxeo Corporation.
Copyright (c) 2010 John Resig, http://jquery.com/

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.  
*/

/* 
 * Javascript API:
 *
 * $g Helper Function:
 * ===================
 * $g() returns the first phone
 * $g(number) returns the number'th phone registered
 * $g('*') returns an iterator over all phones
 * $g(divid) returns a phone if it already exists in that divid
 * $g(divid, config) creates a phone where config is of the form:
 *   { event1:listnerFunction1, event2:listenerFunction2 }
 *
 * Events:
 * =======
 * Phone - event.getPhone() returns the phone object
 * -----
 * onConnect - phone is connected to the server and ready for use
 * onDisconnect - phone has lost connection to the server
 * onError - phone has encountered an error of event.getReason()
 * onText - a new instant message has arrived and is at event.getMessage()
 * onRing - a new inbound call has arrived and is at event.getCall()
 * onFlashOpenbox - flash needs to ask permission for the microphone and needs to display a box 
 *                   215px by 138px to enable the user to accept.
 * onFlashClosebox - flash is done asking for permission.
 *
 * Call - event.getCall() returns the call object and event.getPhone() the phone object
 * ----
 * onRinging - an oubound call is ringing
 * onAnswered - an outbound call has been answered
 * onHangup - the call has been terminated
 * onDigit - a digit has been received on the call and is at event.getDigit()
 * onCallError - an error has been encountered and is at event.getReason()
 *
 * Objects:
 * ========
 * Phone
 * -----
 * getSessionId() -> String
 * newCall([to],[listener]) -> Call
 * text(to, body) -> Phone
 * getPhoneState() -> String
 *
 * Call
 * ----
 * dial(to, callerid) -> Call
 * answer() -> Call
 * hangup() -> Call
 * accept() -> Call
 * digit(digit) -> Call
 * getFrom() -> String
 * getTo() -> String
 * getCallerId() -> String
 * getCallState() -> String
 * setPushToTalk(bool) -> Call 
 * isPushToTalk() -> bool
 * setTalking(bool) -> Call
 * volume(number) -> Call
 * getVolume() -> number
 * mute() -> Call
 * unmute() -> Call
 * isMuted() -> bool
 * hold() -> Call
 * unhold() -> Call
 * isOnHold() -> bool
 * addHeader(name, value) -> Call
 *
 * Message
 * -------
 * getFrom() -> String
 * getBody() -> String
 * getThread() -> String
 * getSubject() -> String
 * reply(body) -> Message
 */


// Taken from jQuery
function each(obj, fn) {
    if (!obj) { return; }
    
    var name, i = 0, length = obj.length;
    
    // object
    if (length === undefined) {
        for (name in obj) {
            if (fn.call(obj[name], name, obj[name]) === false) { break; }
        }
        
        // array
    } else {
        for (var value = obj[0];
             i < length && fn.call( value, i, value ) !== false; value = obj[++i]) {                         
        }
    }
    
    return obj;
}


function Gordon(bridgeId, config)
{
    // Does it exist already?
    if (Gordon.instances[bridgeId] != undefined) return undefined;

    FABridge.addInitializationCallback(bridgeId, Gordon.attachPhone);
    
    // Spit out the embed code
    flashembed(bridgeId, "Gordon.swf", {bridgeName:bridgeId});

    this.id = bridgeId;
    this.phone = undefined;
    this.config = config;
    Gordon.instances[bridgeId] = this;

    return this;
}

//////////////
// Class state

Gordon.phones = {}; // Populated once we have a phone from FABridge
Gordon.instances = {}; // Object store

////////////////////
// External User API
    
gordon = function() 
{
    if (!arguments.length) {
        // return the first one
        // Build an array, then pick n
        var arr = [];
        each(Gordon.instances, function()  {
                arr.push(this.phone);    
            });
        return arr[0];
    } 

    if (arguments.length == 1)
    {
        if (typeof arguments[0] == 'number')
        {
            // Build an array, then pick n
            var arr = [];
            each(Gordon.instances, function()  {
                    arr.push(this.phone);    
                });
            return arr[arguments[0]];            
        }
        else if (arguments[0] == "*")
        {
            var arr = [];
            each(Gordon.instances, function()  {
                    arr.push(this.phone);    
                });
            return new Iterator(arr); 
        }
        else if (Gordon.instances[arguments[0]] != undefined) return Gordon.getPhone(arguments[0]);
        else return undefined; // No such phone
    }
    else 
    {
        // Build a new one and return it
        var gordon = new Gordon(arguments[0], arguments[1]);
        return gordon; // Return the object we created, as the phone wont exist yet;
    } 
}

// shortcut
$g = gordon

///////////////////////////
// Internal class functions

Gordon.getPhone = function(bridgeName)
{
    var phone = Gordon.phones[bridgeName];
    if (phone != undefined)
    {
        return phone;
    }
    if (FABridge[bridgeName] != undefined)
    {
        phone = Gordon.phones[bridgeName] = FABridge[bridgename].create("Wrapper").getPhone();
        Gordon.instances[bridgeName].phone = phone;
        return phone;
    }
    return undefined;
}

/////////////////////////////////
// Internal interface to FABridge

Gordon.attachPhone = function()
{
    var phone = Gordon.phones[this.name];
    if (phone != undefined)
    {
        return;
    }
    phone = Gordon.phones[this.name] = this.create("Wrapper").getPhone();
    var instance = Gordon.instances[this.name];
    instance.phone = phone;
    // Add the event listeners
    each(instance.config, function(key,val) {
            phone.addEventListener(key,val);
        }
        )

    phone.setId(this.name);
    phone.connect("gordon112.orl.voxeo.net");
    console.log(phone);
}

/////////////////
// jQuery support

function Iterator(arr) {
        
        this.length = arr.length;
        
        this.each = function(fn)  {
                each(arr, fn);  
        };
        
        this.size = function() {
                return arr.length;      
        };      
}
    
if (typeof jQuery == 'function') {
        
        jQuery.fn.gordon = function(config) {  
                
                // select instances
                if (!arguments.length || typeof arguments[0] == 'number') {
                        var arr = [];
                        this.each(function()  {
                                var p = $g(this.id);
                                if (p) {
                                        arr.push(p);    
                                }
                        });
                        return arguments.length ? arr[arguments[0]] : new Iterator(arr);
                }
                
                // create gordon instances
                return this.each(function() { 
                    $g(this.id, config);       
                });

            };

        // Handy helper function
        jQuery.gordon = $g;

}



