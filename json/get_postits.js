//Obtem todos os projetos

// Classe para chamar o Json.
function json(){
	//Ex: "http://qualiept.iff.edu.br/"
	var dominio = "http://localhost/PMCanvas4.0/";

	// Resgatar valores.
	json.prototype.resgatarValores = function(){

		var boxes = {1:"just", 2:"obj", 3:"beneficios", 4:"prod", 5:"requisitos", 6:"stake", 7:"premissas", 8:"equipe", 9:"entregas", 10:"restricoes", 11:"riscos", 12:"tempo", 13:"custos"};
		var project_id = $("#dados_projeto").attr("project_id");
		var canvas_id = $("#dados_canvas").attr("canvas_id");
		//$( "#just .receberpostit").append('<li postit-id="" class="postit" autor="" areacandidata="" style="display: block; z-index: 1;">TESTE</li>');

		// Estrutura de resultado.
		//http://localhost/PMCanvas4.0/projects/7/canvas_project/8/canvas_tickets.json
		$.getJSON( dominio+'projects/'+project_id +'/canvas_project/'+canvas_id+'/canvas_tickets.json', function(data){
			for(i=0; i<=data.length; i++){
				var box_id = data[i].canvas_box_id;
				var postit_html = '<li postit-id="'+data[i].id+'" class="postit" autor="" areacandidata="" style="display: block; z-index: 1;">'+data[i].text+'</li>';

				//JUST
				if( box_id == 1 ){
					$("#just .receberpostit").append(postit_html);
				}else if( box_id == 2 ){
					$("#obj .receberpostit").append(postit_html);
				}else if( box_id == 3 ){
					$("#beneficios .receberpostit").append(postit_html);
				}else if( box_id == 4 ){
					$("#prod .receberpostit").append(postit_html);
				}else if( box_id == 5 ){
					$("#requisitos .receberpostit").append(postit_html);
				}else if( box_id == 6 ){
					$("#stake .receberpostit").append(postit_html);
				}else if( box_id == 7 ){
					$("#premissas .receberpostit").append(postit_html);
				}else if( box_id == 8 ){
					$("#equipe .receberpostit").append(postit_html);
				}else if( box_id == 9 ){
					$("#entregas .receberpostit").append(postit_html);
				}else if( box_id == 10 ){
					$("#restricoes .receberpostit").append(postit_html);
				}else if( box_id == 11 ){
					$("#riscos .receberpostit").append(postit_html);
				}else if( box_id == 12 ){
					$("#tempo .receberpostit").append(postit_html);
				}else if( box_id == 13 ){
					$("#custos .receberpostit").append(postit_html);
				}
				

				//$( "#"+boxes[data[i].canvas_box_id]+" .receberpostit").append('<li postit-id="'+data[i].id+'" class="postit" autor="" areacandidata="" style="display: block; z-index: 1;">'+data[i].text+'</li>');
			}
		});

	}

}

// Objeto.
var obj1 = new json();
obj1.resgatarValores();
