<?php

$entradm = '
	<div class="ls-form ls-form-horizontal" data-ls-module="form">
		<input style="display:none" type="text" id="txtCod" name="txtCod" value="0">
        <div class="row">
			<label class="ls-label col-md-3 col-xs-12" id="lbData">
                <b class="ls-label-text">Data *</b>
				<div class="ls-prefix-group">
					<input type="text" id="txtData" name="txtData" class="datepicker ls-mask-date" placeholder="dd/mm/aaaa" value="">
					<a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtData" href="#"></a>
				</div>
				<small style="display:none" class="ls-help-message" id="msgErroData">Erro</small>
            </label>
            <div class="col-md-2 col-xs-2">
                <button id="btnIniciarEntrada" name="btnIniciarEntrada" class="ls-btn ls-btn-primary" onclick="salvarEntrada()">Lançar Itens</button>
            </div>
        </div>
        <div class="row" id="divItens" style="display:none">
			<label class="ls-label col-md-4 col-xs-12" id="lbMateriais">
                <b class="ls-label-text">Material</b>
				<div class="ls-custom-select">
					<select class="ls-custom" id="cbbMateriais" name="cbbMateriais">
						<option value="0"></option>
						'.getTiposMaterialCbb().'
					</select>
				</div>
				<small style="display:none" class="ls-help-message" id="msgErroMateriais">Erro</small>
			</label>
			<label class="ls-label col-md-2 col-xs-5" id="lbQuantidade">
				<b class="ls-label-text">Quantidade *</b>
				<input type="text" id="txtQuantidade" name="txtQuantidade" class="ls-field ls-mask-number">
				<small style="display:none" class="ls-help-message" id="msgErroQuantidade">Erro</small>
			</label>
			<label class="ls-label col-md-3 col-xs-5" id="lbValor">
				<b class="ls-label-text">Valor</b>
				<input type="text" id="txtLote" name="txtValor" class="ls-field ls-mask-money">
				<small style="display:none" class="ls-help-message" id="msgErroValor">Erro</small>
            </label>
            <div class="col-md-2 col-xs-2">
                <button id="btnAddItem" name="btnAddItem" class="ls-btn ls-btn-primary ls-ico-plus" onclick="lineTb(1,\'\')"></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <table class="ls-table ls-no-margin-top" id="tbItens">
                    <tbody></tbody>
                </table>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="ls-float-right">
					<input type="button" class="ls-btn" data-dismiss="modal" value="Cancelar" onclick="limparCampos()">
					<input type="button" class="ls-btn-primary" id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarItens()">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<table class="ls-table ls-bg-header" id="tbMateriais">
					<thead>
						<tr>
							<th>Data</th>
							<th>Material</th>
							<th>Valor</th>		
							<th></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		window.onload = function(){
			carregaTabela();
		}
		function editCad(cod)
		{
			var cont = 1;
			$("#"+cod+" td").each(function(){
				switch(cont){
					case 1:
						$("#txtData").val($(this).text());
					break;
					case 2:
						$("#cbbMateriais").val($(this).text());
					break;
					case 3:
						$("#txtQuantidade").val($(this).text());
					break;
					case 4:
						$("#txtLote").val($(this).text());
					break;
				}
				cont++					
			});
			$("#txtCod").val(cod); 
			locastyle.modal.open("#modalCadastro");
		}	
		function carregaTabela()
		{
			$("#tbMateriais .trId").each(function(){
				$(this).remove();	
			});
			$.ajax({
				type: "POST",
				data: { filtroMaterial : $("#txtFiltro").val() },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
							var cols = "";
							cols += "<td>"+item.data+"</td>";
							cols += "<td>"+item.material+"</td>";
							cols += "<td style=\'display:none\'>"+item.materialcod+"</td>";
							cols += "<td>"+item.quantidade+"</td>";
							cols += "<td>"+item.lote+"</td>";
							cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
							newRow.append(cols);
							$("#tbMateriais").append(newRow);
						});
					} 						
				},
				error : function(a,b,c){
					alert(\'Erro: \'+a[status]+\' \'+c);
				}
			});
		}
		function escondeErros()
		{
			$("#msgErroData").hide();
			$("#msgErroMateriais").hide();
			$("#msgErroQuantidade").hide();
			$("#msgErroLote").hide();
			$("#lbData").removeClass("ls-error");
			$("#lbMateriais").removeClass("ls-error");
			$("#lbQuantidade").removeClass("ls-error");
			$("#lbLote").removeClass("ls-error");
		}
		function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtData").val("");
            $("#cbbMateriais").val("0");  
            $("#txtQuantidade").val("");  
			$("#txtLote").val("");
			escondeErros();
		}
		function salvarEntrada()
        {
			escondeErros();
			erros = 0;
			now = new Date;
			now.setMonth(now.getMonth() + 1);
			dia = now.getDate() > 0 && now.getDate() < 10 ? "0"+now.getDate() : now.getDate();
			mes = now.getMonth() > 0 && now.getMonth() < 10 ? "0"+now.getMonth() : now.getMonth();
			if($("#txtData").val() == "")
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Data em branco.");
				$("#msgErroData").show();
				erros++;
			}
			else
			if($("#txtData").val().length != 10)
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Formato incorreto.");
				$("#msgErroData").show();
				erros++;
			}
			else
			if($("#txtData").val().substring(0, 2) > "31" ||  $("#txtData").val().substring(0, 2) < "01")
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Dia inexistente.");
				$("#msgErroData").show();
				erros++;
			}
			else
			if($("#txtData").val().substring(3, 5) > "12" ||  $("#txtData").val().substring(3, 5) < "01")
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Mês inexistente.");
				$("#msgErroData").show();
				erros++;
			}
			else
			if($("#txtData").val().substring(6, 10) > now.getFullYear())
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Data futura.");
				$("#msgErroData").show();
				erros++;
			}
			else
			if($("#txtData").val().substring(6, 10) < "1900")
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Ano inválido.");
				$("#msgErroData").show();
				erros++;
			}
			else
			if($("#txtData").val().substring(6, 10) == now.getFullYear() && $("#txtData").val().substring(3, 5) == mes && $("#txtData").val().substring(0, 2) > dia)
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Data futura.");
				$("#msgErroData").show();
				erros++;
			}
			else
			if($("#txtData").val().substring(6, 10) == now.getFullYear() && $("#txtData").val().substring(3, 5) > mes)
			{
				$("#lbData").addClass("ls-error");
				$("#msgErroData").text("Data futura.");
				$("#msgErroData").show();
				erros++;
			}
			if(erros == 0)
				$.ajax({
					type: "POST",
					data: {
						acao: "salvarEntrada",
						cod: $("#txtCod").val(),
						data: $("#txtData").val()
					},
					url: "../utils/post.php",
					success: function(dados) {
						console.log("dados: "+dados);
						if(dados)
						{
                            obj = JSON.parse(dados);
                            if(obj.retorno)
                                $("#divItens").show();
                            else
                            {
                                $("#alertasModalTitulo").html("Entrada de Material");
							    $("#alertasModalTexto").html(obj.retorno);
                                $("#alertasModal").show();
                                $("#divItens").hide();
                            }
						}
					},
					error : function(a,b,c){
						alert(\'Erro: \'+a[status]+\' \'+c);
					}
				});
        }
    </script>
	';
?>