var dominio = "http://localhost/PMCanvas5.0/";
//var dominio = "http://odysseus-lens.ddns.net/PMCanvas5.0/";

$.getJSON(dominio+"projects.json",function(data){
	var project_id = [];
	var project_name = [];

	for(i=0; i<data.length; i++){
		project_id[i] = data[i].id;
		project_name[i] = data[i].name;
		$("#projetos").append('<option value="'+project_id[i]+'">'+project_name[i]+'</option>');
	}
});
