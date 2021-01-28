<?php

$newrec = '
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
                <table class="ls-table ls-bg-header" id="tbReceitas">
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
                <button data-dismiss="modal">&times;</button>
                <h4 class="ls-modal-title">Tipo de Receita</h4>
            </div>
            <div class="ls-modal-body">
                <div class="ls-form ls-form-horizontal">
                    <div class="row">
                        <input style="display:none" type="text" id="txtCod" value="0">
                        <label class="ls-label col-md-12 col-xs-12" id="lbDescricao">
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
                    <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarTipoReceita()">
                </div>
            </div>
        </div>
    </div>

    <div class="ls-modal" id="modalCadastroSubtipo" data-ls-module="form">
        <div class="ls-modal-large">
            <div class="ls-modal-header">
                <button data-dismiss="modal">&times;</button>
                <h4 class="ls-modal-title">Subtipo de Receita</h4>
            </div>
            <div class="ls-modal-body">
                <div class="ls-form ls-form-horizontal">
                    <div class="row">
                        <input style="display:none" type="text" id="txtCodSub" value="0">
                        <label class="ls-label col-md-12 col-xs-10">
                            <b class="ls-label-text">Tipo de Receita</b>
                            <input disabled type="text" id="txtDescricaoTipo" name="txtDescricaoTipo" class="ls-field">
                        </label>
                    </div>
                    <div class="row">
                        <label class="ls-label col-md-10 col-xs-10" id="lbSubtipo">
                            <b class="ls-label-text">Subtipos</b>
                            <input type="text" id="txtSubtipo" name="txtSubtipo" class="ls-field">
                            <small style="display:none" class="ls-help-message" id="msgErroSubtipo">Erro</small>
                        </label>
                        <div class="col-md-2 col-xs-2">
                            <button id="btnAddSub" name="btnAddSub" class="ls-btn ls-btn-primary ls-ico-plus" onclick="lineTb(1,\'\')"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <table class="ls-table ls-no-margin-top" id="tbSubtipos">
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
				</div>
            </div>
            <div class="ls-modal-footer">
                <input style="visibility:hidden" type="button" class="ls-btn" value="Limpar Campos">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" data-dismiss="modal" value="Cancelar">
                    <input type="button" class="ls-btn ls-btn-primary" id="btnSalvarSubtipo" name="btnSalvarSubtipo" value="Salvar" onclick="salvarSubtipoReceita()">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function(){
            carregaTabela();
        }
        function escondeErros()
        {
            $("#msgErroDescricao").hide();
            $("#msgErroSubtipo").hide();
            $("#lbDescricao").removeClass("ls-error");
            $("#lbSubtipo").removeClass("ls-error");
        }
        function editCad(cod)
		{
			var cont = 1;
			$("#rec"+cod+" td").each(function(){
				switch(cont){
					case 1:
						$("#txtDescricao").val($(this).text());
					break;
				}
				cont++					
			});
            $("#txtCod").val(cod);
            carregaTabelaSubtipos(cod);
			locastyle.modal.open("#modalCadastro");
        }
        function abreModalSubtipo(cod)
        {
            var cont = 1;
			$("#rec"+cod+" td").each(function(){
				switch(cont){
					case 1:
						$("#txtDescricaoTipo").val($(this).text());
					break;
				}
				cont++					
			});
            carregaTabelaSubtipos(cod);
            $("#txtCodSub").val(cod);
            locastyle.modal.open("#modalCadastroSubtipo");
        }
        function carregaTabela()
		{
			$("#tbReceitas .trId").each(function(){
				$(this).remove();	
			});
			$.ajax({
				type: "POST",
				data: { filtroTipoReceita : $("#txtFiltro").val() },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\' id=\'rec"+item.cod+"\'>");	    
							var cols = "";
							cols += "<td>"+item.descricao+"</td>";
							cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'abreModalSubtipo("+item.cod+")\' id=\'btnSubtipo\' name=\'btnSubtipo\' class=\'ls-no-margin-top ls-btn-xs ls-btn-primary\'>Subtipos</button><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
							newRow.append(cols);
							$("#tbReceitas").append(newRow);
						});
					} 						
				},
				error : function(a,b,c){
					alert(\'Erro: \'+a[status]+\' \'+c);
				}
			});
        }
        function carregaTabelaSubtipos(cod)
        {
            $("#tbSubtipos .trId").each(function(){
				$(this).remove();	
			});
			$.ajax({
				type: "POST",
				data: { filtroSubtipoReceita : cod },
				url: "../utils/post.php",
				success: function(dados) { 
					if(dados){
						obj = JSON.parse(dados);
						obj.forEach(function(item){
							var newRow = $("<tr class=\'trId\'>");	    
                            var cols = "";
                            cols += "<td style=\'display:none\' class=\'codtipo\'>"+cod+"</td>";
                            cols += "<td style=\'display:none\' class=\'codsubtipo\'>"+item.cod+"</td>";
                            cols += "<td style=\'display:none\' class=\'transacao\'>U</td>"
                            cols += "<td class=\'ls-text-sm subtipo\'>"+item.subtipo+"</td>";
                            cols += "<td style=\'text-align:center\' class=\'ls-text-sm\'><a onClick=\'lineTb(2, this)\' class=\'ls-no-margin-top ls-text-sm ls-cursor-pointer ls-color-danger\'>Remover</a></td>";
                            newRow.append(cols);	    
                            $("#tbSubtipos").append(newRow);
						});
					} 						
				},
				error : function(a,b,c){
					alert(\'Erro: \'+a[status]+\' \'+c);
				}
			});
        }
        function limpaTabela()
        {
            $("#tbSubtipos .trId").each(function(){
                $(this).remove();	
            });
        }
        function lineTb(operacao, linha)
        {
            var validado = true;
            if(operacao == 1)
            {
                escondeErros();
                erros = 0;
                if($("#txtSubtipo").val() == "")
                {
                    $("#lbSubtipo").addClass("ls-error");
                    $("#msgErroSubtipo").text("Subtipo em branco.");
                    $("#msgErroSubtipo").show();
                    erros++;
                }
                else
                if($("#txtSubtipo").val().length < 3)
                {
                    $("#lbSubtipo").addClass("ls-error");
                    $("#msgErroSubtipo").text("Tamanho insuficiente (< 3).");
                    $("#msgErroSubtipo").show();
                    erros++;
                }
                if(erros == 0)
                {
                    var newRow = $("<tr class=\'trId\'>");	    
                    var cols = "";
                    cols += "<td style=\'display:none\' class=\'codtipo\'>"+$("#txtCodSub").val()+"</td>";
                    cols += "<td style=\'display:none\' class=\'codsubtipo\'>0</td>";
                    cols += "<td style=\'display:none\' class=\'transacao\'>I</td>"
                    cols += "<td class=\'ls-text-sm subtipo\'>"+$("#txtSubtipo").val().trim()+"</td>";
                    cols += "<td style=\'text-align:center\' class=\'ls-text-sm\'><a onClick=\'lineTb(2, this)\' class=\'ls-no-margin-top ls-text-sm ls-cursor-pointer ls-color-danger\'>Remover</a></td>";
                    newRow.append(cols);	    
                    $("#tbSubtipos tbody tr td").each(function()
                    {
                        if($(this).text().trim() == $("#txtSubtipo").val().trim())
                        {
                            $("#lbSubtipo").addClass("ls-error");
                            $("#msgErroSubtipo").text("Subtipo já consta na lista.");
                            $("#msgErroSubtipo").show();
                            validado = false;
                        }
                    });
                    if(validado)
                    {
                        $("#tbSubtipos").append(newRow);
                        $("#lbSubtipo").removeClass("ls-error");
                        $("#msgErroSubtipo").hide();
                        $("#txtSubtipo").val("");
                    }
                }
            }
            else
            {
                var tr = $(linha).closest("tr");
                tr.fadeOut(400, function(){
                    if(tr.find(".codsubtipo").text() == "0")
						tr.remove();
					else
					{
						tr.find(".transacao").text("D");
						tr.find(".subtipo").text("Excluido");
					}
                });	
                return false;
            }
        }
        function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtDescricaoTipo").val("");
            $("#txtDescricao").val("");
            $("#txtSubtipo").val("");
            limpaTabela();
            escondeErros();
        }
        function salvarTipoReceita()
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
			if(erros == 0)
                $.ajax({
                    type: "POST",
                    data: {
                        acao: "salvarTipoReceita",
                        cod: $("#txtCod").val(),
                        descricao: $("#txtDescricao").val()
                    },
                    url: "../utils/post.php",
                    success: function(dados) {
                        console.log("dados: "+dados);
                        if(dados)
                        {
                            obj = JSON.parse(dados);
                            $("#alertasModalTitulo").html("Tipo de Receita");
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
        function salvarSubtipoReceita()
        {
            escondeErros();
            cont = 0;
            dadosSub = [];
			$("#tbSubtipos .trId").each(function(){
				
				dadosSub[cont] = $(this).find(\'.codsubtipo\').text()+\';\'+$(this).find(\'.transacao\').text()+\';\'+$(this).find(\'.subtipo\').text()+\';\'+$(this).find(\'.codtipo\').text();
				cont++;
            });
            if(cont == 0)
            {
                $("#lbSubtipo").addClass("ls-error");
				$("#msgErroSubtipo").text("Informe ao menos um subtipo.");
				$("#msgErroSubtipo").show();
            }
			else
                $.ajax({
                    type: "POST",
                    data: {
                        acao: "salvarSubtipoReceita",
                        subtipos: dadosSub
                    },
                    url: "../utils/post.php",
                    success: function(dados) {
                        console.log("dados: "+dados);
                        if(dados)
                        {
                            obj = JSON.parse(dados);
                            $("#alertasModalTitulo").html("Subtipo de Receita");
                            $("#alertasModalTexto").html(obj.retorno);
                            $("#alertasModal").show();
                            if(obj.condicao)
                            {
                                limparCampos();
                                carregaTabela();
                                locastyle.modal.close("#modalCadastroSubtipo");
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