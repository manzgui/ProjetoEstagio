<?php

$newati = '
    <div class="ls-form ls-form-horizontal">
			<div class="row">
				<label class="ls-label col-md-8 col-xs-12">
					<b class="ls-label-text">Filtro: </b>
					<input type="text" id="txtFiltro" name="txtFiltro" class="ls-field">
				</label>
				<label class="ls-label col-md-2 col-xs-12">
					<b class="ls-label-text" style="display:none">a</b>
					<button id="btnFiltrar" name="btnFiltrar" class="ls-btn ls-ico-search ls-btn-block" onclick="carregaTabela()"> Filtrar</button>
				</label>
				<label class="ls-label col-md-2 col-xs-12">
					<b class="ls-label-text" style="display:none">a</b>
					<button data-ls-module="modal" data-target="#modalCadastro" class="ls-btn-primary ls-btn-block ls-ico-plus" onclick="limparCampos()">Novo</button>
				</label>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="ls-table ls-bg-header" id="tbAtividades">
						<thead>
							<tr>
								<th>Atividade</th>
								<th>Professor / Responsável</th>		
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
                <button data-dismiss="modal" onclick="limparCampos()">&times;</button>
                <h4 class="ls-modal-title">Tipo de Atividade</h4>
            </div>
            <div class="ls-modal-body">
                <div class="ls-form ls-form-horizontal">
					<input style="display:none" type="text" id="txtCod" name="txtCod" value="0">
					<div class="row">
                        <label class="ls-label col-md-4 col-xs-12" id="lbDescricao">
                            <b class="ls-label-text">Descrição *</b>
							<input type="text" id="txtDescricao" name="txtDescricao" class="ls-field">
							<small style="display:none" class="ls-help-message" id="msgErroDescricao">Erro</small>
						</label>
						<label class="ls-label col-md-4 col-xs-12" id="lbProfessores">
                            <b class="ls-label-text">Professor / Responsável *</b>
                            <div class="ls-custom-select">
                                <select class="ls-custom" id="cbbProfessores" name="cbbProfessores">
                                    <option value="0"></option>
                                    '.getProfissionaisCbb().'
                                </select>
							</div>
							<small style="display:none" class="ls-help-message" id="msgErroProfessores">Erro Nome</small>
                        </label>
                        <label class="ls-label col-md-4 col-xs-12" id="lbStatus">
                            <b class="ls-label-text">Status *</b>
                            <div class="ls-custom-select">    
                                <select class="ls-custom" id="cbbStatus" name="cbbStatus">
                                    <option value="A" selected>Ativa</option>
                                    <option value="I">Inativa</option>
                                </select>
							</div>
							<small style="display:none" class="ls-help-message" id="msgErroStatus">Erro</small>
                        </label>
					</div>
				</div>
            </div>
            <div class="ls-modal-footer">
                <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" data-dismiss="modal" onclick="limparCampos()" value="Cancelar">
                    <input type="button" class="ls-btn-primary" id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarTipoAtividade()">
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
						$("#cbbProfessores").val($(this).text());
					break;
					case 3:
						$("#cbbStatus").val($(this).text());
					break;
				}
				cont++					
			});
			$("#txtCod").val(cod); 
			locastyle.modal.open("#modalCadastro");
		}
		function carregaTabela()
		{
			$("#tbAtividades .trId").each(function(){
				$(this).remove();	
			});
			$.ajax({
				type: "POST",
				data: { filtroTipoAtividade : $("#txtFiltro").val() },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
							var cols = "";
							cols += "<td>"+item.descricao+"</td>";
							cols += "<td style=\'display:none\'>"+item.professorcod+"</td>";
							cols += "<td style=\'display:none\'>"+item.status+"</td>";
							cols += "<td>"+item.professor+"</td>";
							cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
							newRow.append(cols);
							$("#tbAtividades").append(newRow);
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
			$("#msgErroProfessores").hide();
			$("#msgErroStatus").hide();
			$("#lbDescricao").removeClass("ls-error");
			$("#lbProfessores").removeClass("ls-error");
			$("#lbStatus").removeClass("ls-error");
		}
		function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtDescricao").val("");
			$("#cbbStatus").val("A");
			$("#cbbProfessores").val("0");
			escondeErros();
        }
        function salvarTipoAtividade()
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
			if($("#cbbStatus option:selected").val() == "0")
			{
				$("#lbStatus").addClass("ls-error");
				$("#msgErroStatus").text("Status em branco.");
				$("#msgErroStatus").show();
				erros++;
			}
			if($("#cbbProfessores option:selected").val() == "0")
			{
				$("#lbProfessores").addClass("ls-error");
				$("#msgErroProfessores").text("Professor em branco.");
				$("#msgErroProfessores").show();
				erros++;
			}
			if(erros == 0)	
				$.ajax({
					type: "POST",
					data: {
						acao: "salvarTipoAtividade",
						cod: $("#txtCod").val(),
						descricao: $("#txtDescricao").val(),
						status: $("#cbbStatus option:selected").val(),
						professor: $("#cbbProfessores option:selected").val()
					},
					url: "../utils/post.php",
					success: function(dados) {
						console.log("dados: "+dados);
						if(dados)
						{
							obj = JSON.parse(dados);
							$("#alertasModalTitulo").html("Tipo de Atividade");
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