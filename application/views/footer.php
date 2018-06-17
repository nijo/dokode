<div class = "footer" id = "footer">
&copy Copyright 2017. All rights reserved. <span style = "float: right;">Designed and Maintained by Nijo Job</span>
</div>
<script>
    if($(window).height()>$('body').height()){
        $('#footer').addClass('fixed-bottom'); 
        console.log($(window).height());
        console.log($('body').height());
    }