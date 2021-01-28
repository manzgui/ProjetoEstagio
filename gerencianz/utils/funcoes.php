<?php
	function getEstadosCbb()
	{
		$auxEstado = new CEstado();
		$dados = '';
		foreach($auxEstado->getEstados() as $estado)
		{
			$dados .= '<option value="'.$estado->getId().'">'.$estado->getUf().' - '.$estado->getNome().'</option>';
		}
		unset($auxEstado);				
		return $dados;
    }
    function getProfissionaisCbb()
	{
		$auxProfissional = new CProfissional();
		$dados = '';
		foreach($auxProfissional->getProfissionaisCbb() as $prof)
		{
			$dados .= '<option value="'.$prof->getCod().'">'.$prof->getNome().'</option>';
		}
		unset($auxProfissional);				
		return $dados;
    }
	function getVoluntariosCbb()
	{
		$auxVoluntario = new CVoluntario();
		$dados = '';
		foreach($auxVoluntario->getVoluntariosCbb() as $vol)
		{
			$dados .= '<option value="'.$vol->getCod().'">'.$vol->getNome().'</option>';
		}
		unset($auxVoluntario);				
		return $dados;
    }
    function getEducandosCbb()
	{
		$auxEducando = new CEducando();
		$dados = '';
		foreach($auxEducando->getEducandosCbb() as $educ)
		{
			$dados .= '<option value="'.$educ->getCod().'">'.$educ->getNome().'</option>';
		}
		unset($auxEducando);				
		return $dados;
    }
    function getTiposMaterialCbb()
    {
        $auxTipoMaterial = new CTipoMaterial();
        $dados = '';
        foreach($auxTipoMaterial->getTiposMaterialCbb() as $mat)
        {
            $dados .= '<option value="'.$mat->getCod().'">'.$mat->getDescricao().'</option>';
        }
        unset($auxTipoMaterial);
        return $dados;
    }
    
?>