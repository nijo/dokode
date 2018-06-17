        <?php
            include 'header.php';
            include 'navbar_2.php';
            include 'sidebar.php';
        ?>
        <div id = "alert">
        </div>
        <div class="container" id = "forms">
            <h3 id="form-heading">Confirm your deletion.....</h3>
            <form id="dltacc" action="<?php echo base_url('index.php/home/deleteAcc'); ?>" method="post" class="my-2 my-lg-0">
                <fieldset class="form-group" id = "deleteconfirm">
                    <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name = "radio" id="yes" value="yes" checked>
                            YES
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name = "radio" id="no" value="no">
                            NO
                      </label>
                    </div>
                </fieldset>
                <div class="form-group" id = "comments1">
                    <label class="widthpercent"for="comment">Please tell us how we can improve....</label>
                    <textarea class="form-control" name="comments" id="comment" rows="3"></textarea>
                </div>
                <div class="form-group" id = "comments2" style="display: none;">
                    <h6 id="form-heading">Happy to hear that you have decided to stay.....</h6>
                </div>
                <button class="btn btn-outline-success my-2 my-sm-0 button" type="submit">Submit</button>   
            </form>
        </div>
        <?php
            include 'footer.php';
        ?>
            $(function() {
                $('#no').click(function(){
                        $('#comments1').hide();
                        $('#comments2').show();
                });
                $('#yes').click(function(){
                        $('#comments1').show();
                        $('#comments2').hide();
                });
            });
            $("#dltacc").submit(function(e) {  
            e.preventDefault();
            if (document.getElementById('yes').checked == true) {              
                if ($("#comment").val() == "") {                  
                    $("#alert").html('<div class="alert alert-danger" role="alert"><p><strong>Please give your suggestions....</strong></p></div>'); 
                    return false;            
                }                
                else {    
                    $("#alert").html('');
                    $(this).unbind('submit').submit();
                    return true;           
                }
            }
            if (document.getElementById('no').checked == true) {    
                    $("#alert").html('');
                    $(this).unbind('submit').submit();
                    return true;           
            }
        });
        </script>
    </body>
</html>