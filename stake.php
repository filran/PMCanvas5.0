<?php
session_start();
include("bd/User.php");

//SE VINDO DE INDEX.HTML
if( isset($_POST["submit"]) ){
	$_SESSION["projetos"] = $_POST["projetos"];
	$_SESSION["canvas_id"] = $_POST["canvas_id"];
}

//SE VINDO DO FORMULARIO DE ENVIO DE POSTITS
if( isset($_POST["submit-enviapostit"]) ){
#	$_SESSION["nome"] = $_POST["nome"];
#	$value_nome = $_SESSION["nome"];
#	echo $_SESSION["id"];
}else{
	$value_nome = "";
}

//SE TENTOU LOGAR
if( isset($_POST["submit-login"]) ){
	$user = new User();

	$logado = $user->login($_POST["login"],$_POST["email"]);
	if(!$logado){
		echo "erro";
	}else{
#		echo "ok";
		$_SESSION["id"] = $logado["id"];
		$_SESSION["login"] = $logado["login"];
		$_SESSION["email"] = $logado["email"];
		$_SESSION["nome"] = $logado["nome"];
		$_SESSION["foto"] = $logado["foto"];
		$_SESSION["canvas_id"] = $logado["canvas_id"];
	}
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
  </head>

<div id="dados" style="visibility:visible; position:none">
	<span id="dados_projeto" project_id="<?php echo $_SESSION['projetos']; ?>"></span>
	<span id="dados_canvas" canvas_id="<?php echo $_SESSION['canvas_id']; ?>"></span>
</div>
  
  <body style="margin:20px ; background-color:lightyellow">
    <div class="page-header">
	  <h1>Enviar Post-its</h1>
	</div>

<?php
	//se deseja cadastrar-se
	if( isset($_POST["submit-cad"]) ){
		$user = new User();
		$dados = $user->cadastrar( $_POST["cadlogin"], $_POST["cademail"], $_POST["cadnome"], "foto" );
		$logado = $user->login($_POST["cadlogin"],$_POST["cademail"]);
		
		$_SESSION["id"] = $logado["id"];
		$_SESSION["login"] = $logado["login"];
		$_SESSION["email"] = $logado["email"];
		$_SESSION["nome"] = $logado["nome"];
		$_SESSION["foto"] = $logado["foto"];
		$_SESSION["canvas_id"] = $logado["canvas_id"];

		header('Location: stake.php');
	}
?>

<?php

?>
	

<?php
	//SE CLICOU PARA CADASTRAR
	if( isset($_GET["cad"]) || isset($_POST["submit-edit"]) ){
	  if(isset($_POST["submit-edit"])){
	  	if( isset($_POST["submit-edit"]) ){
			$action="?cad=user";
			$titulo = "Editar dados";
		}else{
			$action="";
			$titulo = "Cadastre-se";
		}
	  }
?>
	<h3><?php echo $titulo; ?></h3>
	<form method="POST" id="form-cad" name="form-cad" action="<?php echo $action; ?>">
		<div class="form-group">
			<label for="cadlogin">Login</label>
			<input type="text" class="form-control" id="cadlogin" name="cadlogin" placeholder="">
	    </div>
	    <div class="form-group">
			<label for="cademail">E-mail</label>
			<input type="email" class="form-control" id="cademail" name="cademail" placeholder="">
	    </div>
	    <div class="form-group">
			<label for="cadnome">Nome</label>
			<input type="text" class="form-control" id="cadnome" name="cadnome" placeholder="">
	    </div>
	    <div class="form-group">
			<label for="cadfoto">Foto</label>
			<input type="file" class="form-control" id="cadfoto" name="cadfoto" placeholder="">
	    </div>
		<div class="form-group">
	    	<button type="submit" name="submit-cad" id="submit-cad" class="btn btn-primary btn-lg btn-block">Enviar dados</button>
    	</div>
	</form>

	<script type="text/javascript">
		$(function(){
			$("#submit-cad").click(function(){
				var login = $("#cadlogin").val();
				var email = $("#cademail").val();
				var nome = $("#cadnome").val();
				//var foto = $("$cadfoto").val();

				if( login=="" || email=="" || nome=="" ){
					alert("Digite os campos corretamente");
					return false;
				}
			});
		});
	</script>

<?php
	}else{

	if( !isset($_SESSION["id"]) ){
?>
	<form method="POST" id="form-login" name="form-login">
	  <div class="form-group">
		<button type="submit" class="btn btn-primary btn-lg btn-block"" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
<?php
		if( !isset($_GET["edit"]) ){
			echo "Identifique-se";
		}else{
			echo "Edite seus dados";
		}
			  
?>
		</button>
		<div class="collapse" id="collapseExample">
		  <div class="well">
			  <div class="form-group">
				<label for="login">Login</label>
				<input type="login" class="form-control" id="login" name="login" placeholder="" value="">
			  </div>
			  <div class="form-group">
				<label for="email">E-mail</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="" value="">
			  </div>
			  <div class="form-group">
				<a href="?cad=user">Cadastre-se</a> ou <a href="?edit=user">edite seus dados</a>.
			  </div>
<?php
			  if( !isset($_GET["edit"]) ){
			  
?>
			  <div class="form-group">
			  	<button type="submit" name="submit-login" id="submit-login" class="btn btn-primary btn-lg btn-block">Enviar</button>
			  </div>
<?php
			}else{
?>			  
			  <div class="form-group">
			  	<button type="submit" name="submit-edit" id="submit-edit" class="btn btn-primary btn-lg btn-block">Enviar dados</button>
			  </div>
<?php
			}
?>	
			  
			  <!--<div class="form-group">
				<label for="foto">Foto</label>
				<input type="file" id="foto" name="foto">
			  </div>-->
		  </div>
		</div>
	  </div>
	</form>

	<script type="text/javascript">
		$(function(){
			$("#submit-login").click(function(){
				var login = $("#login").val();
				var email = $("#email").val();

				if( login=="" || email=="" ){
					alert("Digite os campos corretamente");
					return false;
				}
			});
			$("#submit-edit").click(function(){
				var login = $("#login").val();
				var email = $("#email").val();

				if( login=="" || email=="" ){
					alert("Digite os campos corretamente");
					return false;
				}else{
					$("#form-login").attr("edit","ok");
				}
			});
		});
	</script>

<?php
	}else{
?>	
	<div class="form-group">
	<h4><?php echo "Bem-vindo, ".$_SESSION["nome"]."!"?></h4>	
	</div>
<?php
	}

     if( !isset($_GET["edit"]) ){		  
?>

	<form method="POST" id="form-enviapostit" name="form-enviapostit" teste="filipe">
	  <div class="form-group">
	    <label for="canvas_box">Escolha uma área do Canvas</label>
		<select id="canvas_box" class="form-control">
			<option value="0"></option>
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
	  </div>
	  <div class="form-group">
	    <label for="texto">Digite o texto do post-it</label>
	 	<textarea id="texto" class="form-control" rows="6"></textarea>
	 	<span><span id="content-countdown" title="150">150</span></span>
 	  </div>
	  <button type="submit" name="submit-enviapostit" id="submit-enviapostit" class="btn btn-primary btn-lg btn-block">Enviar</button>
	</form>
<?php } }?>
		<div class="form-group">
      <button type="submit" name="submit-voltar" id="submit-voltar" class="btn btn-primary btn-lg btn-block" style="background-color:lightblue; color:black">Sair do projeto</button>	
      </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="scripts/bootstrap/js/bootstrap.min.js"></script>

	<!--Mock-->
	<script type="text/javascript" src="scripts/mockjax/jquery.mockjax.js"></script>
	<script type="text/javascript" src="scripts/mockjax/lib/json2.js"></script> 

    <script type="text/javascript">
		$(function(){
			var dominio = "http://localhost/PMCanvas5.0/";
			//var dominio = "http://odysseus-lens.ddns.net/PMCanvas5.0/";
			var project_id = $("#dados_projeto").attr("project_id");
			var canvas_id  = $("#dados_canvas").attr("canvas_id"); 
			var url = dominio+"projects/"+project_id+"/canvas_projects/"+canvas_id+"/canvas_tickets.json";

		
			/*$("#submit-enviapostit").click(function(){
				var nome = $("#nome").val();
				var canvas_box = $("#canvas_box").val();
				var texto = $("#texto").val();
				
				if( nome=="" || canvas_box==0 || texto=="" ){
					alert("Digite os campos corretamente");
					return false;
				}else{
					$.mockjax({
					//$.ajax({
						url: url,
						type: "POST",
						dataType: "json",
						data: '{"text":"'+texto+'", "canvas_box_id":'+canvas_box+', "canvas_project_id":'+canvas_id+'}'
					});
					alert('Mock OK\n'+'{"text":"'+texto+'", "canvas_box_id":'+canvas_box+', "canvas_project_id":'+canvas_id+'}');
				}
			});*/

			$("#submit-voltar").click(function(){
				location.href=dominio;
			});
		
			//alert($("#form-enviapostit").attr("teste"));
		 
			/*
				Keyup é um evento que é disparado sempre que o usuário tirou o dedo da tecla.
				Ou seja, não queremos fazer nada quando o usuário clica, somente quando ele solta
				a tecla.
			*/
			$("textarea").keyup(function(event){		 
				// abaixo algumas variáveis que iremos utilizar.
				// pega a span onde esta a quantidade máxima de caracteres.
				var target    = $("#content-countdown");
				// pego pelo atributo title a quantidade maxima permitida.
				var max        = target.attr('title');
				// tamanho da string dentro da textarea.
				var len     = $(this).val().length;
				// quantidade de caracteres restantes dentro da textarea.
				var remain    = max - len;
				// caso a quantidade dentro da textarea seja maior que
				// a quantidade maxima.
				if(len > max)
				{
				    // abaixo vamos pegar tudo que tiver na string e limitar
				    // a quantidade de caracteres para o máximo setado.
				    // isso significa que qualquer coisa que seja maior que
				    // o máximo será cortado.
				    var val = $(this).val();
				    $(this).val(val.substr(0, max));
		 
				    // setamos o restante para 0.
				    remain = 0;
				}
				// atualizamos a quantidade de caracteres restantes.
				target.html(remain);
			});
		 
		});
    </script>
  </body>
</html>
