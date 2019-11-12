var Preview = {
    color: $("#text_color").val(),
    fontFamily: $("#font_family").val(),
    style: $("#font_style").val(),
    backgroundColor:  $("#backgroup_color").val(),
    shape: $("#shape").val(),
    position: $( "#position" ).val(),
    animation: $("#animation").val(),
    frequency: $("#frequency").val(),

    changeColor: function() {
        Preview.color = $("#text_color").val();
        clearInterval(interval);
        Preview.preview();
    },
    
    changeFront: function(){
        Preview.fontFamily = $("#font_family").val();
        clearInterval(interval);
        Preview.preview();
    },

    changeFrontStyle: function(){
        Preview.style = $("#font_style").val();
        clearInterval(interval);
        Preview.preview();
    },

    changeBackgroundColor: function() {
        Preview.backgroundColor = $("#backgroup_color").val();
        clearInterval(interval);
        Preview.preview();
    },

    changeShape: function(shape) {
        Preview.shape = $("#shape").val();
        clearInterval(interval);
        Preview.preview();
    },

    changePosition: function() {
        Preview.position = $( "#position" ).val();
        clearInterval(interval);
        Preview.preview();
    },

    changeAnimation: function() {
        clearInterval(interval);
        Preview.animation = $("#animation").val();
        clearInterval(interval);
        Preview.preview();
    },
    
    changeFrequecy: function(){
        Preview.frequency = $("#frequency").val();
        clearInterval(interval);
        Preview.preview();
    },

    preview: function() {
        $("#preview").css({
            "color":"#"+ Preview.color,
            "font-family": Preview.fontFamily,
            "font-style": Preview.style,
            "background-color": "#" + Preview.backgroundColor,
            "visibility": "visible",
        });
        if(Preview.style == 'bold' || Preview.style == 'lighter'){
            $("#preview-2").css({
                "font-style": "",
                "font-weight": Preview.style,
            });
            $("#preview").css({
                "font-style": "",
                "font-weight": Preview.style,
            });
        }else{
            $("#preview-2").css({
                "font-weight": '',
            });
            $("#preview").css({
                "font-weight": '',
            });
        }
        $("#preview").addClass('right-up');
        $("#preview-2").css({
            "color":"#"+ Preview.color,
            "font-family": Preview.fontFamily,
            "font-style": Preview.style,
            "background-color": "#" + Preview.backgroundColor,
            "visibility": "visible"
        });
        if(Preview.shape == 'rectangle'){
            $("#preview").addClass('shape-rectangle');
            $("#preview-2").addClass('shape-rectangle');
        }
        if(Preview.shape == 'circle'){
            $("#preview").removeClass('shape-rectangle');
            $("#preview-2").removeClass('shape-rectangle');
        }
        if(Preview.position == 'up'){
            $("#preview").removeClass('right-up left-down left-up right-down');
            $("#preview").addClass('right-up');

            $("#preview-2").removeClass('right-up left-down left-up right-down');
            $("#preview-2").addClass('right-up');
        } 
        if(Preview.position == 'down'){
            $("#preview").removeClass('right-up left-down left-up right-down');
            $("#preview").addClass('right-down');

            $("#preview-2").removeClass('right-up left-down left-up right-down');
            $("#preview-2").addClass('right-down');
        }
        if(Preview.position == 'left'){
            $("#preview").removeClass('right-up left-down left-up right-down');
            $("#preview").addClass('left-down');

            $("#preview-2").removeClass('right-up left-down left-up right-down');
            $("#preview-2").addClass('left-down');
        }
        if(Preview.position =='upleft'){
            $("#preview").removeClass('right-up left-down left-up right-down');
            $("#preview").addClass('left-up');

            $("#preview-2").removeClass('right-up left-down left-up right-down');
            $("#preview-2").addClass('left-up');
        }
        if(Preview.animation == "fade"){
            $("#preview").fadeOut('300');
            $("#preview").fadeIn('300');
        }
        if(Preview.animation == "pop"){
            $("#preview").fadeOut('300');
            $("#preview").fadeIn('300');
        }
        if(Preview.animation == "popFade"){
            $("#preview").slideUp('300');
            $("#preview").slideDown('300');
        }
        if(Preview.animation == "slide"){
            $("#preview").slideUp('300');
            $("#preview").slideDown('300');
        }
        
        function Frequency(){
            var elem = $("#preview");
            elem.css("visibility") == "visible" ? elem.css("visibility", "hidden") : elem.css("visibility", "visible");
        }
        interval = setInterval(Frequency, (parseInt(Preview.frequency) * 1000));
    },
}

