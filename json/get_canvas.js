//Obtem alguns dados do canvas do projeto (1 projeto possui apenas 1 canvas)

// Classe para chamar o Json.
function json(){
	//Ex: "http://qualiept.iff.edu.br/"
	var dominio = "http://localhost/PMCanvas5.0/";

	// Resgatar valores.
	json.prototype.resgatarValores = function(){

		var project_id = $("#dados_projeto").attr("project_id");

		// Estrutura de resultado.
		$.getJSON( dominio+'projects/'+project_id+'/canvas_project/show.json', function(data){
			$('#srv_gp').html(data.gp); //GP
			$('#srv_pitch').html(data.name); //PITCH
			$("#dados_canvas").attr("canvas_id",data.id)
		});

	}

}

// Objeto.
var obj = new json();
obj.resgatarValores();
