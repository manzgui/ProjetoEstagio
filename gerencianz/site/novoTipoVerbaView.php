<?php

    $newver = '

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
				<table class="ls-table ls-bg-header" id="tbVerbas">
					<thead>
						<tr>
							<th>Descrição</th>
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
                <h4 class="ls-modal-title">Tipo de Verba</h4>
            </div>
            <div class="ls-modal-body">
                <div class="ls-form ls-form-horizontal">
                    <div class="row">
                        <input style="display:none" type="text" id="txtCod" value="0">
                        <label class="ls-label col-md-12 col-xs-12">
                            <b class="ls-label-text">Descrição *</b>
                            <input type="text" id="txtDescricao" name="txtDescricao" class="ls-field">
                            <small style="display:none" class="ls-help-message" id="msgErroDescricao">Erro</small>
                        </label>
					</div>
				</div>
            </div>
            <div class="ls-modal-footer">
                <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" data-dismiss="modal" value="Cancelar">
                    <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarTipoVerba()">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function(){
            carregaTabela();
        }
        function carregaTabela()
		{
			$("#tbVerbas .trId").each(function(){
				$(this).remove();	
			});
			$.ajax({
				type: "POST",
				data: { filtroTipoVerba : $("#txtFiltro").val() },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
							var cols = "";
							cols += "<td>"+item.descricao+"</td>";
							cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
							newRow.append(cols);
							$("#tbVerbas").append(newRow);
						});
					} 						
				},
				error : function(a,b,c){
					alert(\'Erro: \'+a[status]+\' \'+c);
				}
			});
        }
        function editCad(cod)
		{
			var cont = 1;
			$("#"+cod+" td").each(function(){
				switch(cont){
					case 1:
						$("#txtDescricao").val($(this).text());
					break;
				}
				cont++					
			});
			$("#txtCod").val(cod); 
			locastyle.modal.open("#modalCadastro");
		}	
		function escondeErros()
		{
			$("#msgErroDescricao").hide();
			$("#lbDescricao").removeClass("ls-error");
		}
        function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtDescricao").val("");
        }
        function salvarTipoVerba()
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
            else 
            if($("#txtDescricao").val().length < 3)
			{
				$("#lbDescricao").addClass("ls-error");
				$("#msgErroDescricao").text("Tamanho insuficiente (< 3).");
				$("#msgErroDescricao").show();
				erros++;
            }
            console.log($("#txtCod").val());
			if(erros == 0)
                $.ajax({
                    type: "POST",
                    data: {
                        acao: "salvarTipoVerba",
                        cod: $("#txtCod").val(),
                        descricao: $("#txtDescricao").val(),
                    },
                    url: "../utils/post.php",
                    success: function(dados) {
                        if(dados)
                        {
                            console.log(dados);
                            obj = JSON.parse(dados);
                            $("#alertasModalTitulo").html("Tipo de Verba");
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