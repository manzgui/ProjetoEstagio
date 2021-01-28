<?php

$newcon = '
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
				<table class="ls-table ls-bg-header" id="tbContas">
					<thead>
						<tr>
							<th>Descrição</th>
							<th>Saldo</th>
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
                <h4 class="ls-modal-title">Conta Bancária</h4>
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
                        <label class="ls-label col-md-3 col-xs-12" id="lbSaldo">
                            <b class="ls-label-text">Saldo Inicial *</b>
                            <input type="text" id="txtSaldo" name="txtSaldo" class="ls-field ls-mask-money" value="0,00">
							<small style="display:none" class="ls-help-message" id="msgErroSaldo">Erro</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="ls-modal-footer">
                <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" data-dismiss="modal" value="Cancelar" onclick="limparCampos()">
                    <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarConta()">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
		window.onload = function(){
			carregaTabela();
        }
        function maskMoeda(valor)
        {
            valor = valor.replace(".", ",");
            valor = valor.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
            valor = valor.replace(/(\d)(\d{3}),/g, "$1.$2,");
            return valor;
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
                        $("#txtSaldo").val($(this).text());
					break;
				}
				cont++					
			});
			$("#txtCod").val(cod); 
			locastyle.modal.open("#modalCadastro");
		}	
		function carregaTabela()
		{
			$("#tbContas .trId").each(function(){
				$(this).remove();	
			});
			$.ajax({
				type: "POST",
				data: { filtroConta : $("#txtFiltro").val() },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
							var cols = "";
							cols += "<td>"+item.descricao+"</td>";
							cols += "<td>"+maskMoeda(item.saldo)+"</td>";
							cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
							newRow.append(cols);
							$("#tbContas").append(newRow);
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
			$("#msgErroSaldo").hide();
			$("#lbDescricao").removeClass("ls-error");
			$("#lbSaldo").removeClass("ls-error");
		}
		function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtDescricao").val("");
            $("#txtSaldo").val("");  
			escondeErros();
        }
        function salvarConta()
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
			if($("#txtSaldo").val() == "")
			{
				$("#lbSaldo").addClass("ls-error");
				$("#msgErroSaldo").text("Saldo inicial em branco.");
				$("#msgErroSaldo").show();
				erros++;
            }
            else
            if($("#txtSaldo").val().indexOf(",") == -1)
            {
                $("#lbSaldo").addClass("ls-error");
				$("#msgErroSaldo").text("Preencha casas decimais.");
				$("#msgErroSaldo").show();
				erros++;
            }
			if(erros == 0)
				$.ajax({
					type: "POST",
					data: {
						acao: "salvarConta",
						cod: $("#txtCod").val(),
                        descricao: $("#txtDescricao").val(),
                        saldo: $("#txtSaldo").val().replace(/\./g,"").replace(",",".")
					},
					url: "../utils/post.php",
					success: function(dados) {
						console.log("dados: "+dados);
						if(dados)
						{
							obj = JSON.parse(dados);
							$("#alertasModalTitulo").html("Conta");
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