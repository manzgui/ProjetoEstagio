<?php

$newmat = '
    <div class="ls-form ls-form-horizontal">
        <div class="row">
            <label class="ls-label col-md-8 col-xs-12">
                <b class="ls-label-text">Filtro: </b>
                <input type="text" id="txtFiltro" name="txtFiltro" class="ls-field">
            </label>
            <label class="ls-label col-md-2 col-xs-12">
				<b class="ls-label-text" style="display:none">a</b>
				<button id="btnFiltrar" name="btnFiltrar" class="ls-btn ls-ico-search ls-btn-block"> Filtrar</button>
            </label>
			<label class="ls-label col-md-2 col-xs-12">
				<b class="ls-label-text" style="display:none">a</b>
			    <button data-ls-module="modal" data-target="#modalCadastro" class="ls-btn-primary ls-btn-block ls-ico-plus" onclick="limparCampos()">Novo</button>
            </label>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="ls-table ls-bg-header" id="tbMateriais">
					<thead>
						<tr>
							<th>Descrição</th>
							<th>Itens em Estoque</th>
							<th>Unidade de Medida</th>
							<th></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
    </div>
        
    <div class="ls-modal" id="modalCadastro" data-ls-module="form">
        <div class="ls-modal-large">
            <div class="ls-modal-header">
                <button onclick="limparCampos()" data-dismiss="modal">&times;</button>
                <h4 class="ls-modal-title">Tipo de Material</h4>
            </div>
			<div class="ls-modal-body">
                <div class="ls-form ls-form-horizontal">
					<div class="row">
						<input style="display:none" type="text" id="txtCod" value="0">
                        <label class="ls-label col-md-6 col-xs-12" id="lbDescricao">
                            <b class="ls-label-text">Descrição *</b>
                            <input type="text" id="txtDescricao" name="txtDescricao" class="ls-field">
							<small style="display:none" class="ls-help-message" id="msgErroDescricao">Erro</small>
                        </label>
                        <label class="ls-label col-md-3 col-xs-12" id="lbEstoque">
                            <b class="ls-label-text">Estoque Inicial *</b>
                            <input type="number" id="txtEstoque" name="txtEstoque" class="ls-field" value="0">
							<small style="display:none" class="ls-help-message" id="msgErroEstoque">Erro</small>
                        </label>
                        <label class="ls-label col-md-3 col-xs-12" id="lbUnidade">
                            <b class="ls-label-text">Unidade de Medida  *</b>
                            <div class="ls-custom-select">    
                                <select class="ls-custom" id="cbbUnidade" name="cbbUnidade">
                                    <option value="0"></option>
                                    <option value="K">KG - Quilograma</option>
                                    <option value="M">M - Metro</option>
                                    <option value="C">CX - Caixa</option>
                                    <option value="L">Lt - Lote</option>
                                    <option value="U">Un - Unidade</option>
                                </select>
							</div>
							<small style="display:none" class="ls-help-message" id="msgErroUnidade">Erro</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="ls-modal-footer">
                <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" data-dismiss="modal" value="Cancelar" onclick="limparCampos()">
                    <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarMaterial()">
                </div>
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
						$("#txtDescricao").val($(this).text());
					break;
					case 2:
                        $("#txtEstoque").val($(this).text());
					break;
					case 3:
                        $("#cbbUnidade").val($(this).text().substring(0, 1));
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
				data: { filtroTipoMaterial : $("#txtFiltro").val() },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
							var cols = "";
							cols += "<td>"+item.descricao+"</td>";
							cols += "<td>"+item.estoque+"</td>";
							cols += "<td>"+item.unidade+"</td>";
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
			$("#msgErroDescricao").hide();
			$("#msgErroEstoque").hide();
			$("#msgErroUnidade").hide();
			$("#lbDescricao").removeClass("ls-error");
			$("#lbEstoque").removeClass("ls-error");
			$("#lbUnidade").removeClass("ls-error");
		}
		function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtDescricao").val("");
            $("#txtEstoque").val("0");  
            $("#cbbUnidade").val("0");
			escondeErros();
        }
        function salvarMaterial()
        {
			escondeErros();
			erros = 0;
			if($("#txtDescricao").val() == "")
			{
				$("#lbDescricao").addClass("ls-error");
				$("#msgErroDescricao").text("Descrição em branco.");
				$("#msgErroDescricao").show();
				erros++;
			}
			if($("#cbbUnidade").val() == "0")
			{
				$("#lbPeriodo").addClass("ls-error");
				$("#msgErroPeriodo").text("Unidade de medida em branco.");
				$("#msgErroPeriodo").show();
				erros++;
			}
			if($("#txtEstoque").val() == "")
			{
				$("#lbCriacao").addClass("ls-error");
				$("#msgErroCriacao").text("Estoque inicial em branco.");
				$("#msgErroCriacao").show();
				erros++;
            }
            console.log($("#txtCod").val());
			if(erros == 0)
				$.ajax({
					type: "POST",
					data: {
						acao: "salvarTipoMaterial",
						cod: $("#txtCod").val(),
                        descricao: $("#txtDescricao").val(),
                        estoque: $("#txtEstoque").val(),
						unidade: $("#cbbUnidade option:selected").text().substring(0, 2).trim()
					},
					url: "../utils/post.php",
					success: function(dados) {
						console.log("dados: "+dados);
						if(dados)
						{
							obj = JSON.parse(dados);
							$("#alertasModalTitulo").html("Material");
							$("#alertasModalTexto").html(obj.retorno);
							$("#alertasModal").show();
							if(obj.condicao)
                            {
                                limparCampos();
                                carregaTabela();
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