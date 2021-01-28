<?php 

$newedu = '
        <div class="ls-form ls-form-horizontal">
			<div class="row">
				<label class="ls-label col-md-8 col-xs-12">
					<b class="ls-label-text">Filtro: </b>
					<input type="text" id="txtFiltro" name="txtFiltro" class="ls-field">
				</label>
				<div class="col-md-2 col-xs-12">
					<label style="display:none">btn</label>
					<button id="btnFiltrar" name="btnFiltrar" class="ls-btn ls-ico-search ls-btn-block" onclick="carregaTabela()"> Filtrar</button>
				</div>
				<div class="col-md-2 col-xs-12">
                    <label style="display:none">btn</label>
					<button data-ls-module="modal" data-target="#modalCadastro" class="ls-btn-primary ls-btn-block ls-ico-plus" onclick="limparCampos()">Novo</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<table class="ls-table ls-bg-header" id="tbEducandos">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Nascimento</th>
								<th>RG</th>
								<th>Mãe</th>
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
                    <h4 class="ls-modal-title">Educando</h4>
                </div>
                <div class="ls-modal-body">
                    <div class="ls-form ls-form-horizontal">
						<div class="row">
							<input style="display:none" type="text" id="txtCod" name="txtCod" value="0">
                            <label class="ls-label col-md-6 col-xs-12" id="lbNome">
                                <b class="ls-label-text">Nome *</b>
								<input type="text" id="txtNome" name="txtNome" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroNome">Erro Nome</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbData">
                                <b class="ls-label-text">Data Nasc. *</b>
                                <div class="ls-prefix-group">
                                    <input type="text" id="txtData" name="txtData" class="datepicker ls-mask-date" placeholder="dd/mm/aaaa">
									<a class="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#txtData" href="#"></a>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroData">Erro Data</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbRg">
                                <b class="ls-label-text">RG *</b>
								<input type="text" id="txtRg" name="txtRg" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroRg">Erro Rg</small>
                            </label>
                        </div>
                        <div class="row">
                            <label class="ls-label col-md-6 col-xs-12" id="lbNomemae">
                                <b class="ls-label-text">Nome Mãe *</b>
								<input type="text" id="txtNomemae" name="txtNomemae" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroNomemae">Erro Nomemae</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbFixo">
                                <b class="ls-label-text">Telefone Fixo</b>
								<input type="text" id="txtFixo" name="txtFixo" class="ls-mask-phone8_with_ddd" placeholder="(00) 0000-0000">
								<small style="display:none" class="ls-help-message" id="msgErroFixo">Erro Fixo</small>
                            </label>

                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbCelular">
                                <b class="ls-label-text">Celular *</b>
								<input type="text" id="txtCelular" name="txtCelular" class="ls-field ls-mask-phone9_with_ddd" placeholder="(00) 00000-0000">
								<small style="display:none" class="ls-help-message" id="msgErroCelular">Erro Celular</small>
                            </label>
                        </div>
                        <div class="row">
                            <label class="ls-label col-md-5 col-xs-12" id="lbRua">
                                <b class="ls-label-text">Rua *</b>
								<input type="text" id="txtRua" name="txtRua" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroRua">Erro Rua</small>
                            </label>
                            <label class="ls-label col-md-2 col-xs-12" id="lbNumero">
                                <b class="ls-label-text">Número *</b>
								<input type="text" id="txtNumero" name="txtNumero" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroNumero">Erro Numero</small>
                            </label>
                            <label class="ls-label col-md-5 col-xs-12" id="lbBairro">
                                <b class="ls-label-text">Bairro *</b>
								<input type="text" id="txtBairro" name="txtBairro" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroBairro">Erro Bairro</small>
                            </label>
                        </div>
                        <div class="row">
                            <label class="ls-label col-md-4 col-xs-12" id="lbComplemento">
                                <b class="ls-label-text">Complemento</b>
								<input type="text" id="txtComplemento" name="txtComplemento" class="ls-field">
								<small style="display:none" class="ls-help-message" id="msgErroComplemento">Erro Complemento</small>
                            </label>
                            <label class="ls-label col-md-3 col-xs-12" id="lbEstados">
                                <b class="ls-label-text">Estado *</b>
                                <div class="ls-custom-select">
                                    <select class="ls-custom" id="cbbEstados" name="cbbEstados" onchange="getCidades()">
                                        <option value="0"></option>
                                        '.getEstadosCbb().'
									</select>
								</div>
									<small style="display:none" class="ls-help-message" id="msgErroEstados">Erro Estados</small>
                            </label>
                            <label class="ls-label col-md-5 col-xs-12" id="lbCidades">
                                <b class="ls-label-text">Cidade  *</b>
                                <div class="ls-custom-select">
                                    <select class="ls-custom" id="cbbCidades" name="cbbCidades">
                                        <option value="0"></option>
									</select>
								</div>
								<small style="display:none" class="ls-help-message" id="msgErroCidades">Erro Cidades</small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="ls-modal-footer">
                    <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                    <div class="ls-float-right">
                        <input id="btnCancelar" name="btnCancelar" type="button" class="ls-btn" value="Cancelar" onclick="limparCampos()" data-dismiss="modal">
                        <input type="button" class="ls-btn-primary " id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarEducando()">
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
							$("#txtData").val($(this).text());
						break;
						case 3:
							$("#txtRg").val($(this).text());
						break;
						case 4:
							$("#txtNomemae").val($(this).text());
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
					}
					cont++					
				});
				$("#txtCod").val(cod); 
				locastyle.modal.open("#modalCadastro");
			}
			function carregaTabela()
			{
                $("#tbEducandos .trId").each(function(){
					$(this).remove();	
				});
				$.ajax({
					type: "POST",
					data: { filtroEducando : $("#txtFiltro").val() },
					url: "../utils/post.php",
					success: function(dados) { 
						if(dados){
							obj = JSON.parse(dados);
							obj.forEach(function(item){
								var newRow = $("<tr class=\'trId\' id=\'"+item.cod+"\'>");	    
								var cols = "";
								cols += "<td>"+item.nome+"</td>";
								cols += "<td>"+item.dtnasc+"</td>";
								cols += "<td>"+item.rg+"</td>";
								cols += "<td>"+item.nomemae+"</td>";
								cols += "<td style=\'display:none\'>"+item.fixo+"</td>";
								cols += "<td>"+item.celular+"</td>";
								cols += "<td style=\'display:none\'>"+item.rua+"</td>";
								cols += "<td style=\'display:none\'>"+item.numero+"</td>";
								cols += "<td style=\'display:none\'>"+item.bairro+"</td>";
								cols += "<td style=\'display:none\'>"+item.complemento+"</td>";
								cols += "<td style=\'display:none\'>"+item.estado+"</td>";
								cols += "<td style=\'display:none\'>"+item.cidade+"</td>";
								cols += "<td><div class=\'ls-group-btn ls-float-right\'><button onClick=\'editCad("+item.cod+")\' id=\'btnEditar\' name=\'btnEditar\' class=\'ls-no-margin-top ls-btn-xs ls-btn ls-ico-pencil\'/><button id=\'btnExcluir\' name=\'btnExcluir\' class=\'ls-no-margin-top ls-btn-xs ls-btn-danger ls-ico-remove\' onClick=\'confirmaExclusao("+item.cod+")\'/></div></td>";
								newRow.append(cols);
								$("#tbEducandos").append(newRow);
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
					async: false,
					data: { getByEstado : $("#cbbEstados option:selected").val() },
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
			function escondeErros()
			{
				$("#msgErroNome").hide();
				$("#msgErroData").hide();
				$("#msgErroRg").hide();
				$("#msgErroNomemae").hide();
				$("#msgErroFixo").hide();
				$("#msgErroCelular").hide();
				$("#msgErroRua").hide();
				$("#msgErroNumero").hide();
				$("#msgErroBairro").hide();
				$("#msgErroComplemento").hide();
				$("#msgErroEstados").hide();
				$("#msgErroCidades").hide();
				$("#lbNome").removeClass("ls-error");
				$("#lbData").removeClass("ls-error");
				$("#lbRg").removeClass("ls-error");
				$("#lbNomemae").removeClass("ls-error");
				$("#lbFixo").removeClass("ls-error");
				$("#lbCelular").removeClass("ls-error");
				$("#lbRua").removeClass("ls-error");
				$("#lbNumero").removeClass("ls-error");
				$("#lbBairro").removeClass("ls-error");
				$("#lbComplemento").removeClass("ls-error");
				$("#lbEstados").removeClass("ls-error");
				$("#lbCidades").removeClass("ls-error");
			}
            function limparCampos()
            {
                $("#txtCod").val("0");
                $("#txtNome").val("");
                $("#txtData").val("");  
                $("#txtRg").val("");  
                $("#txtNomemae").val("");  
                $("#txtFixo").val("");  
                $("#txtCelular").val("");  
                $("#txtRua").val("");
                $("#txtNumero").val(""); 
                $("#txtBairro").val(""); 
                $("#txtComplemento").val(""); 
                $("#cbbEstados").val("0");
				getCidades();
				escondeErros();
            }
            function salvarEducando()
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
				if($("#txtRg").val() == "")
				{
					$("#lbRg").addClass("ls-error");
					$("#msgErroRg").text("RG em branco.");
					$("#msgErroRg").show();
					erros++;
				}
				if($("#txtNomemae").val() == "")
				{
					$("#lbNomemae").addClass("ls-error");
					$("#msgErroNomemae").text("Nome mãe em branco.");
					$("#msgErroNomemae").show();
					erros++;
				}
				else
				if($("#txtNomemae").val().length < 3)
				{
					$("#lbNomemae").addClass("ls-error");
					$("#msgErroNomemae").text("Tamanho insuficiente (< 3).");
					$("#msgErroNomemae").show();
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
				if(erros == 0)
					$.ajax({
						type: "POST",
						data: {
							acao: "salvarEducando",
							cod: $("#txtCod").val(),
							nome: $("#txtNome").val(),
							datanascimento: $("#txtData").val(),
							rg: $("#txtRg").val(),
							nomemae: $("#txtNomemae").val(),
							fixo: $("#txtFixo").val(),
							celular: $("#txtCelular").val(),
							rua: $("#txtRua").val(),
							numero: $("#txtNumero").val(),
							bairro: $("#txtBairro").val(),
							complemento: $("#txtComplemento").val(),
							estado: $("#cbbEstados option:selected").val(),
							cidade: $("#cbbCidades option:selected").val()
						},
						url: "../utils/post.php",
						success: function(dados) {
							console.log("dados: "+dados);
							if(dados)
							{
								obj = JSON.parse(dados);
								$("#alertasModalTitulo").html("Educando");
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
            function confirmaExclusao(cod, programa)
            {
                bootbox.confirm({
                    title: "Educando",
                    message: "Deseja mesmo excluir o registro? Isso não poderá ser desfeito.",
                    buttons: {
                        cancel: {
                            label: "<i class=\'fa fa-times\'></i> Cancelar",
                            className: "btn-sm btn-secondary"
                        },
                        confirm: {
                            label: "<i class=\'fa fa-check\'></i> Sim",
                            className: "btn-sm btn-danger"
                        }
                    },
                    callback: function(result){
                        if(result)
                            excluiUsuario(cod, programa);
                    }
                });
            }
            function excluiUsuario(cod, programa)
            {
                $.ajax({
                    type: "POST",
                    data: { 
                        acao : "salvarUsuario",
                        transacao : "D",
                        programa : programa,
                        usuario : cod,
                        dataini : "",
                        dtcontrato : "",
                        arquivo : "",
                        risco : "",
                        descrisco : "",
                        kit : "",
                        kititens : "",
                        obs : ""
                    },
                    url: "../Config/post.php",
                    success: function(dados)
                    {
                        if(dados)
                        {
                            obj = $.parseJSON(dados);
                            if(obj.condicao)
                                titulo = "<span style=\'color:#016EB3\'>Usuário</span>";
                            else
                                titulo = "<span style=\'color:#CD3333\'>Usuário</span>";														
                            if(obj.retorno != "")
                                mensagem = obj.retorno;
                            else
                                mensagem = "Nenhum texto retornado";
                            bootbox.alert({
                                title: titulo,
                                message: mensagem,
                                buttons: {
                                    ok: {
                                        label: "Ok",
                                        className: "btn-secondary"
                                    }
                                }
                            });			
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