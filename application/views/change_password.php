        <?php
            include 'header.php';
            include 'navbar_2.php';
            include 'sidebar.php';
        ?>
        <div class ="container">
        	<div id = "alert" >
            <?php 
                if($alert == "no"){
                    echo '<div class="alert alert-danger" role="alert"><p><strong>Please check your current password!!!</strong></p></div>';
                }
                else if($alert == "yes"){
                    echo '<div class="alert alert-success" role="alert"><p><strong>Password successfully changed!!!</strong></p></div>';
                }
                else if($alert == "")
                {
                    
                }
            ?>
            </div>
        </div>
        <div class ="container" id = "forms">
            <h3 id="form-heading">Enter your old and the new password.....</h3>
            <form id = "chngpwd" action="<?php echo base_url('index.php/home/changePwd'); ?>" method="post">
                <div class="form-group">
                    <div class="form-group row">
                        <label for="curent-password" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Current Password" id="current-password" name="current-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new-password" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="New Password" id="new-password" name="new-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirm-password" class="col-sm-2 col-form-label">Re-enter Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Confirm Password" id="confirm-password" name="confirm-password">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary button">Submit</button>
            </form>
        </div>     
        <?php
            include 'footer.php';
        ?>
        $("#chngpwd").submit(function(e) {  
            e.preventDefault();
            var error = "";
            if ($("#current-password").val() == "") {               
                error += "Please enter your current password.<br>"              
            }
            if ($("#new-password").val() == "") {               
                error += "Please enter your new password.<br>"              
            }
            if ($("#confirm-password").val() == "") {               
                error += "Please enter your new password again.<br>"              
            }
            else if ($("#new-password").val() != $("#confirm-password").val()) {               
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
        </script>
    </body>
</html>