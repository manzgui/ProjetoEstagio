<?php

$config = '
        <div class="ls-form ls-form-horizontal" data-ls-module="form">
            <div class="row">
                <input style="display:none" type="text" id="txtCod" name="txtCod" value="0">
                <label class="ls-label col-md-6 col-xs-12" id="lbRazao">
                    <b class="ls-label-text">Razão Social *</b>
                    <input type="text" id="txtRazao" name="txtRazao" class="ls-field">
                    <small style="display:none" class="ls-help-message" id="msgErroRazao">Erro Razao</small>
                </label>
                <label class="ls-label col-md-6 col-xs-12" id="lbFantasia">
                    <b class="ls-label-text">Nome Fantasia *</b>
                    <input type="text" id="txtFantasia" name="txtFantasia" class="ls-field">
                    <small style="display:none" class="ls-help-message" id="msgErroFantasia">Erro Fantasia</small>
                </label>
            </div>
            <div class="row">
                <label class="ls-label col-md-3 col-xs-12" id="lbCnpj">
                    <b class="ls-label-text">CNPJ *</b>
                    <input type="text" id="txtCnpj" name="txtCnpj" class="ls-mask-cnpj" placeholder="00.000.000/0000-00">
                    <small style="display:none" class="ls-help-message" id="msgErroCnpj">Erro Cnpj</small>
                </label>
                <label class="ls-label col-md-3 col-xs-12" id="lbInscricao">
                    <b class="ls-label-text">Inscrição Estadual </b>
                    <input type="text" id="txtInscricao" name="txtInscricao" class="ls-field">
                    <small style="display:none" class="ls-help-message" id="msgErroInscricao">Erro Inscricao</small>
                </label>
                <label class="ls-label col-md-3 col-xs-12" id="lbFixo">
                    <b class="ls-label-text">Telefone Fixo *</b>
                    <input type="text" id="txtFixo" name="txtFixo" class="ls-mask-phone8_with_ddd" placeholder="(00) 0000-0000">
                    <small style="display:none" class="ls-help-message" id="msgErroFixo">Erro Fixo</small>
                </label>
                <label class="ls-label col-md-3 col-xs-12" id="lbCelular">
                    <b class="ls-label-text">Celular *</b>
                    <input type="text" id="txtCelular" name="txtCelular" class="ls-mask-phone9_with_ddd" placeholder="(00) 00000-0000">
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
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="ls-float-right">
                        <input type="button" class="ls-btn" value="Limpar Campos" onclick="limparCampos()">
                        <input type="button" class="ls-btn-primary" id="btnSalvar" name="btnSalvar" value="Salvar" onclick="salvarParametrizacao()">
                    </div>
                </div>    
            </div>
        </div>

        <script type="text/javascript">
            window.onload = function(){
                carregaDados();
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
            function carregaDados()
			{
				$.ajax({
					type: "POST",
					data: { filtroParametrizacao : "existe" },
					url: "../utils/post.php",
					success: function(dados) { 
                        if(dados)
                        {
							obj = JSON.parse(dados);
                            obj.forEach(function(item)
                            {
                                $("#txtCod").val(item.cod);
                                $("#txtRazao").val(item.razao);
                                $("#txtFantasia").val(item.fantasia);
                                $("#txtCnpj").val(item.cnpj);
                                $("#txtInscricao").val(item.inscricao);
                                $("#txtFixo").val(item.fixo);
                                $("#txtCelular").val(item.celular);
                                $("#txtRua").val(item.rua);
                                $("#txtNumero").val(item.numero);
                                $("#txtBairro").val(item.bairro);
                                $("#txtComplemento").val(item.complemento);
                                $("#cbbEstados").val(item.estado);
                                getCidades();
                                $("#cbbCidades").val(item.cidade);
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
				$("#msgErroRazao").hide();
				$("#msgErroFantasia").hide();
				$("#msgErroCnpj").hide();
				$("#msgErroInscricao").hide();
				$("#msgErroFixo").hide();
				$("#msgErroCelular").hide();
				$("#msgErroRua").hide();
				$("#msgErroNumero").hide();
				$("#msgErroBairro").hide();
				$("#msgErroComplemento").hide();
				$("#msgErroEstados").hide();
				$("#msgErroCidades").hide();
				$("#lbRazao").removeClass("ls-error");
				$("#lbFantasia").removeClass("ls-error");
				$("#lbCnpj").removeClass("ls-error");
				$("#lbInscricao").removeClass("ls-error");
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
                $("#txtRazao").val("");
                $("#txtFantasia").val("");  
                $("#txtCnpj").val("");  
                $("#txtInscricao").val("");  
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
            function validaCnpj(cnpj)
            {
                cnpj = cnpj.replace(/[^\d]+/g, "");
                if (cnpj == "") return false;            
                if (cnpj.length != 14)
                    return false;                         
                if (cnpj == "00000000000000" ||
                    cnpj == "11111111111111" ||
                    cnpj == "22222222222222" ||
                    cnpj == "33333333333333" ||
                    cnpj == "44444444444444" ||
                    cnpj == "55555555555555" ||
                    cnpj == "66666666666666" ||
                    cnpj == "77777777777777" ||
                    cnpj == "88888888888888" ||
                    cnpj == "99999999999999")
                    return false;                         
                tamanho = cnpj.length - 2
                numeros = cnpj.substring(0, tamanho);
                digitos = cnpj.substring(tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--) 
                {
                    soma += numeros.charAt(tamanho - i) * pos--;
                    if (pos < 2)
                        pos = 9;
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(0)) return false;
                tamanho = tamanho + 1;
                numeros = cnpj.substring(0, tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--)
                {
                    soma += numeros.charAt(tamanho - i) * pos--;
                    if (pos < 2)
                        pos = 9;
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(1))
                    return false;            
                return true;
            
            }
            function salvarParametrizacao()
            {
				escondeErros();
				erros = 0;
				if($("#txtRazao").val() == "")
				{
					$("#lbRazao").addClass("ls-error");
					$("#msgErroRazao").text("Razão Social em branco.");
					$("#msgErroRazao").show();
					erros++;
				}
				else
				if($("#txtRazao").val().length < 3)
				{
					$("#lbRazao").addClass("ls-error");
					$("#msgErroRazao").text("Tamanho insuficiente (< 3).");
					$("#msgErroRazao").show();
					erros++;
				}
				if($("#txtFantasia").val() == "")
				{
					$("#lbFantasia").addClass("ls-error");
					$("#msgErroFantasia").text("Nome Fantasia em branco.");
					$("#msgErroFantasia").show();
					erros++;
				}
				else
				if($("#txtFantasia").val().length < 3)
				{
					$("#lbFantasia").addClass("ls-error");
					$("#msgErroFantasia").text("Tamanho insuficiente (< 3).");
					$("#msgErroFantasia").show();
					erros++;
				}
				if($("#txtCnpj").val() == "")
				{
					$("#lbCnpj").addClass("ls-error");
					$("#msgErroCnpj").text("CNPJ em branco.");
					$("#msgErroCnpj").show();
					erros++;
                }
                else
                if($("#txtCnpj").val().length != 18)
				{
					$("#lbCnpj").addClass("ls-error");
					$("#msgErroCnpj").text("Formato incorreto.");
					$("#msgErroCnpj").show();
					erros++;
                }
                else
                if(!validaCnpj($("#txtCnpj").val()))
                {
                    $("#lbCnpj").addClass("ls-error");
					$("#msgErroCnpj").text("CNPJ inválido.");
					$("#msgErroCnpj").show();
					erros++;
                }
				if($("#txtInscricao").val().length > 0 && $("#txtInscricao").val().length < 3)
				{
					$("#lbInscricao").addClass("ls-error");
					$("#msgErroInscricao").text("Inscrição Estadual em branco.");
					$("#msgErroInscricao").show();
					erros++;
                }
                if($("#txtFixo").val() == "")
				{
					$("#lbFixo").addClass("ls-error");
					$("#msgErroFixo").text("Telefone Fixo em branco.");
					$("#msgErroFixo").show();
					erros++;
                }
                else
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
							acao: "salvarParametrizacao",
							cod: $("#txtCod").val(),
							razao: $("#txtRazao").val(),
							fantasia: $("#txtFantasia").val(),
							cnpj: $("#txtCnpj").val(),
							inscricao: $("#txtInscricao").val(),
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
								$("#alertasModalTitulo").html("Configuração");
								$("#alertasModalTexto").html(obj.retorno);
								$("#alertasModal").show();
								if(obj.condicao)
                                    carregaDados;
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