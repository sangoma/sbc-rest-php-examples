<!doctype html>
<html lang="en">
<head>
	<!-- Basic Header Information -->
	<title>mtl-nsc-devel-will.sangoma.local - nsc</title>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=9' />

	<!-- Style Sheets -->
	<link type='text/css' rel='stylesheet' href='/templates/sng/css/required.css'>
	<link type='text/css' rel='stylesheet' href='/templates/sng/css/template.css'>
	<link type='text/css' rel='stylesheet' href='/templates/sng/css/charts.css'>

	<!-- Base YUI / TODO remove, only required for legacy Ajax calls -->
	<script type="text/javascript" src="/templates/base/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
	<script type="text/javascript" src="/templates/base/yui/build/connection/connection-min.js" ></script>

	<!-- Jquery Style Sheets -->
	<link type="text/css" href="/templates/sng/css/jquery-ui/jquery-ui-1.7.2.custom.css" rel="stylesheet">
	<link type="text/css" href="/templates/sng/css/superfish.css" rel="stylesheet">
	<link type="text/css" href="/templates/sng/css/superfish-vertical.css" rel="stylesheet">
	<link type="text/css" href="/templates/sng/css/superfish-navbar.css" rel="stylesheet">

	<!-- Favicon -->
	<link rel="shortcut icon" href="/templates/sng/images/favicon.ico">

	<!-- Legacy cruft / TODO -->
	<script type="text/javascript" src="/templates/base/html/base.js"></script>

	<!-- JQuery Javascript -->
	<script type="text/javascript" src="/SAFe/js/jquery/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="/SAFe/js/jquery-ui/jquery-ui-1.9.1.custom.min.js"></script>
	<script type="text/javascript" src="/templates/sng/js/jquery-ui/ui.accordion.js"></script>
	<script type="text/javascript" src="/templates/sng/js/superfish.js"></script>
	
    <script>
  $(function() {
	    $( document ).tooltip({
	    	open: function( event, ui ) {
    	     var test='';
        	},
        close: function( event, ui ) {
            //return false;
    	     var test='';
              	},
        position: {
        my: "center top+15",
        at: "center bottom",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
	    $( document ).tooltip({
			hide: {
				delay: 250
			}
		});
  });
  </script>
  <style>
  .ui-tooltip, .arrow:after {
    background: black;
    border: 1px solid white;
    width:600px;
    height:auto;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    background: #a0cfec;
    border-radius: 5px;
    font: bold 11px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
    box-shadow: 0 0 0px blue;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: -16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    background: #a0cfec;
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    tranform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }
  .ui-widget{
  	position: absolute;
  }
  </style>
</head>
<body>
 
<p><a href="#" title="That's what this widget is">Tooltips</a> can be attached to any element. When you hover
the element with your mouse, the title attribute is displayed in a little box next to the element, just like a native tooltip.</p>
<p>But as it's not a native tooltip, it can be styled. Any themes built with
<a href="http://themeroller.com" title="ThemeRoller: jQuery UI's theme builder application">ThemeRoller</a>
will also style tooltips accordingly.</p>
<p>Tooltips are also useful for form elements, to show some additional information in the context of each field.</p>
<p><label for="age">Your age:</label> <input id="age" title="this is a test We ask for your age only for statistical purposes.


urposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes.this is a test We ask for your age only for statistical purposes." /></p>
<p>Hover the field to see the tooltip.</p>
 
 
</body>
</html>