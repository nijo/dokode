        <?php
            include 'header.php';
            include 'navbar_2.php';
            include 'sidebar.php';
        ?>
        <div class="container" style="padding-top:30px;">
            <h3 id="form-heading">Frequently asked questions...</h3>
            <div id="accordion">
              <h3>Section 1</h3>
              <div>
                <p>
                Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
                ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
                amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
                odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                </p>
              </div>
              <h3>Section 2</h3>
              <div>
                <p>
                Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
                purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
                velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
                suscipit faucibus urna.
                </p>
              </div>
              <h3>Section 3</h3>
              <div>
                <p>
                Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                </p>
                <ul>
                  <li>List item one</li>
                  <li>List item two</li>
                  <li>List item three</li>
                </ul>
              </div>
              <h3>Section 4</h3>
              <div>
                <p>
                Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                mauris vel est.
                </p>
                <p>
                Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                inceptos himenaeos.
                </p>
              </div>
            </div>
        </div>
        <br><hr><br>
        <div class="container" id = "forms">
            <h3 id="form-heading">Make your queries.....</h3>
            <form id="askhelp" action="<?php echo base_url('index.php/home/askHelp'); ?>" method="post" class="my-2 my-lg-0">
                <div class="form-group" id = "comments1">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject">
                </div>
                <div class="form-group">
                    <label for="comment">Please tell us what do you want to know?</label>
                    <textarea class="form-control" name="query" id="query" class="widthpercent" rows="3"></textarea>
                </div>
                <button class="btn btn-outline-success my-2 my-sm-0 button" type="submit">Submit</button>   
            </form>
        </div>
        <div id = "alert">
            <?php 
                if($alert == "yes"){
                    echo '<div class="alert alert-success" role="alert"><p><strong>We will reach back to you as soon as possible!!!</strong></p></div>';
                }
            ?>
        </div>
            <?php
                include 'footer.php';
            ?>
            $(function() {
                $("#accordion").accordion();
            });
            $("#askhelp").submit(function(e) {  
                e.preventDefault();  
                var error = "";
                if ($("#subject").val() == "") {               
                    error += "Please enter the subject of your query.<br>"              
                }
                if ($("#query").val() == "") {               
                    error += "Please enter your query.<br>"              
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