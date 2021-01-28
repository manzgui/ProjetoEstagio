<?php

    $atendedu = '
        <div class="ls-form ls-form-horizontal">
			<div class="row">
				<label class="ls-label col-md-9 col-xs-12">
					<b class="ls-label-text">Filtro: </b>
					<input type="text" id="txtFiltro" name="txtFiltro" class="ls-field">
				</label>
				<label class="ls-label col-md-2 col-xs-12">
					<b class="ls-label-text" style="display:none">a</b>
					<button id="btnFiltrar" name="btnFiltrar" class="ls-btn ls-ico-search ls-btn-block" onclick="carregaTabela()"> Filtrar</button>
				</label>
				<label class="ls-label col-md-1 col-xs-12">
					<button data-ls-module="modal" data-target="#modalCadastro" class="ls-btn-primary ls-ico-plus">Novo</button>
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
                <h4 class="ls-modal-title">Atendimento</h4>
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
                        <label class="ls-label col-md-2 col-xs-12" id="lbInicio">
                            <b class="ls-label-text">Início *</b>
                            <input type="time" id="txtHorai" name="txtHorai" class="ls-field" value="00:00">
                            <small style="display:none" class="ls-help-message" id="msgErroInicio">Erro Início</small>
                        </label>
                        <label class="ls-label col-md-2 col-xs-12" id="lbFim">
                            <b class="ls-label-text">Fim *</b>
                            <input type="time" id="txtHoraf" name="txtHoraf" class="ls-field" value="00:00">
                            <small style="display:none" class="ls-help-message" id="msgErroFim">Erro Fim</small>
                        </label>
                    </div>
                    <div class="row">
                        <label class="ls-label col-md-7 col-xs-12" id="lbEducandos">
                            <b class="ls-label-text">Educando *</b>
                            <div class="ls-custom-select">
                                <select class="ls-custom" id="cbbEducandos" name="cbbEducandos">
                                    <option value="0"></option>
                                    '.getEducandosCbb().'
                                </select>
                            </div>
                            <small style="display:none" class="ls-help-message" id="msgErroEducandos">Erro Educandos</small>
                        </label>
                        <label class="ls-label col-md-5 col-xs-12" id="lbProfissionais">
                            <b class="ls-label-text">Profissional *</b>
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
                        <label class="ls-label col-md-12 col-xs-12" id="lbRelatorio">
                            <b class="ls-label-text">Relatório *</b>
                            <textarea id="txtRelatorio" name="txtRelatorio" data-ls-module="charCounter" maxlength="1000" rows="6" value=""></textarea>
                            <small style="display:none" class="ls-help-message" id="msgErroRelatorio">Erro Relatorio</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="ls-modal-footer">
                <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                <div class="ls-float-right">
                    <input type="button" class="ls-btn" onclick="limparCampos()" data-dismiss="modal" value="Cancelar">
                    <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarAtendimento()">
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
                        $("#txtData").val($(this).text());
                    break;
                    case 2:
                        $("#txtHorai").val($(this).text());
                    break;
                    case 3:
                        $("#txtHoraf").val($(this).text());
                    break;
                    case 4:
                        $("#txtRelatorio").val($(this).text());
                    break;
                    case 5:
                        $("#cbbProfissionais").val($(this).text());
                    break;
                    case 7:
                        $("#cbbEducandos").val($(this).text()); 
                    break;
                }
                cont++					
            });
            $("#txtCod").val(cod); 
            locastyle.modal.open("#modalCadastro");
        }
        function carregaTabela()
        {
            $("#tbAtendimentos .trId").each(function(){
                $(this).remove();	
            });
            $.ajax({
                type: "POST",
                data: { filtroAtendimento : $("#txtFiltro").val() },
                url: "../utils/post.php",
                success: function(dados) { 
                    if(dados){
                        obj = JSON.parse(dados);
                        obj.forEach(function(item){
                            var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
                            var cols = "";
                            cols += "<td>"+item.data+"</td>";
                            cols += "<td>"+item.inicio+"</td>";
                            cols += "<td style=\'display:none\'>"+item.fim+"</td>";
                            cols += "<td style=\'display:none\'>"+item.relatorio+"</td>";
                            cols += "<td style=\'display:none\'>"+item.profissionalcod+"</td>";
                            cols += "<td>"+item.profissional+"</td>";
                            cols += "<td style=\'display:none\'>"+item.educandocod+"</td>";
                            cols += "<td>"+item.educando+"</td>";
                            cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
                            newRow.append(cols);
                            $("#tbAtendimentos").append(newRow);
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
            $("#msgErroInicio").hide();
            $("#msgErroFim").hide();
            $("#msgErroEducandos").hide();
            $("#msgErroProfissionais").hide();
            $("#msgErroRelatorio").hide();
            $("#lbData").removeClass("ls-error");
            $("#lbInicio").removeClass("ls-error");
            $("#lbFim").removeClass("ls-error");
            $("#lbEducandos").removeClass("ls-error");
            $("#lbProfissionais").removeClass("ls-error");
            $("#lbRelatorio").removeClass("ls-error");
        }
        function limparCampos()
        {
            $("#txtCod").val("0");
            $("#txtData").val("");  
            $("#txtHorai").val("00:00");  
            $("#txtHoraf").val("00:00");  
            $("#cbbProfissionais").val("0");  
            $("#cbbEducandos").val("0");  
            $("#txtRelatorio").val("");
            escondeErros();
        }
        function salvarAtendimento()
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
                $("#msgErroData").text("Ano futuro.");
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
            if($("#txtHorai").val() == "")
            {
                $("#lbInicio").addClass("ls-error");
                $("#msgErroInicio").text("Horário em branco.");
                $("#msgErroInicio").show();
                erros++;
            }
            else
            if($("#txtHorai").val().length != 5)
            {
                $("#lbInicio").addClass("ls-error");
                $("#msgErroInicio").text("Formato incorreto.");
                $("#msgErroInicio").show();
                erros++;
            }
            else
            if($("#txtHorai").val() == $("#txtHoraf").val())
            {
                $("#lbFim").addClass("ls-error");
                $("#msgErroFim").text("Horários iguais.");
                $("#msgErroFim").show();
                erros++;
            }
            else
            if($("#txtHorai").val() > $("#txtHoraf").val())
            {
                $("#lbFim").addClass("ls-error");
                $("#msgErroFim").text("Horário de início maior que o fim.");
                $("#msgErroFim").show();
                erros++;
            }
            if($("#txtHoraf").val() == "")
            {
                $("#lbFim").addClass("ls-error");
                $("#msgErroFim").text("Horário em branco.");
                $("#msgErroFim").show();
                erros++;
            }
            else
            if($("#txtHoraf").val().length != 5)
            {
                $("#lbFim").addClass("ls-error");
                $("#msgErroFim").text("Formato incorreto.");
                $("#msgErroFim").show();
                erros++;
            }
            if($("#cbbEducandos option:selected").val() == "0")
            {
                $("#lbEducandos").addClass("ls-error");
                $("#msgErroEducandos").text("Educando em branco.");
                $("#msgErroEducandos").show();
                erros++;
            }
            if($("#cbbProfissionais option:selected").val() == "0")
            {
                $("#lbProfissionais").addClass("ls-error");
                $("#msgErroProfissionais").text("Profissional em branco.");
                $("#msgErroProfissionais").show();
                erros++;
            }
            if($("#txtRelatorio").val() == "")
            {
                $("#lbRelatorio").addClass("ls-error");
                $("#msgErroRelatorio").text("Relatório em branco.");
                $("#msgErroRelatorio").show();
                erros++;
            }
            else
            if($("#txtRelatorio").val().length < 3)
            {
                $("#lbRelatorio").addClass("ls-error");
                $("#msgErroRelatorio").text("Formato incorreto.");
                $("#msgErroRelatorio").show();
                erros++;
            }
            if(erros == 0)
            {
                $.ajax({
                    type: "POST",
                    data: {
                        acao: "salvarAtendimento",
                        cod: $("#txtCod").val(),
                        data: $("#txtData").val(),
                        inicio: $("#txtHorai").val(),
                        fim: $("#txtHoraf").val(),
                        relatorio: $("#txtRelatorio").val(),
                        profissional: $("#cbbProfissionais option:selected").val(),
                        educando: $("#cbbEducandos option:selected").val()
                    },
                    url: "../utils/post.php",
                    success: function(dados) {
                        console.log("dados: "+dados);
                        if(dados)
                        {
                            obj = JSON.parse(dados);
                            $("#alertasModalTitulo").html("Atendimento");
                            $("#alertasModalTexto").html(obj.retorno);
                            $("#alertasModal").show();
                            limparCampos();
                            carregaTabela();
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