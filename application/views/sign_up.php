        <?php
            include 'header.php';
            include 'navbar_3.php';
        ?>
        <div class ="container">
            <div id = "alert" >
                <?php 
                    if(strcmp("e-mail",$alert) == 0){
                        echo '<div class="alert alert-success" role="alert"><p><strong>Congrats!!!You are successfully signed up!!!:</strong></p>We have send you an confirmation e-mail. Kindly click on the link provided in it to confirm your e-mail id.</div>';
                    }
                    else if($alert != ""){
                        echo '<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>'.$alert.'</div>';
                    }
                ?>
            </div>
        </div>
        <div class ="container" id = "forms">
            <h3 id="form-heading">Enter your details to sign-up.....</h3>
            <form id = "signup" action="<?php echo base_url('index.php/signup/addUser'); ?>" method="post">
                <div class="form-group">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Enter your name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Name" name="name" id="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Enter your Email address</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" placeholder="E-mail" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Enter Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Password" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirm-password" class="col-sm-2 col-form-label">Re-enter Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Confirm Password" id="confirm-password" name="cpassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="dob" name="dob">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary button">Sign up</button>
            </form>
        </div>     
        <?php
            include 'footer.php';
        ?>
        $("#signup").submit(function(e) {  
            e.preventDefault();
            var error = "";
            if ($("#name").val() == "") {               
                error += "Please enter your name.<br>";
            }
            if ($("#email").val() == "") {                
                error += "Please enter your email-id.<br>"                
            }            
            if ($("#password").val() == "") {               
                error += "Please enter your password.<br>"              
            }
            if ($("#confirm-password").val() == "") {               
                error += "Please enter your password again.<br>"              
            }
            if ($("#dob").val() == "") {               
                error += "Please enter your date of birth.<br>"              
            }
            if ($("#password").val() != $("#confirm-password").val()) {               
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