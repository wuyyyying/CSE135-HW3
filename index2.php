<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="http://157.230.57.144:8081/favicon.png">
        <title>CSE135 Homework 1</title>
        <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                }
                .header {
                    background-color: #f1f1f1;
                    padding: 20px;
                    text-align: center;
                }
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
                    
                }
               .column {
                    float: left;
                    text-align: center;
                    width: 50%;
                    padding: 20px;
                }
                img {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }
            </style>
	    <script src="http://157.230.57.144:8081/jquery-3.3.1.min.js"></script>
	    <script type="text/javascript">
               var imageURLs = [
                 "http://lorempixel.com/400/200/",
                 "http://lorempixel.com/g/400/200/",
                 "http://lorempixel.com/400/200/sports/",
                 "http://lorempixel.com/400/200/city/",
                 "http://lorempixel.com/400/200/food/",
                 "http://lorempixel.com/400/200/people/",
                 "http://lorempixel.com/400/200/nature/",
                 "http://lorempixel.com/400/200/transport/",
                 "http://lorempixel.com/400/200/fashion/",
                 "http://lorempixel.com/400/200/cats/"
               ];
               function getImageTag() {
                  var img = '<img src=\"';
                  var randomIndex = Math.floor(Math.random() * imageURLs.length);
                  img += imageURLs[randomIndex];
                  img += '\" alt=\"Some alt text\"/>';
                  return img;
               }
            </script>
    </head>


    <body>
        <div class='header'>
            <h1>CSE 135 Homework Page</h1>
        </div>
        <div class='row'>
                <div class='column'>
                    <h2>Xingyu Yang</h2>
                    <p>Email: xiy076@ucsd.edu</p>
                </div>
                
                <div class='column'>
                    <h2>Ying Wu</h2>
                    <p>Email: yiw273@ucsd.edu</p>
                </div>
        </div>
        <img src="https://media.giphy.com/media/xBAreNGk5DapO/giphy.gif" alt="whoops" style="width:75%;">
	<script type="text/javascript">
        	document.write(getImageTag());
	</script>
	<script type="text/javascript">
        	document.write(getImageTag());
	</script>
	<script type="text/javascript">
        	document.write(getImageTag());
	</script>

	<div class='header'>
		<form action="#" method="post">
			<div>
    				<label for="name">Name:</label>
    				<input type="text" id="name" placeholder="Enter your full name" />
			</div>

			<div>
    				<label for="email">Email:</label>
    				<input type="email" id="email" placeholder="Enter your email address" />
			</div>

			<div>
    				<label for="message">Message:</label>
    				<textarea id="message" placeholder="What's on your mind?"></textarea>

    				<input type="submit" value="Send message" />
			</div>

		</form>
	</div>

	<div class='row'>
                <div class='column'>
		<p>Urna et pharetra pharetra massa massa ultricies mi. At lectus urna duis convallis. Tempus quam pellentesque nec nam aliquam sem et tortor. 
		Tristique nulla aliquet enim tortor at autor urna nunc. Neque gravida in fermentum et sollicitudin ac orci. Ullamcorper dignissim cras tincidunt 
		lobortis feugiat vivamus at augue. Eget velit aliquet sagittis id consectetur purus ut faucibus. Posuere urna nec tincidunt praesent semper. 
		Velit aliquet sagittis id consectetur purus ut faucibus pulvinar. Ut tellus elementum sagittis vitae et leo duis ut diam. Ut tellus elementum 
		sagittis vitae. Nunc scelerisque viverra mauris in aliquam sem fringilla. </p>
                </div>

                <div class='column'>
		<p>Consectetur adipiscing elit pellentesque habitant morbi tristique. Sit amet consectetur adipiscing elit pellentesque habitant morbi tristique
		senectus. Leo integer malesuada nunc vel risus commodo viverra maecenas accumsan. Adipiscing elit pellentesque habitant morbi tristique senectus 
		et. Facilisis volutpat est velit egestas dui. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Feugiat in fermentum posuere urna
		nec tincidunt. Sit amet mauris commodo quis imperdiet massa tincidunt nunc. At varius vel pharetra vel. Ridiculus mus mauris vitae ultricies leo.</p>
                </div>
	</div>
	
        <!--<form class='header' action="/error" method="get">
		<h1>Generate a runtime JavaScript error here!</h1>
		<input type="submit" class="button" name="click" value="Click me" />
	</form>-->

	<div class="header">
		<button onclick="throw new Error(randomError())">Generate error</button>
	</div>

	<div class = "header">
		<form action="http://157.230.57.144:8081/backend">
    			<input type="submit" value="HW4" />
		</form>
	</div>

	<script>
		function randomError() {
			var text = "Random error message: ";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			for (var i = 0; i < 5; i++)
				text += possible.charAt(Math.floor(Math.random() * possible.length));

			return text;
		}
	</script>
	<script src="http://157.230.57.144:8081/collector.js"></script>
	<script src="http://157.230.57.144:8081/index.js"></script>
	<!--<script src="http://157.230.57.144:8081/error.php"></script>-->
	<script src="http://157.230.57.144:8081/error.js"></script>
    </body>
</html>
