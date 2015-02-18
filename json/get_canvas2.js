var dominio = "http://localhost/PMCanvas4.0/";

$('#projetos').change(function() {
	var value = $('#projetos option:selected').attr("value");
	$("#papel").css("visibility","visible");

	if( value > 0 ){
		$.getJSON(dominio+"projects/"+value+"/canvas_project/show.json",function(data){
			var canvas_id = data.id;
			$('#canvas_id').attr("value",data.id);
			$("#gp").attr("value",data.gp);
			$("#pitch").attr("value",data.name);
		});
	}

});