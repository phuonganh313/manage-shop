$.getScript('https://cartalerts.hamsa.site/public/js/core.js', function()
{
	var domain =  window.location.host;
	var CartAlerts = new Object({});
	CartAlerts.countRepeatTime = 0;
    CartAlerts.countFrequency = 0;
    CartAlerts.getSettings = function() {
        return $.ajax({
            url:"https://cartalerts.hamsa.site/api/setting/getfile",
            dataType: 'json', 
            type : 'POST',
            data: { 'domain' : domain },
            success:function(json){
                return json;
            },
            error:function(){
                alert("Oops, something went wrong!");
            }
        });
	};
	CartAlerts.blinkingNotification = function(favicon, items_count) {
		if (document.hidden) {
            CartAlerts.countFrequency%2 == 0 ? favicon.badge(0) : favicon.badge(items_count);					
            CartAlerts.countFrequency = parseInt(CartAlerts.countFrequency) + 1;
        } 
	};
	CartAlerts.soundNotification = function(settings, loop, items_count) {
		if (document.hidden && settings.sound && items_count > 0) {
            CartAlerts.countRepeatTime = parseInt(CartAlerts.countRepeatTime) - 1;				
            var soundEff = new Audio(settings.sound);
            AudioObject.play(soundEff, 1);
            if(CartAlerts.countRepeatTime === 0) clearInterval(loop);	
        } 
	};

	var AudioObject = new Object({});
	AudioObject.silent = function(silentSound) {
		var silent = new Audio(silentSound);
		silent.play();
	}
    AudioObject.play = function(audio, times, ended) {
        if (times <= 0) {
			return;
		}
		var played = 0;
		audio.addEventListener("ended", function() {
			played++;
			if (played < times) {            
				audio.play();
			} else if (ended) {
				ended();
			}
		});
		audio.play();
    }
	var settings = CartAlerts.getSettings();

	$.when(settings).done(function(settings){    
		var animation = settings.file.animation;
		var position = settings.file.position;
		var type = settings.file.shape;
		var bgColor = '#' + settings.file.icon_color;
		var textColor = '#' + settings.file.text_color;
		var fontFamily = settings.file.font_family;
		var fontStyle = settings.file.font_style;
		var blinkInterval = settings.file.flicker_timing * 1000;
		var soundInterval = settings.file.frequency * 1000;
		var repeatTime = settings.file.repeat;
		var soundEffect = settings.file.sound_effect;
		var favicon = new Favico({
			animation: animation,
			position : position,
			type : type,
			bgColor : bgColor,
			textColor : textColor,
			fontFamily : fontFamily,
			fontStyle : fontStyle
		});
		AudioObject.silent(settings.silent);
		var items_count = 0;
		// load badge on page load
		var http = new XMLHttpRequest();
		http.onload  = function() {
			var json = JSON.parse(http.responseText);
			items_count = json.item_count;
			favicon.badge(items_count);
		}; 
		http.open("GET", "/cart.js", true);
		//Send the proper header information along with the request
		http.setRequestHeader("content-type", "application/json");
		http.send();
		
		if (typeof blinkInterval != 'undefined'){
		// set blinking notification
			CartAlerts.countRepeatTime = repeatTime;
			setInterval(function () {CartAlerts.blinkingNotification(favicon, items_count);}, blinkInterval);
			var loop = setInterval(function () {CartAlerts.soundNotification(settings, loop, items_count);}, soundInterval);
			
			// favicon should appear when back to active tab
			window.onfocus = function() {
				var http = new XMLHttpRequest();
				http.onload  = function() {
					var json = JSON.parse(http.responseText);
					items_count = json.item_count;
					favicon.badge(items_count);
				}; 
				http.open("GET", "/cart.js", true);
				//Send the proper header information along with the request
				http.setRequestHeader("content-type", "application/json");
				http.send();
			};
		};

	});

});

