    <?php
        include 'header.php';
    ?>
    <nav class="navbar navbar-default navbar-light bg-faded" id="navbar" role="navigation">
            <table id="nav-table">
                <thead>
                    <tr>
                        <td id="nav-table-item1">
                            <div>
                                <a class="navbar-brand" href="<?php echo base_url('index.php/home/homePage');?>">
                                    <img src="http://nijojob.heliohost.org/Common/css/images/icon.jpg" width="38" height="38" class="d-inline-block align-top">
                                    MyApp
                                </a>
                            </div>
                        </td>
                        <td id="nav-table-item2">
                            
                        </td>
                        <td id="nav-table-item3">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div id =  "user"><?php echo $user;?></div></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <hr>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/loadChange');?>">Change Password</a>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/loadDelete');?>">Delete Account</a>
                                        <hr>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/askHelp');?>">Help & Support</a>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/logOut');?>">Log Out</a>
                                    </div>
                                </li>
                            </ul>                                        
                        </td>
                    </tr>
                </thead>
            </table>
        </nav>
    <div class="container">
    	<div class = "container filetable">
    		<p>&emsp;&emsp;MyApp is an application where you can create, upload, edit, download and share text documents as well as your code files. Click any one of the following links to start.... 
    		</p>
    		<ul>
				<li><a class="outerlist" href="<?php echo base_url('index.php/newfile/newFile?file=htmlmixed');?>">HTML</a></li>
                <li><a class="outerlist" href="<?php echo base_url('index.php/newfile/newFile?file=css');?>">CSS</a></li>
                <li><a class="outerlist" href="<?php echo base_url('index.php/newfile/newFile?file=javascript');?>">JavaScript</a></li>
                <li><a class="outerlist" href="<?php echo base_url('index.php/newfile/newFile?file=php');?>">PHP</a></li>
                <li><a class="outerlist" href="<?php echo base_url('index.php/newtext/newText');?>">Text</a></li>
                </ul>
    	</div>
    	<div class = "container filetable" id = "largescreen">
		<?php
            if ($file == "table") {
                if ($source == "No") {
                    echo "<p style = 'margin-bottom: 0.5rem;'>No files to display.</p>";
                }
                else {
                    echo '<p>Click on any one of files to open it... </p>';
                    echo "<table id = 'filelist' >";
                    echo '<tr><th>Name</th><th>Date Created</th><th>Last Updated</th><th>Type</th><th>Delete?</th><th>Download?</th><tr/>';
                    foreach ($source as $value) {
                        $name = $value->Name;
                        $type = $value->Type;
                        if($type == "txt"){
                            $link = "http://nijojob.heliohost.org/MyApp/index.php/newtext/openText?name=$name&type=$type";
                        }
                        else{
                            $link = "http://nijojob.heliohost.org/MyApp/index.php/newfile/openFile?name=$name&type=$type";
                        }
                        $dellink = "http://nijojob.heliohost.org/MyApp/index.php/home/deleteFile?name=$name&type=$type";
                        $downlink = "http://nijojob.heliohost.org/MyApp/index.php/home/downloadFile?name=$name&type=$type";
                        echo '<tr><td><a class = "contents" href = ' . $link . '>' . $value->Name . '</a></td><td><a class = "contents" href =  ' . $link . '>' . $value->DateCreated . '</a></td><td><a class = "contents" href =  ' . $link . '>' . $value->LastUpdated . '</a></td><td><a class = "contents" href =  ' . $link . '>' . $value->Type . '</a></td><td><a class = "contents btn btn-sm btn-warning" href = ' . $dellink . '>Delete</a></td><td><a class = "contents btn btn-sm btn-warning" href = ' . $downlink . '>Download</a></td><tr/>';
                    }
                    echo '</table>'; 
                }
                echo '<br><p style = "margin-bottom: 0.5rem;">Select a file to upload:</p><form action = "http://nijojob.heliohost.org/MyApp/index.php/home/uploadFile" method="post" enctype="multipart/form-data"><p style = "margin-bottom: 0.5rem;"><input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload"></p><p style = "margin-bottom: 0.5rem;"><input type="submit" value="Upload" class = "btn btn-sm btn-primary" name="submit"></p></form>';
                if($read != "") {
                    	echo '<div class="alert alert-warning" role="alert"><p><strong>Please check the file you have tried to upload and try again.</strong></p></div>';
                    }
            }
        ?>
    </div>
    <div class = "container filetable" id = "smallscreen">
		<?php
            if ($file == "table") {
                if ($source == "No") {
                    echo "<p style = 'margin-bottom: 0.5rem;'>No files to display.</p>";
                }
                else {
                    echo '<p>Click on any one of files to open it... </p>';
                    foreach ($source as $value) {
                        $name = $value->Name;
                        $type = $value->Type;
                        if($type == "txt"){
                            $link = "http://nijojob.heliohost.org/MyApp/index.php/newtext/openText?name=$name&type=$type";
                        }
                        else{
                            $link = "http://nijojob.heliohost.org/MyApp/index.php/newfile/openFile?name=$name&type=$type";
                        }
                        $dellink = "http://nijojob.heliohost.org/MyApp/index.php/home/deleteFile?name=$name&type=$type";
                        $downlink = "http://nijojob.heliohost.org/MyApp/index.php/home/downloadFile?name=$name&type=$type";
                        echo '<table id = "filelist" ><tr><th>Name</th><td><a class = "contents" href = ' . $link . '>' . $value->Name . '</a></td></tr><tr><th>Date Created</th><td><a class = "contents" href =  ' . $link . '>' . $value->DateCreated . '</a></td></tr><tr><th>Last Updated</th><td><a class = "contents" href =  ' . $link . '>' . $value->LastUpdated . '</a></td></tr><tr><th>Type</th><td><a class = "contents" href =  ' . $link . '>' . $value->Type . '</a></td></tr><tr><th>Delete</th><td><a class = "contents btn btn-sm btn-warning" href = ' . $dellink . '>Delete</a></td></tr><tr><th>Download</th><td><a class = "contents btn btn-sm btn-warning" href = ' . $downlink . '>Download</a></td><tr/></table>';
                    }
               } 
                echo '<br><p style = "margin-bottom: 0.5rem;">Select a file to upload:</p><form action = "http://nijojob.heliohost.org/MyApp/index.php/home/uploadFile" method="post" enctype="multipart/form-data"><p style = "margin-bottom: 0.5rem;"><input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload"></p><p style = "margin-bottom: 0.5rem;"><input type="submit" value="Upload" class = "btn btn-sm btn-primary" name="submit"></p></form>';
                if($read != "") {
                    	echo '<div class="alert alert-warning" role="alert"><p><strong>Please check the file you have tried to upload and try again.</strong></p></div>';
                    }
            }
        ?>
    </div>
    </div>
    <?php
        include 'footer.php';
    ?>
    	$('body').css('margin-top', '0px');
        if($( window ).width() > 600){
            $("#smallscreen").hide();
            $("#largescreen").show();
        }
        else{
            $("#largescreen").hide();
            $("#smallscreen").show();
        }
    </script>
</body>
</html>