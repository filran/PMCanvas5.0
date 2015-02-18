<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8"/>

	<style>

		body{
			font-family:"Arial";
			margin:0;
			padding:0;
			overflow:hidden;     
			background: -webkit-radial-gradient(ellipse cover, #fff, #bbb); /*web kit*/
			background: -moz-radial-gradient(ellipse cover, #fff, #bbb);/*mozilla*/
			background: -ms-radial-gradient(circle cover, #fff, #bbb); /*internet explorer*/
		}

		#main{
			background-color:;
			width:700px;
			height:250px;
			position:absolute;
			margin-top:-125px;
			margin-left:-350px;
			top:50%;
			left:50%;
			text-align:center;
		}

		#formulario{
			background-color: lightyellow;
			width: 300px;
			height: 500px;
			
			position:absolute;
			margin-top:-250px;
			margin-left:-150px;
			top:50%;
			left:50%;
		}

	</style>

    <!--jQuery + jQuery UI-->
    <!--jQuery 1.8-->
<!--	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>-->
<!--	<script type="text/javascript">-->
<!--	    var jq18 = jQuery.noConflict();-->
<!--    </script>-->
        
    <!--jQuery 2.1-->
    <script type="text/javascript" src="scripts/jquery/jquery-2.1.0.js"></script>        
    <script type="text/javascript" src="scripts/jquery-ui/jquery-ui-1.10.4.custom.js"></script>
    <link type="text/css" rel="stylesheet" href="scripts/jquery-ui/jquery-ui-1.10.4.custom.css">

	<script type="text/javascript">
		$(function(){
			var dominio = "http://localhost/PMCanvas4.0/";
			var project_id = $("#dados_projeto").attr("project_id");
			var canvas_id  = $("#dados_canvas").attr("canvas_id"); 
		
			/*function json_envia_postit( project_id, canvas_id, canvas_box_id, texto ){
				var url = dominio+"projects/"+project_id+"/canvas_projects/"+canvas_id+"/canvas_tickets.json";
				$.ajax({
					type: "POST",
					dataType: "json",
					url: url,
					data: {"canvas_box_id":canvas_box_id, "canvas_project_id":canvas_id, "text":texto}
				});
			}*/

			function PreviewImage(no) {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);
				oFReader.onload = function (oFREvent) {
					document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
				}		
			});
	</script> 

</head>
<body>
<div id="dados" style="visibility:visible; position:none">
	<span id="dados_projeto" project_id="<?php echo $_POST['projetos']; ?>"></span>
	<span id="dados_canvas" canvas_id="<?php echo $_POST['canvas_id']; ?>"></span>
</div>

<div id="formulario">
		<div id="identificacao">
			<img id="uploadPreview1" src="imagens/no_image.jpg" /><br />
        	<input id="uploadImage1" type="file" name="p1" onchange="PreviewImage(1);" />
        	
			<span id="name" contenteditable="true" autofocus>Digite seu nome</span>
		</div>

	<form method="POST" action="">	
		<select id="canvas_box">
			<option value="0">Escolha uma área do Canvas</option>
			<option value="0">--------</option>
			<option value="1">Justificativas</option>
			<option value="2">Obj Smart</option>
			<option value="3">Benefícios</option>
			<option value="4">Produto</option>
			<option value="5">Requisitos</option>
			<option value="6">Stakeholders</option>
			<option value="8">Equipe</option>
			<option value="7">Premissas</option>
			<option value="9">Grupo de Entregas</option>
			<option value="10">Restrições</option>
			<option value="11">Riscos</option>
			<option value="12">Linha do Tempo</option>
			<option value="13">Custos</option>
		</select>

		<br><textarea name="texto"></textarea>

		<br><input type="submit" name="submit" value="Enviar"/>
	</form>
</div>
</body>
</html>
