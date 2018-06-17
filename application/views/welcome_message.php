	<?php
		include 'header.php';
        include 'navbar_1.php';
    ?> 
    <div class="modal fade" id="loginmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id = "login" action="<?php echo base_url('index.php/welcome/login'); ?>" method = "post" style = "text-align: left;">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div id = "emailparent" class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div id="pwdparent" class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name = "signed" value = "1">Stay signed in
                                </label>
                                </div>
                            </div>
                            <a class="btn btn-link" href="<?php echo base_url();?>welcome/forgotPwd" role="button">Forgot Password?</a>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="login" class="btn btn-primary">Log in</button>
                </div>
            </div>
        </div>
    </div>
    <div id = "alert">
        <?php 
            if($alert != ""){
                echo '<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>'.$alert.'</div>';
            } 
        ?>
    </div>
    <div class="jumbotron jumbotron-fluid" id = "jumbotron">
        <h1 class="display-3">MyApp</h1>
        <p class="lead">A text editor for all your needs......</p>
        <hr class="my-4">
        <p>Sign-up to start...</p>
        <p class="lead">
            <a class="btn btn-primary btn-md" href="<?php echo base_url();?>signup/signUp" role="button">Sign up</a>
        </p>
    </div>
    <div class="container" id = "card-deck">
        <div class="card-deck" style="text-align: center;">
            <div class="card">
                <img class="card-img-top" style="max-width: 256px; margin: 0 auto;" src="http://nijojob.heliohost.org/Common/css/images/card-text.png" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title">Text Editor</h4>
                        <p class="card-text"><em>A text editor that syncs data across all your devices.</em></p>
                    </div>
                </div>
                <div class="card">
                <img class="card-img-top" style="max-width: 256px; margin: 0 auto;" src="http://nijojob.heliohost.org/Common/css/images/card-code.png" alt="Card image cap">
                <div class="card-block">
                    <h4 class="card-title">Web Editor</h4>
                    <p class="card-text"><em>A web editor supports most of the web development languages.</em></p>
                </div>
            </div>
        </div>
    </div> 
    <?php
        include 'footer.php';
    ?>          
        $("#login").submit(function(e) {  
                e.preventDefault();
                var flag = true;
                $("#email").removeClass("form-control-danger");
                $("#emailparent").removeClass("has-danger");
                $("#password").removeClass("form-control-danger");
                $("#pwdparent").removeClass("has-danger");         
                if ($("#email").val() == "") {                     
                    $("#email").addClass("form-control-danger");
                    $("#emailparent").addClass("has-danger");
                    flag = false;
                }            
                if ($("#password").val() == "") { 
                    $("#password").addClass("form-control-danger");
                    $("#pwdparent").addClass("has-danger");
                    flag = false;
                }                    
                if(flag == true) {
                    $(this).unbind('submit').submit();
                    return true;           
                }
            }); 
        $("#login1").click(function(e){
                $('#loginmodel').modal('toggle');
            });
        $(".exit").click(function(e){
                $('#loginmodel').modal('hide');
            });
    </script>
</body>
</html>