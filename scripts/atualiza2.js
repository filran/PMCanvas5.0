//LÊ TODOS OS POSTITS DO CANVAS E VERIFICA SE HÁ ALGUM NOVO NO BANCO DE DADOS E ATUALIZA AUTOMATICAMENTE


(function atualiza(){
	var dominio = "http://localhost/PMCanvas4.0/";
	var time = 5000;
	var dominio = "http://localhost/PMCanvas4.0/";
	var project_id = $("#dados_projeto").attr("project_id");
	var canvas_id  = $("#dados_canvas").attr("canvas_id");
	var url = dominio+"projects/"+project_id+"/canvas_project/"+canvas_id+"/canvas_tickets.json";
	var postit_bd_id = [];
	var postit_canvas_id = [];
	var postit_equal = []; //armazena os indices dos postits iguais (postit_bd_id)
	var resp = "";

	//alert(project_id+" | "+canvas_id+" | "+url); //TESTE
	//$("body").append(url); //TESTE


	
	$.getJSON(url,function(data){
		
		//1- ler todos os postits do BD
		for( i=0; i<data.length; i++ ){
			postit_bd_id[i] = data[i].id;
//			alert(postit_bd_id[i]); //TESTE
		}

		//2- ler todos os postits do canvas
		setTimeout(function(){
			$("#area .postit").each(function(index){
	//			alert( index ); //TESTE
				postit_canvas_id[index] = $(this).attr("postit-id");
//				alert( postit_canvas_id[index] );
			});

			//3- comparar se algum postit foi acrescentado
			for( i=0; i<postit_bd_id.length; i++ ){
	//			alert( postit_bd_id[i] );
				for( j=0; j<postit_canvas_id.length; j++  ){
//					alert( postit_canvas_id[j] );
					if( postit_canvas_id[j] == postit_bd_id[i] ){
//						$("li[postit-id='"+postit_canvas_id[j]+"']").css("background-color","red"); //TESTE
//						resp+= postit_bd_id[i]+" = "+postit_canvas_id[j]+"\n"; //TESTE
						postit_equal.push( postit_bd_id[i] );
					}
				}
			}
		
			//TESTE
//			$.each( postit_equal , function(k,v){
//				resp+= k+"-"+v+"\n";
//			});


			if( postit_equal.length > 0 ){
				for( i=0; i<postit_equal.length; i++ ){
					//remove os postits antigos e deixa somente os novos
					index = postit_bd_id.indexOf( postit_equal[i] );
					postit_bd_id.splice(index, 1);
				}
			}

			//TESTE
//			if( postit_bd_id.length > 0 ){
//				$.each( postit_bd_id , function( k, v ) {
//					resp+=k+"-"+v+"\n";
//				});
//			}
//	
//			alert(resp);

		},time);
	});


	//4- tempo para atualizar
	setTimeout(atualiza,time);
}());

