<?
session_start();
$ip=$_SERVER["REMOTE_ADDR"];

?> 
<!DOCTYPE HTML>
<html>
	<head>
		<title>hausanfan</title>
	        <meta charset="UTF-8">
        <!-- Include the PubNub Library -->
        <script src="https://cdn.pubnub.com/pubnub.min.js"></script>
        <script src="js/webrtc-beta-pubnub.js"></script>

        <!-- Instantiate PubNub -->
        <script type="text/javascript">

        var pubnub = PUBNUB.init({
        publish_key: 'pub-c-c25d73f6-1b1e-4b49-813f-f5eda5ac120e',
        subscribe_key: 'sub-c-496b23ee-7d21-11e4-812f-02ee2ddab7fe',
        uuid: '<?=$ip?>'
        });
        
        pubnub.subscribe({
        channel: 'facemix',
        message: function(m){console.log(m);},
        connect: publish

        }); 


        function publish() {
		//http://creativejs.com/2012/03/getting-started-with-getusermedia/
		var is_webkit = false;
		var is_moz=false;

		function onSuccess(stream) {
			var output=document.getElementById('selfvideo');
			if (is_webkit) {
				output.src=window.webkitURL.createObjectURL(stream);
			}	
			else if(is_moz) {
				document.querySelector('#selfvideo').src = URL.createObjectURL(stream);
				//		output.src=URL.createObjectURL(stream);
				//alert(output.src);
			}
			else {
				output.src=stream;
			}
			//#self-call-video').src = URL.createObjectURL(stream);
			//myStream = stream; // Save the stream for later use

		            pubnub.publish({
			            channel: 'facemix',
				    message: function(m){console.log(m)}
		            });

		            pubnub.here_now({
		                channel: 'facemix',
		                callback: function(m){
					console.log(m);
					//document.getElementById("people").innerHTML ="0 people in the ring";
				}
		            })

		}
		function onError() {
		}


		if (navigator.getUserMedia) {
		    // opera users (hopefully everyone else at some point)
		    navigator.getUserMedia({video: true, audio: true}, onSuccess, onError);
		}
		else if (navigator.webkitGetUserMedia) {
		    // webkit users
		    is_webkit = true;
		    navigator.webkitGetUserMedia({video:true, audio: true}, onSuccess, onError);
		}
		else if (navigator.mozGetUserMedia) {
			//mozilla
		    is_moz=true;
		    navigator.mozGetUserMedia({ audio: true, video: true}, onSuccess, onError ); 
		}
		else {
		    // moms, dads, grandmas, and grandpas
		}



	}
        </script>
<style type="text/css">

#other {
position: absolute;
color: #121212;
background:rgba(100, 255, 100, 1);
left:0px;
top:0px;
width: 100%;
height:100%;
z-index: -200;
}

#self {
position: absolute;
background:rgba(10, 155, 10, 1);
left: 10px;
top: 10px;
width: 175px;
height:150px;
}

video {
    width: 100%    !important;
    height: 100%   !important;
}

.cb-tip-button {
position: absolute;
bottom: 50px;
left:30px;
z-index: 150;
}


</style>
	</head>
	<body>

<div class="cb-tip-button" data-content-location="mm-studios.com" data-href="//www.coinbase.com/tip_buttons/show_tip" data-to-user-id="523c4e82a787b2fa4000002e"></div>
<script>!function(d,s,id) {var js,cjs=d.getElementsByTagName(s)[0],e=d.getElementById(id);if(e){return;}js=d.createElement(s);js.id=id;js.src="https://www.coinbase.com/assets/tips.js";cjs.parentNode.insertBefore(js,cjs);}(document, 'script', 'coinbase-tips');</script>


<div id="other">
<video id="othervideo" src="http://download.wavetlan.com/SVV/Media/HTTP/H264/Talkinghead_Media/H264_test1_Talkinghead_mp4_480x360.mp4" autoplay="autoplay"></video>
</div>


<div id="self">
<video id="selfvideo" src="http://download.wavetlan.com/SVV/Media/HTTP/H264/Talkinghead_Media/H264_test1_Talkinghead_mp4_480x360.mp4" autoplay="autoplay" muted="true"></video>
</div>


<!-- fork me. https://github.com/blog/273-github-ribbons -->
<a href="http://github.com/mm-s/hausanfan" target="_blank"><img style="z-index: -10; position: absolute; top: 0; right: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub" ></a>
<body>
</html>

