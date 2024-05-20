<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>
    <link rel="stylesheet" href="css/main.scss">
  <style>
.container {
  width: 100%;
  height: 2000px;
  position: relative;
  font-family: 'Trebuchet Ms';
}

.bg {
  background: #000;
  width: 100%;
  height: 100px;
  opacity: 0;
}

.show {
  opacity: 0.4;
}

.transition {    
  -webkit-transition: all 1s ease-in-out;
	-moz-transition: all 1s ease-in-out;
	-o-transition: all 1s ease-in-out;
	transition: all 1s ease-in-out;
}

.fixed {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
}

ul {
  height: 200px;
  margin: -70px auto 0 auto;
  width: 500px;
}

li {
  float: left; 
  list-style: none;
  margin: 10px 20px;
  text-transform: uppercase;
  letter-spacing: 4px;
  color: #000;
}

a {
  text-align: center;
  font-size: 50px;
  color: #bdbdbd;
  font-weight: bold;
  text-decoration: none;
  letter-spacing: 5px;
  text-shadow: 1px 1px 1px #949494;
  
  position: relative;
  z-index: 1;
  margin: 0 auto;
  display: block;
}

a:hover {
  color: #a6a6a6;
  text-shadow: 1px 1px 1px #C9C9C9;
}

.down {
  top: 150px;
}

.up {
  top: 1800px;
}
  </style>
</head>
<body>
   
    <?php include("modal/loginmodal.php"); ?>
    <div id="top" class="container">
  
  <div class="fixed">
    
    <div class="bg transition"></div>

    <ul>
      <li>One</li>
      <li>Two</li>
      <li>Three</li>
      <li>Four</li>
      <li>Five</li>
    </ul>
  
  </div>
  
  <a href="#bottom" class="scroll down">SCROLL DOWN</a>
  <a href="#top" id="bottom" class="scroll up">SCROLL UP</a>
  
</div>


    <?php include("footer.php"); ?>
</body>
<script src="js/index.js"></script>
<script src="js/register.js"></script>
<script src="js/cart.js"></script>
<script>
    $(window).scroll(function() {
// 100 = The point you would like to fade the nav in.
  
	if ($(window).scrollTop() > 100 ){
    
 		$('.bg').addClass('show');
    
  } else {
    
    $('.bg').removeClass('show');
    
 	};   	
});

$('.scroll').on('click', function(e){		
		e.preventDefault()
    
  $('html, body').animate({
      scrollTop : $(this.hash).offset().top
    }, 1500);
});

</script>
</html>