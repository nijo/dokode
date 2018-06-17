    <?php
        include 'header.php';
        include 'navbar_2.php';
        include 'sidebar.php';
    ?>
    <div class="container" id = "codearea">
        <ul class="nav nav-tabs" id = "nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#"><?php echo $name1 . ".txt";?></a>
            </li>
        </ul>
        <textarea id = "codetext"><?php echo $data; ?></textarea>
        <ul class="nav justify-content-end" id = "buttons">
            <li class="nav-item">
                <button id = "editable" class="nav-link btn btn-secondary" onclick = "startEdit()">Edit</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-secondary" onclick = "share()">Share</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-secondary" type = "submit" form = "codetext2">Save</button>
            </li>
            <form id ="codetext2" action = "<?php echo base_url('index.php/newtext/saveText');?>" style = "display: none" method = "post">
                <textarea name = "data" id = "data" style = "display: none"></textarea>
                <div class="form-group" style="margin-bottom: 0px;">
                    <input type="text" class="form-control" id="filename" name="filename" placeholder="File Name">
                </div>
            </form>
        </ul>
        <div id = "sharelink" style="word-wrap: break-word;"></div>
    </div>
    <?php
        include 'footer.php';
    ?>
        var editor = CodeMirror.fromTextArea(document.getElementById("codetext"), {
            mode: "text",
            value: "function myScript(){return 100;}\n",
            lineWrapping: true,
            extraKeys: {
                "F11": function(cm) {
                    cm.setOption("fullScreen", !cm.getOption("fullScreen"));
                },
                "Esc": function(cm) {
                    if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                },
                "Ctrl-Q": function(cm){ 
                    cm.foldCode(cm.getCursor());
                },
                "Ctrl-Space": "autocomplete",
                "Alt-F": "findPersistent",
                "Ctrl-J": "toMatchingTag"
            },
            autofocus: true
        });
        $("#data").html(editor.getValue());
        var email = "<?php echo $email; ?>";
        var read = "<?php if($read =="nocursor") {echo $read;} ?>";
        var codename = "<?php echo $name1; ?>";
        editor.setOption("readOnly", read);
        $("#codetext2").submit(function(e) {  
                e.preventDefault();
                codedata = editor.getValue();
                $("#data").val(codedata);
                $("#filename").val(codename)
                if($('#filename').val()!=""){
                    $(this).unbind('submit').submit();
                    return true;
                }
        });
        function share() {
            $('#sharelink').html("http://nijojob.heliohost.org/MyApp/index.php/newtext/sharedText?email=" + email + "&name=" + codename + "&type=txt");
        }
        function startEdit() {
            editor.setOption("readOnly", false);
            $('#editable').prop('disabled', true);
		}
    </script>
</body>
<html>