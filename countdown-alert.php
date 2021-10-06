<!DOCTYPE HTML>
<html>
  <head>
    <!--http://www.sitepoint.com/forums/showthread.php?1055755-Count-Down-and-Make-sound-play-on-click-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Play sound after countdown</title>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
  </head>
  
  <body>
    <button id="myButton">Start Countdown</button> <br /> 
    <span id="count"></span>
    
    <script>
      function playSong(src){
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', src);
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.play();
      }
      
      $(document).ready(function() {

// Executes when the HTML document is loaded and the DOM is ready
        playSong("sound/alert.mp3");
            alert("Document is ready");
        });

        $("#myButton").on("click", function(){
        // $.when(countdown(10)).then(function() { 
          playSong("sound/alert.mp3");
        // });  
      });
      
      
    </script>
  </body>
</html>