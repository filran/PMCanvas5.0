<div id="dados" name="dados">
	<span id="arquivo" name="arquivo" arquivo="<?php echo $arquivo = 'bd.json'; ?>"></span>
</div>

<?php

$open = fopen($arquivo,"a+");

?>

<!--jQuery 2.1-->
<script type="text/javascript" src="scripts/jquery/jquery-2.1.0.js"></script>         
<script type="text/javascript" src="scripts/jquery-ui/jquery-ui-1.10.4.custom.js"></script>
<link type="text/css" rel="stylesheet" href="scripts/jquery-ui/jquery-ui-1.10.4.custom.css">

<script type="text/javascript">
$(function(){

	var url = $("#arquivo").attr("arquivo");
	//alert(url);

	$.ajax({
		url:url,
		type:"GET",
		dataType: "json",
		success: function(json){
			alert(json.nome);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
        	alert("Erro!");
    	}
	});

});
</script>
