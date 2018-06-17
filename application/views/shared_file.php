    <?php
        include 'header.php';
        include 'navbar_3.php';
        include 'model.php';
    ?>
    <div class="container" id = "codearea">
        <ul class="nav nav-tabs" id = "nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#"><?php echo $name . "." . $file;?></a>
            </li>
        </ul>
        <textarea id = "codetext"><?php echo $data; ?></textarea>
        <ul class="nav justify-content-end" id = "buttons">
            <li class="nav-item">
                <button id = "editable" class="nav-link btn btn-secondary" onclick = "startEdit()">Edit</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-secondary" onclick = "runEdit()">Run</button>
            </li>
        </ul>
    </div>
        <?php
            include 'footer.php';
        ?>
        var editor = CodeMirror.fromTextArea(document.getElementById("codetext"), {
            lineNumbers: true,
            mode: "text",
            value: "function myScript(){return 100;}\n",
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
        var mode = "<?php if($file == "html") {echo "htmlmixed";} else if($file == "htmlmixed") {echo "htmlmixed";} ?>";
        $("#data").html(editor.getValue());
        var read = "<?php if($read =="nocursor") {echo $read;} ?>";
        var codename = "<?php echo $name; ?>";
        editor.setOption("mode", mode);
        editor.setOption("readOnly", read);
        function startEdit() {
				editor.setOption("readOnly", false);
                $('#editable').prop('disabled', true);
		}
    </script>
</body>
<html>