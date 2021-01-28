<?php

$newpro = '
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
					<table class="ls-table ls-bg-header" id="tbProfissionais">
						<thead>
							<tr>
								<th>Nome</th>
								<th>CPF</th>
								<th>Função</th>
								<th>Celular</th>		
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
                    <h4 class="ls-modal-title">Profissional</h4>
                </div>
                <div class="ls-modal-body">
					<div class="ls-form ls-form-horizontal">
						<input style="display:none" type="text" id="txtCod" name="txtCod" value="0">
                        <div class="row">
                            <label class="ls-label col-md-6 col-xs-12" id="lbNome">
                                <b class="ls-label-text">Nome *</b>
								<input type="text" id="txtNome" name="txtNome" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroNome">Erro</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbCpf">
                                <b class="ls-label-text">CPF *</b>
								<input type="text" id="txtCpf" name="txtCpf" class="ls-field ls-mask-cpf" placeholder="000.000.000-00">
								<small style="display:none" class="ls-help-message" id="msgErroCpf">Erro</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbRg">
                                <b class="ls-label-text">RG *</b>
								<input type="text" id="txtRg" name="txtRg" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroRg">Erro</small>
                            </label>
                        </div>
                        <div class="row">
                            <label class="ls-label col-md-6 col-xs-12" id="lbFuncao">
                                <b class="ls-label-text">Função *</b>
								<input type="text" id="txtFuncao" name="txtFuncao" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroFuncao">Erro</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbFixo">
                                <b class="ls-label-text">Telefone Fixo</b>
								<input type="text" id="txtFixo" name="txtFixo" class="ls-mask-phone8_with_ddd" placeholder="(00) 0000-0000">
								<small style="display:none" class="ls-help-message" id="msgErroFixo">Erro</small>
                            </label>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbCelular">
                                <b class="ls-label-text">Celular *</b>
								<input type="text" id="txtCelular" name="txtCelular" class="ls-field ls-mask-phone9_with_ddd" placeholder="(00) 00000-0000">
								<small style="display:none" class="ls-help-message" id="msgErroCelular">Erro</small>
                            </label>
                        </div>
                        <div class="row">
                            <label class="ls-label col-md-5 col-xs-12" id="lbRua">
                                <b class="ls-label-text">Rua *</b>
								<input type="text" id="txtRua" name="txtRua" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroRua">Erro</small>
                            </label>
                            <label class="ls-label col-md-2 col-xs-12" id="lbNumero">
                                <b class="ls-label-text">Número *</b>
								<input type="text" id="txtNumero" name="txtNumero" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroNumero">Erro</small>
                            </label>
                            <label class="ls-label col-md-5 col-xs-12" id="lbBairro">
                                <b class="ls-label-text">Bairro *</b>
								<input type="text" id="txtBairro" name="txtBairro" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroBairro">Erro</small>
                            </label>
                        </div>
                        <div class="row">
                            <label class="ls-label col-md-4 col-xs-12" id="lbComplemento">
                                <b class="ls-label-text">Complemento</b>
								<input type="text" id="txtComplemento" name="txtComplemento" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroComplemento">Erro</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbEstados">
                                <b class="ls-label-text">Estado *</b>
                                <div class="ls-custom-select">
                                    <select class="ls-custom" id="cbbEstados" name="cbbEstados" onchange="getCidades()">
                                        <option value="0"></option>
                                        '.getEstadosCbb().'
                                    </select>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroEstados">Erro</small>
                            </label>
                            <label class="ls-label col-md-5 col-xs-12" id="lbCidades">
                                <b class="ls-label-text">Cidade  *</b>
                                <div class="ls-custom-select">
                                    <select class="ls-custom" id="cbbCidades" name="cbbCidades">
                                        <option value="0"></option>
                                    </select>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroCidades">Erro</small>
                            </label>
                        </div>
                        <div class="row">
                            <label class="ls-label col-md-4 col-xs-12" id="lbUsuario">
                                <b class="ls-label-text">Usuário</b>
								<input type="text" id="txtUsuario" name="txtUsuario" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroUsuario">Erro</small>
                            </label>
                            <label class="ls-label col-md-4 col-xs-12" id="lbSenha">
                                <b class="ls-label-text">Senha</b>
								<input type="text" id="txtSenha" name="txtSenha" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroSenha">Erro</small>
                            </label>
                            <label class="ls-label col-md-4 col-xs-12" id="lbNivel">
                                <b class="ls-label-text">Nivel</b>
                                <div class="ls-custom-select">
                                    <select class="ls-custom" id="cbbNivel" name="cbbNivel">
                                        <option value="0"></option>
                                        <option value="1">1 - Básico</option>
                                        <option value="2">2 - Adm/Financeiro</option>
                                        <option value="3">3 - Educandos</option>
                                        <option value="4">4 - Total</option>
                                    </select>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroNivel">Erro</small>
                            </label>
                        </div>
                        <div class="row">
							<label class="ls-label col-md-4 col-xs-12" id="lbNascimento">
								<b class="ls-label-text">Data de Nascimento *</b>
								<div class="ls-prefix-group">
									<input type="date" id="txtNascimento" name="txtNascimento" class="datepicker ls-mask-date" placeholder="dd/mm/aaaa">
									<a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtNascimento" href="#"></a>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroNascimento">Erro</small>
							</label>
							<label class="ls-label col-md-4 col-xs-12" id="lbAdmissao">
								<b class="ls-label-text">Data de Admissão *</b>
								<div class="ls-prefix-group">
									<input type="date" id="txtAdmissao" name="txtAdmissao" class="datepicker ls-daterange ls-mask-date" placeholder="dd/mm/aaaa" data-ls-daterange="#txtDemissao">
									<a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtAdmissao" href="#"></a>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroAdmissao">Erro</small>
							</label>
							<label class="ls-label col-md-4 col-xs-12" id="lbDemissao">
								<b class="ls-label-text">Data de Demissão</b>
								<div class="ls-prefix-group">
									<input disabled type="date" id="txtDemissao" name="txtDemissao" class="datepicker ls-daterange ls-mask-date" placeholder="dd/mm/aaaa">
									<a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtDemissao" href="#"></a>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroDemissao">Erro</small>
							</label>
                    	</div>
                    </div>
                </div>
                <div class="ls-modal-footer">
                    <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                    <div class="ls-float-right">
                        <input type="button" class="ls-btn" data-dismiss="modal" value="Cancelar" onclick="limparCampos()">
                        <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onClick="salvarProfissional()">
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
                            $("#txtNome").val($(this).text());
                        break;
                        case 2:
                            $("#txtCpf").val($(this).text());
                        break;
                        case 3:
                            $("#txtRg").val($(this).text());
                        break;
                        case 4:
                            $("#txtFuncao").val($(this).text());
                        break;
                        case 5:
                            $("#txtFixo").val($(this).text());
                        break;
                        case 6:
                            $("#txtCelular").val($(this).text()); 
                        break;
                        case 7:
                            $("#txtRua").val($(this).text());
                        break;
                        case 8:
                            $("#txtNumero").val($(this).text());
                        break;
                        case 9:
                            $("#txtBairro").val($(this).text()); 
                        break;
                        case 10:
                            $("#txtComplemento").val($(this).text());
                        break;
                        case 11:
                            $("#cbbEstados").val($(this).text());
                            getCidades();
                        break;
                        case 12:
                            $("#cbbCidades").val($(this).text());
                        break;
                        case 13:
                            $("#txtNascimento").val($(this).text());
                        break;
                        case 14:
                            $("#txtAdmissao").val($(this).text()); 
                        break;
                        case 15:
                            $("#txtDemissao").val($(this).text());
                        break;
                        case 16:
                            $("#txtUsuario").val($(this).text());
                        break;
                        case 17:
                            $("#txtSenha").val($(this).text()); 
                        break;
                        case 18:
                            $("#cbbNivel").val($(this).text());
                        break;
                    }
                    cont++					
                });
                $("#txtDemissao").attr("disabled", false);
                $("#txtCod").val(cod); 
                locastyle.modal.open("#modalCadastro");
            }
            function carregaTabela()
            {
                $("#tbProfissionais .trId").each(function(){
                    $(this).remove();	
                });
                $.ajax({
                    type: "POST",
                    data: { filtroProfissional : $("#txtFiltro").val() },
                    url: "../utils/post.php",
                    success: function(dados) { 
                        if(dados){
                            obj = JSON.parse(dados);
                            obj.forEach(function(item){
                                var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
                                var cols = "";
                                cols += "<td>"+item.nome+"</td>";
                                cols += "<td>"+item.cpf+"</td>";
                                cols += "<td style=\'display:none\'>"+item.rg+"</td>";
                                cols += "<td>"+item.funcao+"</td>";
                                cols += "<td style=\'display:none\'>"+item.fixo+"</td>";
                                cols += "<td>"+item.celular+"</td>";
                                cols += "<td style=\'display:none\'>"+item.rua+"</td>";
                                cols += "<td style=\'display:none\'>"+item.numero+"</td>";
                                cols += "<td style=\'display:none\'>"+item.bairro+"</td>";
                                cols += "<td style=\'display:none\'>"+item.complemento+"</td>";
                                cols += "<td style=\'display:none\'>"+item.estado+"</td>";
                                cols += "<td style=\'display:none\'>"+item.cidade+"</td>";
                                cols += "<td style=\'display:none\'>"+item.nascimento+"</td>";
                                cols += "<td style=\'display:none\'>"+item.admissao+"</td>";
                                cols += "<td style=\'display:none\'>"+item.demissao+"</td>";
                                cols += "<td style=\'display:none\'>"+item.usuario+"</td>";
                                cols += "<td style=\'display:none\'>"+item.senha+"</td>";
                                cols += "<td style=\'display:none\'>"+item.nivel+"</td>";
                                cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\'/></div></td>";
                                newRow.append(cols);
                                $("#tbProfissionais").append(newRow);
                            });
                        } 						
                    },
                    error : function(a,b,c){
                        alert(\'Erro: \'+a[status]+\' \'+c);
                    }
                });
            }
            function getCidades()
            {
                $.ajax({
					type: "POST",
                    data: { getByEstado : $("#cbbEstados option:selected").val() },
                    async: false,
					url: "../utils/post.php",
					success: function(dados) { 
						$(\'#cbbCidades\').empty();
						$(\'#cbbCidades\').append(\'<option value="0"></option>\');
						if(dados){
                            obj = JSON.parse(dados);
							obj.forEach(function(item){
								$(\'#cbbCidades\').append(\'<option value="\'+item.id+\'">\'+item.nome+\'</option>\');
							});
						} 						
					},
				    error : function(a,b,c){
						alert(\'Erro: \'+a[status]+\' \'+c);
				    }
				});
			}
			function validaCpf(strCPF)
			{
				var Soma;
				var Resto;
				Soma = 0;
				if(strCPF == "00000000000")
                    return false;
                else
                if(strCPF == "11111111111")
                    return false;
                else
                if(strCPF == "22222222222")
                    return false;
                else
                if(strCPF == "33333333333")
                    return false;
                else
                if(strCPF == "44444444444")
                    return false;
                else
                if(strCPF == "55555555555")
                    return false;
                else
                if(strCPF == "66666666666")
                    return false;
                else
                if(strCPF == "77777777777")
                    return false;
                else
                if(strCPF == "88888888888")
                    return false;
                else
                if(strCPF == "99999999999")
                    return false;
				for (i=1; i<=9; i++) 
					Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
				Resto = (Soma * 10) % 11;
				if((Resto == 10) || (Resto == 11)) 
					Resto = 0;
				if(Resto != parseInt(strCPF.substring(9, 10)))
					return false;
			  	Soma = 0;
				for (i = 1; i <= 10; i++)
					Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
				Resto = (Soma * 10) % 11;
				if ((Resto == 10) || (Resto == 11)) 
					Resto = 0;
				if (Resto != parseInt(strCPF.substring(10, 11)))
					return false;
				return true;
			}
			function escondeErros()
			{
				$("#msgErroNome").hide();
				$("#msgErroCpf").hide();
				$("#msgErroRg").hide();
				$("#msgErroFuncao").hide();
				$("#msgErroFixo").hide();
				$("#msgErroCelular").hide();
				$("#msgErroRua").hide();
				$("#msgErroNumero").hide();
				$("#msgErroBairro").hide();
				$("#msgErroComplemento").hide();
				$("#msgErroEstados").hide();
				$("#msgErroCidades").hide();
				$("#msgErroNascimento").hide();
				$("#msgErroAdmissao").hide();
                $("#msgErroDemissao").hide();
                $("#msgErroUsuario").hide();
				$("#msgErroSenha").hide();
				$("#msgErroNivel").hide();
				$("#lbNome").removeClass("ls-error");
				$("#lbCpf").removeClass("ls-error");
				$("#lbRg").removeClass("ls-error");
				$("#lbFuncao").removeClass("ls-error");
				$("#lbFixo").removeClass("ls-error");
				$("#lbCelular").removeClass("ls-error");
				$("#lbRua").removeClass("ls-error");
				$("#lbNumero").removeClass("ls-error");
				$("#lbBairro").removeClass("ls-error");
				$("#lbComplemento").removeClass("ls-error");
				$("#lbEstados").removeClass("ls-error");
				$("#lbCidades").removeClass("ls-error");
				$("#lbNascimento").removeClass("ls-error");
				$("#lbAdmissao").removeClass("ls-error");
                $("#lbDemissao").removeClass("ls-error");
                $("#lbUsuario").removeClass("ls-error");
				$("#lbSenha").removeClass("ls-error");
				$("#lbNivel").removeClass("ls-error");
			}
            function limparCampos()
            {
                $("#txtCod").val("0");
                $("#txtNome").val("");
                $("#txtCpf").val("");  
                $("#txtRg").val("");  
                $("#txtFuncao").val("");  
                $("#txtFixo").val("");  
                $("#txtCelular").val("");  
                $("#txtRua").val("");
                $("#txtNumero").val(""); 
                $("#txtBairro").val(""); 
                $("#txtComplemento").val("");
                $("#cbbEstados").val("0");
                getCidades();
                $("#txtNascimento").val(""); 
                $("#txtAdmissao").val("");
                $("#txtDemissao").val("");
                $("#txtUsuario").val(""); 
                $("#txtSenha").val("");
				$("#cbbNivel").val("0");
                escondeErros();
                $("#txtDemissao").attr("disabled", true)
            }
            function salvarProfissional()
            {
				escondeErros();
				erros = 0;
				now = new Date;
				now.setMonth(now.getMonth() + 1);
				dia = now.getDate() > 0 && now.getDate() < 10 ? "0"+now.getDate() : now.getDate();
				mes = now.getMonth() > 0 && now.getMonth() < 10 ? "0"+now.getMonth() : now.getMonth();
				console.log(dia);
				console.log(mes);
				if($("#txtNome").val() == "")
				{
					$("#lbNome").addClass("ls-error");
					$("#msgErroNome").text("Nome em branco.");
					$("#msgErroNome").show();
					erros++;
				}
				else
				if($("#txtNome").val().length < 3)
				{
					$("#lbNome").addClass("ls-error");
					$("#msgErroNome").text("Tamanho insuficiente (< 3).");
					$("#msgErroNome").show();
					erros++;
				}
				if($("#txtNascimento").val() == "")
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Nascimento em branco.");
					$("#msgErroNascimento").show();
					erros++;
				}
				else
				if($("#txtNascimento").val().length != 10)
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Formato incorreto.");
					$("#msgErroNascimento").show();
					erros++;
				}
				else
				if($("#txtNascimento").val().substring(0, 2) > "31" ||  $("#txtNascimento").val().substring(0, 2) < "01")
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Dia inexistente.");
					$("#msgErroNascimento").show();
					erros++;
				}
				else
				if($("#txtNascimento").val().substring(3, 5) > "12" ||  $("#txtNascimento").val().substring(3, 5) < "01")
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Mês inexistente.");
					$("#msgErroNascimento").show();
					erros++;
				}
				else
				if($("#txtNascimento").val().substring(6, 10) > now.getFullYear())
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Ano futuro.");
					$("#msgErroNascimento").show();
					erros++;
				}
				else
				if($("#txtNascimento").val().substring(6, 10) < "1900")
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Ano inválido.");
					$("#msgErroNascimento").show();
					erros++;
				}
				else
				if($("#txtNascimento").val().substring(6, 10) == now.getFullYear() && $("#txtNascimento").val().substring(3, 5) == mes && $("#txtNascimento").val().substring(0, 2) > dia)
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Data futura.");
					$("#msgErroNascimento").show();
					erros++;
				}
				else
				if($("#txtNascimento").val().substring(6, 10) == now.getFullYear() && $("#txtNascimento").val().substring(3, 5) > mes)
				{
					$("#lbNascimento").addClass("ls-error");
					$("#msgErroNascimento").text("Data futura.");
					$("#msgErroNascimento").show();
					erros++;
				}
				if($("#txtCpf").val() == "")
				{
					$("#lbCpf").addClass("ls-error");
					$("#msgErroCpf").text("CPF em branco.");
					$("#msgErroCpf").show();
					erros++;
				}
				else
				if($("#txtCpf").val().length < 14)
				{
					$("#lbCpf").addClass("ls-error");
					$("#msgErroCpf").text("Formato incorreto.");
					$("#msgErroCpf").show();
					erros++;
				}
				else
				if(!validaCpf($("#txtCpf").val().replace(".","").replace(".","").replace("-","")))
				{
					$("#lbCpf").addClass("ls-error");
					$("#msgErroCpf").text("CPF inválido.");
					$("#msgErroCpf").show();
					erros++;
				}
				if($("#txtRg").val() == "")
				{
					$("#lbRg").addClass("ls-error");
					$("#msgErroRg").text("RG em branco.");
					$("#msgErroRg").show();
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
				if($("#txtFixo").val().length > 0 && $("#txtFixo").val().length != 14)
				{
					$("#lbFixo").addClass("ls-error");
					$("#msgErroFixo").text("Formato incorreto.");
					$("#msgErroFixo").show();
					erros++;
				}
				if($("#txtCelular").val() == "")
				{
					$("#lbCelular").addClass("ls-error");
					$("#msgErroCelular").text("Celular em branco.");
					$("#msgErroCelular").show();
					erros++;
				}
				else
				if($("#txtCelular").val().length != 15)
				{
					$("#lbCelular").addClass("ls-error");
					$("#msgErroCelular").text("Formato incorreto.");
					$("#msgErroCelular").show();
					erros++;
				}
				if($("#txtRua").val() == "")
				{
					$("#lbRua").addClass("ls-error");
					$("#msgErroRua").text("Rua em branco.");
					$("#msgErroRua").show();
					erros++;
				}
				else
				if($("#txtRua").val().length < 3)
				{
					$("#lbRua").addClass("ls-error");
					$("#msgErroRua").text("Tamanho insuficiente (< 3).");
					$("#msgErroRua").show();
					erros++;
				}
				if($("#txtNumero").val() == "")
				{
					$("#lbNumero").addClass("ls-error");
					$("#msgErroNumero").text("Número em branco.");
					$("#msgErroNumero").show();
					erros++;
				}
				if($("#txtBairro").val() == "")
				{
					$("#lbBairro").addClass("ls-error");
					$("#msgErroBairro").text("Rua em branco.");
					$("#msgErroBairro").show();
					erros++;
				}
				else
				if($("#txtBairro").val().length < 3)
				{
					$("#lbBairro").addClass("ls-error");
					$("#msgErroBairro").text("Tamanho insuficiente (< 3).");
					$("#msgErroBairro").show();
					erros++;
				}
				if($("#cbbEstados option:selected").val() == "0")
				{
					$("#lbEstados").addClass("ls-error");
					$("#msgErroEstados").text("Estado em branco.");
					$("#msgErroEstados").show();
					erros++;
				}
				if($("#cbbCidades option:selected").val() == "0")
				{
					$("#lbCidades").addClass("ls-error");
					$("#msgErroCidades").text("Cidade em branco.");
					$("#msgErroCidades").show();
					erros++;
				}
				if($("#txtAdmissao").val() == "")
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Início em branco.");
					$("#msgErroAdmissao").show();
					erros++;
				}
				else
				if($("#txtAdmissao").val().length != 10)
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Formato incorreto.");
					$("#msgErroAdmissao").show();
					erros++;
				}
				else
				if($("#txtAdmissao").val().substring(0, 2) > "31" ||  $("#txtAdmissao").val().substring(0, 2) < "01")
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Dia inexistente.");
					$("#msgErroAdmissao").show();
					erros++;
				}
				else
				if($("#txtAdmissao").val().substring(3, 5) > "12" ||  $("#txtAdmissao").val().substring(3, 5) < "01")
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Mês inexistente.");
					$("#msgErroAdmissao").show();
					erros++;
				}
				else
				if($("#txtAdmissao").val().substring(6, 10) < "1900")
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Ano inválido.");
					$("#msgErroAdmissao").show();
					erros++;
                }
                else
				if($("#txtAdmissao").val().substring(6, 10) < $("#txtNascimento").val().substring(6, 10))
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Admissão anterior a nascimento.");
					$("#msgErroAdmissao").show();
					erros++;
                }
                else
				if($("#txtAdmissao").val().substring(6, 10) == $("#txtNascimento").val().substring(6, 10) && $("#txtAdmissao").val().substring(3, 5) < $("#txtNascimento").val().substring(3, 5))
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Admissão anterior a nascimento.");
					$("#msgErroAdmissao").show();
					erros++;
                }
                else
				if($("#txtAdmissao").val().substring(6, 10) == $("#txtNascimento").val().substring(6, 10) && $("#txtAdmissao").val().substring(3, 5) == $("#txtNascimento").val().substring(3, 5) && $("#txtAdmissao").val().substring(0, 2) < $("#txtNascimento").val().substring(0, 2))
				{
					$("#lbAdmissao").addClass("ls-error");
					$("#msgErroAdmissao").text("Admissão anterior a nascimento.");
					$("#msgErroAdmissao").show();
					erros++;
				}
				if($("#txtDemissao").val().length > 0 && $("#txtDemissao").val().length != 10)
				{
					$("#lbDemissao").addClass("ls-error");
					$("#msgErroDemissao").text("Formato incorreto.");
					$("#msgErroDemissao").show();
					erros++;
				}
				else
				if($("#txtDemissao").val().length > 0 && ($("#txtDemissao").val().substring(0, 2) > "31" ||  $("#txtDemissao").val().substring(0, 2) < "01"))
				{
					$("#lbDemissao").addClass("ls-error");
					$("#msgErroDemissao").text("Dia inexistente.");
					$("#msgErroDemissao").show();
					erros++;
				}
				else
				if($("#txtDemissao").val().length > 0 && ($("#txtDemissao").val().substring(3, 5) > "12" ||  $("#txtDemissao").val().substring(3, 5) < "01"))
				{
					$("#lbDemissao").addClass("ls-error");
					$("#msgErroDemissao").text("Mês inexistente.");
					$("#msgErroDemissao").show();
					erros++;
				}
				else
				if($("#txtDemissao").val().length > 0 && $("#txtDemissao").val().substring(6, 10) < "1900")
				{
					$("#lbDemissao").addClass("ls-error");
					$("#msgErroDemissao").text("Ano inválido.");
					$("#msgErroDemissao").show();
					erros++;
                }
                if($("#txtUsuario").val() != "" && $("#txtUsuario").val().length < 3)
				{
					$("#lbUsuario").addClass("ls-error");
					$("#msgErroUsuario").text("Tamanho insuficiente (< 3).");
					$("#msgErroUsuario").show();
					erros++;
                }
                if($("#txtUsuario").val() != "" && $("#txtSenha").val() == "")
				{
					$("#lbSenha").addClass("ls-error");
					$("#msgErroSenha").text("Senha em branco.");
					$("#msgErroSenha").show();
					erros++;
                }
                else
                if($("#txtUsuario").val() != "" && $("#txtSenha").val().length < 3)
				{
					$("#lbSenha").addClass("ls-error");
					$("#msgErroSenha").text("Tamanho insuficiente (< 3).");
					$("#msgErroSenha").show();
					erros++;
                }
                if($("#txtUsuario").val() != "" && $("#cbbNivel option:selected").val() == 0)
				{
					$("#lbNivel").addClass("ls-error");
					$("#msgErroNivel").text("Nivel em branco.");
					$("#msgErroNivel").show();
					erros++;
                }
				if(erros == 0)
					$.ajax({
						type: "POST",
						data: {
							acao: "salvarProfissional",
							cod: $("#txtCod").val(), 
							nome: $("#txtNome").val(),                        
							cpf: $("#txtCpf").val(),
							rg: $("#txtRg").val(),
							funcao: $("#txtFuncao").val(),
							fixo: $("#txtFixo").val(),
							celular: $("#txtCelular").val(),
							rua: $("#txtRua").val(),
							numero: $("#txtNumero").val(),
							bairro: $("#txtBairro").val(),
							complemento: $("#txtComplemento").val(),
							estado: $("#cbbEstados option:selected").val(),
							cidade: $("#cbbCidades option:selected").val(),
							datanascimento: $("#txtNascimento").val(),
							dataadmissao: $("#txtAdmissao").val(),
                            datademissao: $("#txtDemissao").val(),
                            usuario: $("#txtUsuario").val(),
							senha: $("#txtSenha").val(),
							nivel: $("#cbbNivel option:selected").val()
						},
						url: "../utils/post.php",
						success: function(dados) {
							console.log("dados: "+dados);
							if(dados)
							{
								obj = JSON.parse(dados);
								$("#alertasModalTitulo").html("Profissional");
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