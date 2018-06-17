<div class="modal" id="codeareas" tabindex="-1" role="dialog">
  <div class="modal-dialog percent" role="document">
    <div class="modal-content percent">
    	<div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><h3>Output:</h3></h5>
                    <button type="button" class="close" onclick = "closeMod()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
      <div class="modal-body">
        <iframe id="outputPanel" class="panel percent"></iframe>
      </div>
    </div>
  </div>
</div>
<script>
	function closeMod(){
		$('#codeareas').modal('toggle');
	} 
    function runEdit(){
        $('#codeareas').modal('toggle');
        if(editor.getOption("mode") == "htmlmixed"){
                $("iframe").contents().find("html").html(editor.getValue());
            }
            else if(editor.getOption("mode") == "php") {
                $("iframe").attr('src', "http://nijojob.heliohost.org/MyApp/index.php");
            }
            else{
				$('#runable').prop('disabled', true); 
			} 
        }
</script>