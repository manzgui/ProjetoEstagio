<?php

$newtur = '
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
				<table class="ls-table ls-bg-header" id="tbTurmas">
					<thead>
						<tr>
							<th>Descrição</th>
							<th>Período</th>
							<th>Data de Criação</th>
							<th>Data de Fechamento</th>		
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
                <h4 class="ls-modal-title">Turma</h4>
            </div>
			<div class="ls-modal-body">
				<input style="display:none" type="text" id="txtCod" value="0">
                <div class="ls-form ls-form-horizontal">
					<div class="row">
						<input style="display:none" type="text" id="txtCod" value="0">
                        <label class="ls-label col-md-12 col-xs-12" id="lbDescricao">
                            <b class="ls-label-text">Descrição *</b>
                            <input type="text" id="txtDescricao" name="txtDescricao" class="ls-field">
							<small style="display:none" class="ls-help-message" id="msgErroDescricao">Erro Descricao</small>
						</label>
                    </div>
                    <div class="row">
                        <label class="ls-label col-md-4 col-xs-12" id="lbPeriodo">
                            <b class="ls-label-text">Período  *</b>
                            <div class="ls-custom-select">    
                                <select class="ls-custom" id="cbbPeriodo" name="cbbPeriodo">
                                    <option value="0"></option>
                                    <option value="M">Matutino</option>
                                    <option value="V">Vespertino</option>
                                </select>
							</div>
							<small style="display:none" class="ls-help-message" id="msgErroPeriodo">Erro Periodo</small>
                        </label>
                        <label class="ls-label col-md-4 col-xs-12" id="lbCriacao">
                            <b class="ls-label-text">Data de Criação *</b>
                            <div class="ls-prefix-group">
                                <input type="date" id="txtCriacao" name="txtCriacao" class="datepicker ls-daterange ls-mask-date" placeholder="dd/mm/aaaa" data-ls-daterange="#txtFechamento">
                                <a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtCriacao" href="#"></a>
							</div>
							<small style="display:none" class="ls-help-message" id="msgErroCriacao">Erro Criacao</small>
                        </label>
                        <label class="ls-label col-md-4 col-xs-12" id="lbFechamento">
                            <b class="ls-label-text">Data de Fechamento</b>
                            <div class="ls-prefix-group">
                                <input type="date" id="txtFechamento" name="txtFechamento" class="datepicker ls-daterange ls-mask-date" placeholder="dd/mm/aaaa">
                                <a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtFechamento" href="#"></a>
							</div>
							<small style="display:none" class="ls-help-message" id="msgErroFechamento">Erro Fechamento</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="ls-modal-footer">
                <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" data-dismiss="modal" value="Cancelar" onclick="limparCampos()">
                    <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarTurma()">
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
						$("#cbbPeriodo").val($(this).text().substring(0, 1));
					break;
					case 3:
						$("#txtCriacao").val($(this).text());
					break;
					case 4:
						$("#txtFechamento").val($(this).text());
					break;
				}
				cont++					
			});
			$("#txtCod").val(cod); 
			locastyle.modal.open("#modalCadastro");
		}	
		function carregaTabela()
		{
			$("#tbTurmas .trId").each(function(){
				$(this).remove();	
			});
			$.ajax({
				type: "POST",
				data: { filtroTurma : $("#txtFiltro").val() },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
							var cols = "";
							cols += "<td>"+item.descricao+"</td>";
							cols += "<td>"+item.periodo+"</td>";
							cols += "<td>"+item.criacao+"</td>";
							cols += "<td>"+item.fechamento+"</td>";
							cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
							newRow.append(cols);
							$("#tbTurmas").append(newRow);
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
			$("#msgErroPeriodo").hide();
			$("#msgErroCriacao").hide();
			$("#msgErroFechamento").hide();
			$("#lbDescricao").removeClass("ls-error");
			$("#lbPeriodo").removeClass("ls-error");
			$("#lbCriacao").removeClass("ls-error");
			$("#lbFechamento").removeClass("ls-error");
		}
		function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtDescricao").val("");
            $("#cbbPeriodo").val("0");  
            $("#txtCriacao").val("");  
			$("#txtFechamento").val("");
			escondeErros();
        }
        function salvarTurma()
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
			if($("#cbbPeriodo").val() == "0")
			{
				$("#lbPeriodo").addClass("ls-error");
				$("#msgErroPeriodo").text("Período em branco.");
				$("#msgErroPeriodo").show();
				erros++;
			}
			if($("#txtCriacao").val() == "")
			{
				$("#lbCriacao").addClass("ls-error");
				$("#msgErroCriacao").text("Criação em branco.");
				$("#msgErroCriacao").show();
				erros++;
			}
			else
			if($("#txtCriacao").val().length != 10)
			{
				$("#lbCriacao").addClass("ls-error");
				$("#msgErroCriacao").text("Formato incorreto.");
				$("#msgErroCriacao").show();
				erros++;
			}
			else
			if($("#txtCriacao").val().substring(0, 2) > "31" ||  $("#txtCriacao").val().substring(0, 2) < "01")
			{
				$("#lbCriacao").addClass("ls-error");
				$("#msgErroCriacao").text("Dia inexistente.");
				$("#msgErroCriacao").show();
				erros++;
			}
			else
			if($("#txtCriacao").val().substring(3, 5) > "12" ||  $("#txtCriacao").val().substring(3, 5) < "01")
			{
				$("#lbCriacao").addClass("ls-error");
				$("#msgErroCriacao").text("Mês inexistente.");
				$("#msgErroCriacao").show();
				erros++;
			}
			else
			if($("#txtCriacao").val().substring(6, 10) < "1900")
			{
				$("#lbCriacao").addClass("ls-error");
				$("#msgErroCriacao").text("Ano inválido.");
				$("#msgErroCriacao").show();
				erros++;
			}
			if($("#txtFechamento").val().length > 0 && $("#txtFechamento").val().length != 10)
			{
				$("#lbFechamento").addClass("ls-error");
				$("#msgErroFechamento").text("Formato incorreto.");
				$("#msgErroFechamento").show();
				erros++;
            }
            else
			if($("#txtFechamento").val().length > 0 && ($("#txtFechamento").val().substring(0, 2) > "31" ||  $("#txtFechamento").val().substring(0, 2) < "01"))
			{
				$("#lbFechamento").addClass("ls-error");
				$("#msgErroFechamento").text("Dia inexistente.");
				$("#msgErroFechamento").show();
				erros++;
			}
			else
			if($("#txtFechamento").val().length > 0 && ($("#txtFechamento").val().substring(3, 5) > "12" ||  $("#txtFechamento").val().substring(3, 5) < "01"))
			{
				$("#lbFechamento").addClass("ls-error");
				$("#msgErroFechamento").text("Mês inexistente.");
				$("#msgErroFechamento").show();
				erros++;
			}
			else
			if($("#txtFechamento").val().length > 0 && $("#txtFechamento").val().substring(6, 10) < "1900")
			{
				$("#lbFechamento").addClass("ls-error");
				$("#msgErroFechamento").text("Ano inválido.");
				$("#msgErroFechamento").show();
				erros++;
            }
            else
			if($("#txtFechamento").val().length > 0 && $("#txtCriacao").val() >= $("#txtFechamento").val())
			{
				$("#lbFechamento").addClass("ls-error");
				$("#msgErroFechamento").text("Criação maior que fechamento.");
				$("#msgErroFechamento").show();
				erros++;
			}
			if(erros == 0)
				$.ajax({
					type: "POST",
					data: {
						acao: "salvarTurma",
						cod: $("#txtCod").val(),
						descricao: $("#txtDescricao").val(),
						periodo: $("#cbbPeriodo option:selected").text(),
						datacriacao: $("#txtCriacao").val(),
						datafechamento: $("#txtFechamento").val(),
					},
					url: "../utils/post.php",
					success: function(dados) {
						console.log("dados: "+dados);
						if(dados)
						{
							obj = JSON.parse(dados);
							$("#alertasModalTitulo").html("Turma");
							$("#alertasModalTexto").html(obj.retorno);
							$("#alertasModal").show();
                            if(obj.retorno)
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