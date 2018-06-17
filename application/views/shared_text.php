    <?php
        include 'header.php';
        include 'navbar_3.php';
    ?>
    <div class="container" id = "codearea">
        <ul class="nav nav-tabs" id = "nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#"><?php echo $name . ".txt";?></a>
            </li>
        </ul>
        <textarea id = "codetext"><?php echo $data; ?></textarea>
        <ul class="nav justify-content-end" id = "buttons">
            <li class="nav-item">
                <button id = "editable" class="nav-link btn btn-secondary" onclick = "startEdit()">Edit</button>
            </li>
        </ul>
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
        var read = "<?php if($read =="nocursor") {echo $read;} ?>";
        var codename = "<?php echo $name; ?>";
        editor.setOption("readOnly", read);
        function startEdit() {
				editor.setOption("readOnly", false);
                $('#editable').prop('disabled', true);
		}
    </script>
</body>
<html>