    <?php
        include 'header.php';
        include 'navbar_2.php';
        include 'sidebar.php';
        include 'model.php';
    ?>
    <div class="container" id = "codearea">
        <ul class="nav nav-tabs" id = "nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Untitled</a>
            </li>
        </ul>
        <textarea id = "codetext"></textarea>
        <ul class="nav justify-content-end" id = "buttons">
            <li class="nav-item">
                <button class="nav-link btn btn-secondary" onclick = "runEdit()">Run</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-secondary" type = "submit"  form = "codetext2">Save</button>
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
    </div>
        <?php
            include 'footer.php';
        ?>
        var editor = CodeMirror.fromTextArea(document.getElementById("codetext"), {
            lineNumbers: true,
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
        var mode = "<?php echo $file; ?>";
        var value = "";
        var read = "<?php if($read =="nocursor") {echo $read;} ?>";
        editor.setOption("mode", mode);
        editor.setOption("readOnly", read);
        $("#codetext2").submit(function(e) {  
                e.preventDefault();
                $("#codetext2").css("display", "block");
                codedata = editor.getValue();
                codetype = editor.getOption("mode");
                $("#filetype").val(codetype);
                $("#data").val(codedata);
                if($('#filename').val()!=""){
                    $(this).unbind('submit').submit();
                    return true;
                }
        });
    </script>
</body>
<html>