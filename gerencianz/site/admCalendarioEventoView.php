<?php

	$calendadm = '
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
                <button data-ls-module="modal" data-target="#modalCadastro" class="ls-btn-primary ls-btn-block ls-ico-plus">Novo</button>
            </label>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="ls-table ls-bg-header" id="tbAtendimentos">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Profissional</th>
                            <th>Educando</th>		
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
                <h4 class="ls-modal-title">Calendário</h4>
            </div>
            <div class="ls-modal-body">
                <div class="ls-form ls-form-horizontal">
                    <input style="display:none" type="text" id="txtCod" name="txtCod" value="0">
                    <div class="row">
                        <label class="ls-label col-md-3 col-xs-12" id="lbData">
                            <b class="ls-label-text">Data *</b>
                            <div class="ls-prefix-group">
                                <input type="text" id="txtData" name="txtData" class="datepicker ls-mask-date" placeholder="dd/mm/aaaa" value="">
                                <a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtData" href="#"></a>
                            </div>
                            <small style="display:none" class="ls-help-message" id="msgErroData">Erro Data</small>
                        </label>
                        <label class="ls-label col-md-5 col-xs-12" id="lbEvento">
                            <b class="ls-label-text">Evento *</b>
                            <input type="text" id="txtEvento" name="txtEvento" class="ls-field" value="">
                            <small style="display:none" class="ls-help-message" id="msgErroEvento">Erro Evento</small>
                        </label>
                        <label class="ls-label col-md-4 col-xs-12" id="lbProfissionais">
                            <b class="ls-label-text">Responsável</b>
                            <div class="ls-custom-select">
                                <select class="ls-custom" id="cbbProfissionais" name="cbbProfissionais">
                                    <option value="0"></option>
                                    '.getProfissionaisCbb().'
                                </select>
                            </div>
                            <small style="display:none" class="ls-help-message" id="msgErroProfissionais">Erro Profissionais</small>
                        </label>
                    </div>
                    <div class="row">
                        <label class="ls-label col-md-4 col-xs-12" id="lbObs">
                            <b class="ls-label-text">Observações</b>
                            <textarea id="txtObs" name="txtObs" data-ls-module="charCounter" maxlength="1000" rows="6" value=""></textarea>
                            <small style="display:none" class="ls-help-message" id="msgErroObs">Erro Obs</small>
                        </label>
                        <div class="col-md-8 col-xs-12">
                            <div class="row">
                                <label class="ls-label col-md-4 col-xs-12" id="lbVoluntarios">
                                    <b class="ls-label-text">Voluntário</b>
                                    <div class="ls-custom-select">
                                        <select class="ls-custom" id="cbbVoluntarios" name="cbbVoluntarios">
                                            <option value="0"></option>
                                            '.getVoluntariosCbb().'
                                        </select>
                                    </div>
                                    <small style="display:none" class="ls-help-message" id="msgErroVoluntarios">Erro Voluntarios</small>
                                </label>
                                <label class="ls-label col-md-4 col-xs-12" id="lbFuncao">
                                    <b class="ls-label-text">Função</b>
                                    <input type="text" id="txtFuncao" name="txtFuncao" class="ls-field" value="">
                                    <small style="display:none" class="ls-help-message" id="msgErroFuncao">Erro Função</small>
                                </label>
                                <div class="col-md-1 col-xs-12">
                                    <button id="btnAddVol" name="btnAddVol" class="ls-btn ls-btn-primary ls-ico-user-add" onclick="lineTb(1,\'\')"></button>
                                </div>
                                <div class="col-md-1 col-xs-12">
                                    <button id="btnRemoveVol" name="btnRemoveVol" class="ls-btn ls-btn-primary-danger ls-ico-remove" onclick="limparTabela()"></button>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <table class="ls-table ls-no-margin-top" id="tbVoluntarios">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ls-modal-footer">
                <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" onclick="limparCampos()" data-dismiss="modal" value="Cancelar">
                    <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarEvento()">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">		
		function lineTb(operacao, linha)
		{
			var validado = true;
			var codigo = $("#cbbVoluntarios option:selected").val();
			if(operacao == 1)
			{
                $("#msgErroVoluntario").hide();
                $("#msgErroFuncao").hide();
                $("#lbVoluntario").removeClass("ls-error");
                $("#lbFuncao").removeClass("ls-error");
				erros = 0;
				if($("#cbbVoluntarios option:selected").val() == "0")
				{
					$("#lbVoluntarios").addClass("ls-error");
					$("#msgErroVoluntarios").text("Voluntário em branco.");
					$("#msgErroVoluntarios").show();
					erros++;
				}
				if($("#txtFuncao").val() == "")
				{
					$("#lbFuncao").addClass("ls-error");
					$("#msgErroFuncao").text("Função em branco.");
					$("#msgErroFuncao").show();
					erros++;
				}
				else
				if($("#txtFuncao").val().length < 3)
				{
					$("#lbFuncao").addClass("ls-error");
					$("#msgErroFuncao").text("Tamanho insuficiente (< 3).");
					$("#msgErroFuncao").show();
					erros++;
				}
				if(erros == 0)
				{
					var newRow = $("<tr class=\'trId\' id=\'"+codigo+"\'>");	    
					var cols = "";
					cols += "<td style=\'display:none\' class=\'tdCodVol ls-text-sm\'>"+$("#cbbVoluntarios option:selected").val()+"</td>";
					cols += "<td class=\'ls-text-sm\'>"+$("#cbbVoluntarios option:selected").text()+"</td>";
					cols += "<td class=\'tdFuncao ls-text-sm\'>"+$("#txtFuncao").val()+"</td>";
					cols += "<td style=\'text-align:center\' class=\'ls-text-sm\'><a onClick=\'lineTb(2, this);\' class=\'ls-no-margin-top ls-text-sm ls-cursor-pointer ls-color-danger\'>Remover</a></td>";
					newRow.append(cols);	    
					$("#tbVoluntarios .trId").each(function()
					{
						if($(this).attr("id") == $("#cbbVoluntarios option:selected").val())
						{
							$("#lbVoluntarios").addClass("ls-error");
							$("#msgErroVoluntarios").text("Voluntário já consta na lista.");
							$("#msgErroVoluntarios").show();
							validado = false;
						}
					});
					if(validado)
					{
						$("#tbVoluntarios").append(newRow);
						$("#lbVoluntarios").removeClass("ls-error");
						$("#lbFuncao").removeClass("ls-error");
						$("#msgErroFuncao").hide();
						$("#msgErroVoluntarios").hide();
						$("#txtFuncao").val("");
						$("#cbbVoluntarios").val("0");
					}
				}
			}else{
				var tr = $(linha).closest("tr");
				tr.fadeOut(400, function(){
					tr.remove();
				});	
				return false;
			}
		}
		function escondeErros()
        {
            $("#msgErroData").hide();
			$("#msgErroEvento").hide();
			$("#msgErroObs").hide();
			$("#msgErroVoluntario").hide();
			$("#msgErroFuncao").hide();
            $("#lbData").removeClass("ls-error");
            $("#lbEvento").removeClass("ls-error");
			$("#lbObs").removeClass("ls-error");
			$("#lbVoluntario").removeClass("ls-error");
            $("#lbFuncao").removeClass("ls-error");
		}
		function limparTabela()
		{
			$("#tbVoluntarios .trId").each(function(){
				$(this).remove();	
			});
		}
        function limparCampos()
        {
            $("#txtData").val("");  
            $("#txtEvento").val("");  
			$("#txtObs").val(""); 
			$("#txtFuncao").val("");  
			$("#cbbVoluntarios").val("0");
			limparTabela();
            escondeErros();
        }
        function salvarEvento()
        {
            escondeErros();
            erros = 0;
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
            if($("#txtEvento").val() == "")
            {
                $("#lbEvento").addClass("ls-error");
                $("#msgErroEvento").text("Descrição do evento em branco.");
                $("#msgErroEvento").show();
                erros++;
            }
            else
            if($("#txtEvento").val().length < 3)
            {
                $("#lbEvento").addClass("ls-error");
                $("#msgErroEvento").text("Descrição do evento com tamanho insuficiente (< 3).");
                $("#msgErroEvento").show();
                erros++;
            }
            if($("#txtObs").val().length > 0 && $("#txtObs").val().length < 3)
            {
                $("#lbObs").addClass("ls-error");
                $("#msgErroObs").text("Observações com tamanho insuficiente (< 3).");
                $("#msgErroObs").show();
                erros++;
			}
			cont = 0;
			dadosVol = [];
			$("#tbVoluntarios .trId").each(function(){
				dadosVol[cont] = $(this).find(\'.tdCodVol\').text()+\';\'+$(this).find(\'.tdFuncao\').text();
				cont++;
			});
			console.log(dadosVol);
            if(erros == 0)
            {
                $.ajax({
                    type: "POST",
                    data: {
                        acao: "salvarEvento",
                        data: $("#txtData").val(),
                        evento: $("#txtEvento").val(),
						obs: $("#txtObs").val(),
						voluntarios: cont == 0 ? "" : dadosVol,
						profissional: $("#cbbProfissionais option:selected").val()
                    },
                    url: "../utils/post.php",
                    success: function(dados) {
                        console.log("dados: "+dados);
                        if(dados)
                        {
                            obj = JSON.parse(dados);
                            $("#alertasModalTitulo").html("Calendário");
                            $("#alertasModalTexto").html(obj.retorno);
                            $("#alertasModal").show();
                            limparCampos();	
                        }
                    },
                    error : function(a,b,c){
                        alert(\'Erro: \'+a[status]+\' \'+c);
                    }
                });
            }
        }
    </script>
	';

?>