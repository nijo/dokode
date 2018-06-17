        <?php
            include 'header.php';
            include 'navbar_3.php';
        ?>
        <div class ="container">
        	<div id = "alert" >
            <?php 	
                if($alert == "no"){
                    echo '<div class="alert alert-danger" role="alert"><p><strong>Please input your registered email!!!</strong></p></div>';
                }
                else if($alert == "yes"){
                    echo '<div class="alert alert-success" role="alert"><p><strong>Your password has been updated successfully!!!</strong></p></div>';
                }
                else if($alert == "sent")
                {
                    echo '<div class="alert alert-success" role="alert"><p><strong>An email has been sent to your registered email address. Please click on the link provided to reset your password!!!</strong></p></div>';
                }
            ?>
            </div>
        </div>
        <div class = "container" id = "forms">
            <div id = "step1">
                <h3 id="form-heading">Enter your email-id.....</h3>
                <form id = "forgotpwd1" method="post" action="<?php echo base_url("index.php/welcome/forgotPwd");?>">
                    <div class="form-group">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Enter E-mail id:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="E-mail id" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary button">Submit</button>
                </form>
            </div>
            <div id = "step2">
                <h3 id="form-heading">Enter your new password.....</h3>
                <form id = "forgotpwd2" method="post" action="<?php echo base_url("index.php/welcome/forgotPwd");?>">
                    <div class="form-group">
                        <div class="form-group row">
                            <label for="new-password" class="col-sm-2 col-form-label">Enter Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="New Password" id="new-password" name="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm-password" class="col-sm-2 col-form-label">Re-enter Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="Confirm Password" id="confirm-password" name="cpassword">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input class="form-control" name = "hidden" type ="hidden" value="<?php echo $alert; ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary button">Submit</button>
                </form>
            </div>
        </div>     
        <?php
            include 'footer.php';
        ?>
        var flag = "<?php echo $select; ?>";
        if(flag == 'email'){
        	$('#step1').show();
        	$('#step2' ).hide();
            $("#forgotpwd1").submit(function(e) {  
            e.preventDefault();
            var error = "";
            if ($("#email").val() == "") {               
                error += "Please enter your registered email.<br>"              
            }
            if (error != "") {             
                $("#alert").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>'); 
                return false;            
            } else {    
                $("#alert").html('');
                $(this).unbind('submit').submit();
                return true;           
            }
        });
        } 
        else if(flag == 'password'){
        	$('#step2').show();
        	$('#step1').hide();
            $("#forgotpwd2").submit(function(e) {  
            e.preventDefault();
            var error = "";
            if ($("#new-password").val() == "") {               
                error += "Please enter your new password.<br>"              
            }
            if ($("#confirm-password").val() == "") {                
                error += "Please enter your new password again.<br>"              
            }
            if ($("#new-password").val() != $("#confirm-password").val()) {               
                error += "Passwords does not match.<br>"              
            }
            if (error != "") {             
                $("#alert").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>'); 
                return false;            
            } else {    
                $("#alert").html('');
                $(this).unbind('submit').submit();
                return true;           
            }
        });
        }
        </script>
    </body>
</html>