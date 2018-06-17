<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>MyApp</title>
        <link rel="icon" href="http://nijojob.heliohost.org/Common/css/images/favicon.png">
    </head>
    <body>
        <script src="http://nijojob.heliohost.org/Common/js/jquery/jquery.min.js"></script>
        <script type="text/javascript">
        	$('body').css('margin-top', '0px');
        </script>
        <div id = "container">
            <div id = "center">
                <img src="http://nijojob.heliohost.org/Common/css/images/icon.jpg">
                <h1 class = "display-3">MyApp</h1>
                <p class="lead">A text editor for all your needs......</p>
            </div>
        </div>
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/styles.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/codemirror/codemirror.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/codemirror/show-hint.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/codemirror/foldgutter.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/codemirror/fullscreen.css">
        <link rel="stylesheet" href="http://nijojob.heliohost.org/Common/css/codemirror/matchesonscrollbar.css">
        <script src="http://nijojob.heliohost.org/Common/js/bootstrap/bootstrap.min.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/progressbar.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/anyword-hint.js"></script> 
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/brace-fold.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/codemirror.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/comment-fold.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/css-hint.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/css.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/foldcode.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/foldgutter.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/fullscreen.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/html-hint.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/htmlmixed.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/javascript-hint.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/javascript.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/jump-to-line.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/markdown-fold.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/matchesonscrollbar.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/search.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/searchcursor.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/show-hint.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/sql-hint.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/xml-fold.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/xml-hint.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/xml.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/matchbrackets.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/matchtags.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/closebrackets.js"></script>
        <script src="http://nijojob.heliohost.org/Common/js/codemirror/closetag.js"></script>    
        <script type="text/javascript">
        	$('body').css('margin-top', '0px');
            window.onload=redirect;
            window.onclick=redirect;
            function redirect(){
                window.location="<?php echo base_url('index.php/welcome/welcomeScreen');?>";
                return;
            } 
        </script>
    </body>
</html>