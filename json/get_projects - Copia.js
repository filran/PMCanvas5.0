//Obtem todos os projetos

// Classe para chamar o Json.
function json(){
	//Ex: "http://qualiept.iff.edu.br/"
	var dominio = "http://localhost/PMCanvas5.0/";

	// Resgatar valores.
	json.prototype.resgatarValores = function(){

		// Estrutura de resultado.
		$.getJSON( dominio+'projects.json', function(data){
			for(i=0; i<=data.length; i++){
				$("#projetos").append( "<option value='"+data[i].id+"'>"+data[i].name+"</option>" );
			}
		});

	}

}
// Objeto.
var obj = new json();
obj.resgatarValores();
