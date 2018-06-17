<nav class="sidebar" id="sidebar">
    <a class="innerlist" onclick="myAccFunc()" href="#">Files <i class="fa fa-caret-down"></i></a> 
    <div id="demoAcc" class="w3-hide">
        <a class="innerlist" onclick="myDropFunc(1)" href="#">New </a>
        <div id="demoDrop1" class="w3-dropdown-content">
            <a class="innerlist2" href="<?php echo base_url('index.php/newfile/newFile?file=htmlmixed');?>">HTML</a>
            <a class="innerlist2" href="<?php echo base_url('index.php/newfile/newFile?file=css');?>">CSS</a>
            <a class="innerlist2" href="<?php echo base_url('index.php/newfile/newFile?file=javascript');?>">JavaScript</a>
            <a class="innerlist2" href="<?php echo base_url('index.php/newfile/newFile?file=php');?>">PHP</a>
            <a class="innerlist2" href="<?php echo base_url('index.php/newtext/newText');?>">Text</a>
        </div>
        <div>
            <a class="innerlist" onclick="myDropFunc(2)" href="#">Open </i></a>
            <div id="demoDrop2" class="w3-dropdown-content container">
                <?php
                	if($source != "No") {
                    	foreach ($source as $value) {
                        	$name = $value->Name;
                        	$type = $value->Type;
                        	$link = "http://nijojob.heliohost.org/MyApp/index.php/newfile/openFile?name=$name&type=$type";
                        	echo '<a class = "contents innerlist2" href = ' . $link . '>' . $name . '.' .$type . '</a>';
                    	}
                   } 
                ?>
            </div>
        </div>
    </div>
</nav>
<script>
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } 
    else { 
        x.className = x.className.replace("w3-show", "");
        if (document.getElementById("demoDrop1").className.indexOf("w3-show") != -1) { 
            document.getElementById("demoDrop1").className = document.getElementById("demoDrop1").className.replace(" w3-show", "");
        } 
        if (document.getElementById("demoDrop2").className.indexOf("w3-show") != -1) { 
            document.getElementById("demoDrop2").className = document.getElementById("demoDrop2").className.replace(" w3-show", "");
        }
    }
}
function myDropFunc(y) {
    var x = document.getElementById("demoDrop" + y);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        if(y == 1){
            if (document.getElementById("demoDrop2").className.indexOf("w3-show") != -1) { 
                document.getElementById("demoDrop2").className = document.getElementById("demoDrop2").className.replace(" w3-show", "");
            } 
        }
        else{
            if (document.getElementById("demoDrop1").className.indexOf("w3-show") != -1) { 
                document.getElementById("demoDrop1").className = document.getElementById("demoDrop1").className.replace(" w3-show", "");
            }
        }
    } 
    else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
function toggleNav() {
    if($(window).width() < 544){
        var toggleWidth = $("#sidebar").width() == 0 ? "50%" : "0";
    }
    else if($(window).width() < 990){
        var toggleWidth = $("#sidebar").width() == 0 ? "33%" : "0";
    }
    else if($(window).width() < 2000){
        var toggleWidth = $("#sidebar").width() == 0 ? "25%" : "0";
    }
    $('#sidebar').animate({ width: toggleWidth });
    if (document.getElementById("demoDrop1").className.indexOf("w3-show") != -1) { 
        document.getElementById("demoDrop1").className = document.getElementById("demoDrop1").className.replace(" w3-show", "");
    } 
    if (document.getElementById("demoDrop2").className.indexOf("w3-show") != -1) { 
        document.getElementById("demoDrop2").className = document.getElementById("demoDrop2").className.replace(" w3-show", "");
    }
    if (document.getElementById("demoAcc").className.indexOf("w3-show") != -1) { 
        document.getElementById("demoAcc").className = document.getElementById("demoAcc").className.replace(" w3-show", "");
    }
}
</script>