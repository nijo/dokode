    <?php
        include 'header.php';
        include 'navbar_2.php';
        include 'sidebar.php';
        include 'model.php';
    ?>
    <div id = "codearea" class = "container" >
        <ul class="nav nav-tabs" id = "nav-tabs">
            <li class="nav-item">
                <a class="nav-link active sub-buttons" href="#"><?php echo $name1 . "." . $file;?></a>
            </li>
        </ul>
        <textarea id = "codetext"><?php echo $data; ?></textarea>
        <ul class="nav justify-content-end" id = "buttons">
            <li class="nav-item">
                <button id = "editable" class="nav-link btn btn-secondary sub-buttons" onclick = "startEdit()">Edit</button>
            </li>
            <li class="nav-item">
                <button id = "runable" class="nav-link btn btn-secondary sub-buttons" onclick = "runEdit()">Run</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-secondary sub-buttons" onclick = "share()">Share</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-secondary sub-buttons" type = "submit"  form = "codetext2">Save</button>
            </li>
            <form id ="codetext2" action = "<?php echo base_url('index.php/newfile/saveFile');?>" style = "display: none" method = "post">
                <textarea name = "data" id = "data" style = "display: none"></textarea>
                <div class="form-group" style="margin-bottom: 0px;">
                    <input type="text" class="form-control" id="filetype" name="filetype" style = "display: none">
                </div>
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
            lineNumbers: true,
            value: "function myScript(){return 100;}\n",
            mode: "text", 
            matchBrackets: true,
            lineWrapping: true,
            foldGutter: true,
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
            autoCloseBrackets: true,
            autoCloseTags: true,
            matchTags: {bothTags: true},
            matchBrackets: true,
            autofocus: true,
            gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
        });
        var mode = "<?php if($file == "html" || $file == "htmlmixed") {echo "htmlmixed";} ?>";
        $("#data").html(editor.getValue());
        var email = "<?php echo $email; ?>";
        var read = "<?php if($read =="nocursor") {echo $read;} ?>";
        var codename = "<?php echo $name1; ?>";
        editor.setOption("mode", mode);
        editor.setOption("readOnly", read);
        $("#codetext2").submit(function(e) {  
                e.preventDefault();
                codedata = editor.getValue();
                codetype = editor.getOption("mode");
                $("#filetype").val(codetype);
                $("#filename").val(codename)
                if($('#filename').val()!=""){
                    $(this).unbind('submit').submit();
                    return true;
                }
        });
        function share() {
            if(mode == "htmlmixed") {
                mode = "html";
            } 
            else if(mode == "css") {
                mode = "css";
            }
            else if(mode == "javascript") {
                mode = "js";
            }
            else if(mode == "php") {
                mode = "php";
            }
            $('#sharelink').html("http://nijojob.heliohost.org/MyApp/index.php/newfile/sharedFile?email=" + email + "&name=" + codename + "&type=" + mode);
        }
        function startEdit() {
            editor.setOption("readOnly", false);
            $('#editable').prop('disabled', true);
		}
    </script>
</body>
<html>