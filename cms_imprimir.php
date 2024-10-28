<?php 
	include "cms_funcoes.php";
	autenticar(1, "");
    
    if(strlen($_GET["data"]) == 10){
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $time      = strtotime(str_replace("/", "-", $_GET["data"]));
        $newformat = strftime('%d', $time)." de ".ucfirst(strftime('%B', $time))." de ".strftime('%Y', $time);
    }

if(isset($_GET["c"])){
	
	//Carrega usuário	
	if ($_SESSION["usuario"]["tipo"] == 0 && $_SESSION["escritorio"]["id"] == -1){
			
		$rSetImp1 = $GLOBALS["cn"][1]->query('SET SQL_BIG_SELECTS=1');
		$rSetImp1 = $GLOBALS["cn"][1]->prepare("SELECT C.*, R.id as r_id, R.chave as r_chave, R.escritorio_id as r_escritorio_id, R.responsavel_id as r_responsavel_id, R.cujus_id as r_cujus_id, R.nome as r_nome, R.cpf as r_cpf, R.rg as r_rg, R.profissao as r_profissao, R.nacionalidade as r_nacionalidade, R.estadoCivil as r_estadoCivil, R.sexo as r_sexo, R.nascimento as r_nascimento, R.telefone1 as r_telefone1, R.telefone2 as r_telefone2, R.telefone3 as r_telefone3, R.telefone4 as r_telefone4, R.email as r_email, R.cep as r_cep, R.endereco as r_endereco, R.complemento as r_complemento, R.numero as r_numero, R.bairro as r_bairro, R.cidade as r_cidade, R.estado as r_estado, R.observacao as r_observacao, R.representado as r_representado, E.id as e_id, E.nome as e_nome, E.cidade as e_cidade, E.uf as e_uf, E.outorgado as e_outorgado, P.id as p_id, P.chave as p_chave, P.cliente_id as p_cliente_id, P.numero as p_numero, P.tipo as p_tipo, P.data as p_data, P.url as p_url, P.status as p_status, P.usuario_id as p_usuario_id 

		FROM cliente C 

		LEFT JOIN cliente R ON C.id = R.responsavel_id
		LEFT JOIN processo P ON C.id = P.cliente_id
		INNER JOIN escritorio E ON C.escritorio_id = E.id

		WHERE C.chave = '".$_GET["c"]."' AND C.responsavel_id IS NULL");
		$rSetImp1->execute();
		
	}else{
		$rSetImp1 = $GLOBALS["cn"][1]->query('SET SQL_BIG_SELECTS=1');
		$rSetImp1 = $GLOBALS["cn"][1]->prepare("SELECT C.*, R.id as r_id, R.chave as r_chave, R.escritorio_id as r_escritorio_id, R.responsavel_id as r_responsavel_id, R.cujus_id as r_cujus_id, R.nome as r_nome, R.cpf as r_cpf, R.rg as r_rg, R.profissao as r_profissao, R.nacionalidade as r_nacionalidade, R.estadoCivil as r_estadoCivil, R.sexo as r_sexo, R.nascimento as r_nascimento, R.telefone1 as r_telefone1, R.telefone2 as r_telefone2, R.telefone3 as r_telefone3, R.telefone4 as r_telefone4, R.email as r_email, R.cep as r_cep, R.endereco as r_endereco, R.complemento as r_complemento, R.numero as r_numero, R.bairro as r_bairro, R.cidade as r_cidade, R.estado as r_estado, R.observacao as r_observacao, R.representado as r_representado, E.id as e_id, E.nome as e_nome, E.cidade as e_cidade, E.uf as e_uf, E.outorgado as e_outorgado, P.id as p_id, P.chave as p_chave, P.cliente_id as p_cliente_id, P.numero as p_numero, P.tipo as p_tipo, P.data as p_data, P.url as p_url, P.status as p_status, P.usuario_id as p_usuario_id 

		FROM cliente C 

		LEFT JOIN cliente R ON C.id = R.responsavel_id
		LEFT JOIN processo P ON C.id = P.cliente_id
		INNER JOIN escritorio E ON C.escritorio_id = E.id

		WHERE C.chave = '".$_GET["c"]."' AND C.responsavel_id IS NULL AND C.escritorio_id = ".$_SESSION["escritorio"]["id"]);
		$rSetImp1->execute();
	}		
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$GLOBALS["cms"]["title"]?></title>
</head>

<body onload="window.print()">	

	<?
	if ($rSetImp1->rowCount() > 0) {
				
	while($rSetImp = $rSetImp1->fetch()){ 
	
	registro(1, "Imprimir", "Imprimiu documentos de: ".$rSetImp["nome"]);
	
	?>
	
	<? if(isset($_GET["c10"]) || isset($_GET["c20"]) || isset($_GET["c30"])){	
	   $contrato = [
        1 => [
            1=>10,
            2=>"DEZ"
        ],
        2 => [
            1=>20,
            2=>"VINTE"
        ],
		3 => [
            1=>30,
            2=>"TRINTA"
        ],
    ];
	?>
	
	<!-- CONTRATOS -->
	<? for($i = 1; $i <= 3; $i++) { ?>
	<? if(isset($_GET["c".$contrato[$i][1]])){?>		
    <table width="88%" border="0" align="center" cellpadding="0" cellspacing="5" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:150%;">
      <tr>
		  <td align="center" height="1%">
			<table width="85%" border="0" align="center" cellpadding="0" cellspacing="2">
			  <tr>
				<td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
			  </tr>
			</table>
		  </td>
		</tr>
      <tr>
            <td align="center" style="font-size:14px;"><br><b><u><em>CONTRATO DE PRESTAÇÃO DE SERVIÇO</em></u></b></td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="text-align:justify;">
                <span style="margin-left:70px;">Pelo</span> presente instrumento de contrato de honorários advocatícios, o(a) infra-assinado(a)
                contrata os serviços da <b><u>ADVOCACIA BALDAN</u></b>, CNPJ: 07.070.927/0001-47 com escritório na Rua
                Paraíba nº 377, Centro, na cidade de Catanduva-SP, CEP 15800-070, para o fim especial de propor e,
                defender perante a justiça competente a(s) ação(es), e /ou de forma administrativa benefício efetuado
                requerimento consoantes os poderes que lhe foram outorgados defendendo, assim os interesses do
                outorgante até sentenças ou decisão final, pelos <b>honorários correspondente e equivalente a 05 (cinco)
                primeiros pagamentos divididos em 10 (dez) parcelas fixas e mensais cada, dando-se início da
                primeira parcela a partir do recebimento do benefício em caso de recebimento e implantação
                administrativa ou de tutela antecipada, honorários de <u><?=$contrato[$i][1]?>% (<?=$contrato[$i][2]?> POR CENTO)</u></b> incidentes sobre o
                “quantum” apurável na execução do julgado, até o seu efetivo pagamento <b>(DO VALOR TOTAL DO
                PROVEITO ECONÔMICO OBTIDO PELO CLIENTE TANTO JUDICIAL COMO ADMINISTRATIVO) e
                mais o percentual de 10% sobre o valor determinado em execução de sentença a título de
                honorários de contador/cálculos.</b> O outorgante CONCORDA que os valores dos honorários
                contratados sejam destacados do valor a receber., <b>“QUOTA LITIS”</b> consoante <b>ARTIGO 38</b> –
                CÓDIGO DE ÉTICA – além dos honorários de sucumbência das ações judiciais, havendo desde já <b>prévia
                autorização</b> para compensação ou desconto dos mesmos no ato do levantamento dos depósitos
                judiciais. Os honorários serão devidos, outrossim, em razão de acordo, ou autorização administrativa que
                se opera após propositura das medidas cabíveis, administrativas e/ou judiciais, tudo em síntese com
                o <b>ESTATUTO DA ADVOCACIA – Lei nº 8.906, de 04 de julho de 1994.</b> O porcentual contratado a
                título de honorários serão devidos ainda assim, no caso em que o advogado sem motivo justo,
                tenha que renunciar, tenha revogado o mandato que lhe foi outorgado, ou em caso de desistência
                da ação proposta, no caso do valor dos honorários não atingir valor mínimo da tabela de
                honorários da OAB.SP ADVOCACIA PREVIDENCIÁRIA, será cobrado o valor mínimo de R$ 3.200,55,
                conforme <b>tabela da OAB/SP</b>.
                <br><br>
                As despesas havidas pela contratada com a propositura e condução do processo tanto
                judicial quanto administrativo, serão deduzidas do valor a receber pelo contratante, o que desde já
                expressamente autoriza.
            </td>
        </tr>
      <tr>
        <td align="left" style="text-align:justify;"><span style="margin-left:70px;"><b><u>Acordam</span> ainda, que, na hipótese de insucesso da(s) medidas(s) requeridas(s), nenhuma verba será devida ao profissional contratado</u></b>, a qualquer titulo e forma, sendo por outro lado dispensável a prestação de conta de custas processuais ou despesas, firmando que todas as despesas correrão por conta dos advogados, exceto se obtiver ganho de causa e beneficio à parte, ocasião em que as despesas serão suportadas pelo contratante e descontadas na execução. <b>Declarando ainda que não fez qualquer adiantamento de honorários ou de despesas e não o fará no curso do processo.</b> <br><br><span style="margin-left:70px;">O</span> presente contrato obriga não só o contratante como também seus herdeiros ou sucessores.</td>
      </tr>
      <tr>
        <td align="center"><?=$_GET["cidade-estado"]?> ,
            <?if(strlen($_GET["data"]) == 10){?>
               <?=$newformat?>
            <?}else{?>
                
            <?}?>
        </td>		  
      </tr>
      <tr>
        <td align="center" valign="bottom" height="100">_______________________________________________</td>
      </tr>
      <tr>
        <td align="center">
			<strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
		</td>
        </tr>
      <tr>
        <td align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" width="10%">
              <div style="position:relative;">
                <table border="0" align="left" cellpadding="0" cellspacing="0" style="display: none;">
                  <tr>
                    <td align="left" valign="bottom" height="50">
                      <div style="position:absolute; width:50%; height:50%; left:0px; top:0px;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/assinatura-paulo.png"/></div>
                      ________________________________
                      </td>
                    </tr>
                  <tr>
                    <td align="left" style="font-size:12px;">CONTRATADO<br />
                      PAULO RUBENS BALDAN<br />
                      OAB-SP sob n. 288.842</td>
                    </tr>
                  </table>
              </div>
              </td>
              <td align="center">
                <div style="position:relative;">
                  <table border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center" valign="bottom" height="100">
                        <div style="position:absolute; width:100%; height:100%; left:0px; top:-10px;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/assinatura-fernando.png"/></div>
                        ________________________________
                        </td>
                      </tr>
                    <tr>
                      <td align="center" style="font-size:12px;">CONTRATADO<br />
                        ADVOCACIA BALDAN</td>
                      </tr>
                    </table>
                  </div>
                </td>
				<td align="center" width="10%">
              	<div style="position:relative;">
                <table border="0" align="left" cellpadding="0" cellspacing="0" style="display: none;">
                  <tr>
                    <td align="left" valign="bottom" height="150">
                      <div style="position:absolute; width:100%; height:100%; left:0px; top:0px;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/assinatura-paulo.png"/></div>
                      ________________________________
                      </td>
                    </tr>
                  <tr>
                    <td align="left" style="font-size:12px;">CONTRATADO<br />
                      PAULO RUBENS BALDAN<br />
                      OAB-SP sob n. 288.842</td>
                    </tr>
                  </table>
              </div>
              </td>
              </tr>
          </table></td>
      </tr>
      <tr>
        <td align="left">TESTEMUNHAS:</td>
      </tr>
      <tr>
        <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" width="50%"><table border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center">________________________________</td>
              </tr>
            </table></td>
            <td align="center"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center">________________________________</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
	<? } } } ?>

	<!-- DECLARAÇÃO DE POBREZA -->
	<? if(isset($_GET["dp"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>DECLARAÇÃO</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
				<?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora " : "portador "?> da cédula de identidade RG nº. <?=$rSetImp["rg"]?> e do CPF nº. <?=$rSetImp["cpf"]?> neste ato <?=$rSetImp["sexo"] == "Feminino" ? "representada " : "representado "?> por <?=mb_strtolower($rSetImp["r_representado"])?> e responsável legal <b><?=mb_strtoupper($rSetImp["r_nome"])?></b>, <?=mb_strtolower($rSetImp["r_nacionalidade"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["r_estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["r_estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["r_profissao"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["r_rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["r_cpf"]?></span>, residente e <?=$rSetImp["r_sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["r_cidade"]?> - <?=$rSetImp["r_estado"]?>, na <?=$rSetImp["r_endereco"]?>, nº <?=$rSetImp["r_numero"]?>&nbsp; <?=$rSetImp["r_complemento"]?> <?=$rSetImp["r_bairro"]?>, CEP: <?=$rSetImp["r_cep"]?>.<br /></td>
				<?}else{?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e <?=$rSetImp["sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["cidade"]?> - <?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>.<br /></td>
				<?}?>                
              </tr>              
              
              
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;">DECLARA(m)</span>, para os devidos fins e para que produza os efeitos de direito que é (são) pobre(s) na verdadeira acepção da palavra, não reunindo condições de suportar com as despesas processuais e honorários de advogado, sem prejuízo próprio e da sua família, <strong><u>bem como reside(m) no endereço indicado nesta declaração</u></strong>. </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;">Por</span> ser expressão da verdade, firma(m) a presente declaração que vai assinada de próprio punho e, sob as penas da lei.</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                    <?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
                        <strong><?=mb_strtoupper($rSetImp["r_nome"])?></strong>
                    <?}else{?>
                        <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                    <?}?>
                </strong></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style="border-top:solid 2px #000; height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
    <? } ?>

	<!-- DECLARAÇÃO DE RESIDENCIA -->
	<? if(isset($_GET["dr"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>DECLARAÇÃO DE RESIDÊNCIA</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
                  
			  
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;">Eu, <b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, <u>DECLARA</u> para fins de direito que reside na cidade de <?=$rSetImp["cidade"]?> - <?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>.<br /></td>
              </tr>
              
              
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:240px;">Por</span> ser a expressão da verdade, assumindo inteira responsabilidade pelas declarações acima sob as penas da lei, assino para que produza seus efeitos legais. </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                    <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                </strong></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? }?>

	<!-- DECLARAÇÃO DE ENDEREÇO -->
	<? if(isset($_GET["de"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>DECLARAÇÃO DE ENDEREÇO</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;">Eu, ____________________________________________________________, RG n° ______________________________, declaro, sob as penas do artigo 299 do Código Penal*, que <?=$rSetImp["sexo"] == "Feminino" ? "a Sra." : "o Sr."?>. <b><?=mb_strtoupper($rSetImp["nome"])?></b>, RG nº <?=$rSetImp["rg"]?>, mora em minha residência, localizada no endereço abaixo: <br><br><?=$rSetImp["endereco"]?> nº <?=$rSetImp["numero"]?>, &nbsp;<?=$rSetImp["bairro"]?>, <?=$rSetImp["cidade"]?>-<?=$rSetImp["estado"]?>, CEP: <?=$rSetImp["cep"]?>.<br /></td>
              </tr>
              
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left"><p>Observações:</p>
                  <p>1. Apresentar junto com esta declaração cópia e original de comprovante de endereço recente (até 3 meses), com CEP, como conta de energia elétrica, gás ou telefone;</p>
                  <p>2. Não é necessário o reconhecimento da assinatura em Cartório.</p>
                  <p>* Código Penal, art. 299: &ldquo;Falsidade ideológica. Art. 299 - Omitir, em documento público ou particular, declaração que dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da que devia ser escrita, com o fim de prejudicar direito, criar obrigação ou alterar a verdade sobre fato juridicamente relevante:</p>
                <p>Pena - reclusão, de um a cinco anos, e multa, se o documento é público, e reclusão de um a três anos, e multa, se o documento é particular. Parágrafo único - Se o agente é funcionário público, e comete o crime prevalecendo-se do cargo, ou se a falsificação ou alteração é de assentamento de registro civil, aumenta-se a pena de sexta parte.</p></td>
            </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? }?>

    <!-- PRESTAÇÃO DE CONTAS -->
	<? if(isset($_GET["pc"])){?>
	<table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>DECLARAÇÃO DE PRESTAÇÃO DE CONTAS</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              
              
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><b>Outorgante(s):</b> <span ><b><?=mb_strtoupper($rSetImp["nome"])?></b></span>, <?=$rSetImp["nacionalidade"]?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador" ?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e domiciliado em <?=$rSetImp["cidade"]?>-<?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>, <strong><u>DECLARA</u></strong> para os fins e efeitos legais que lhe foi apresentado a <strong><u>PRESTAÇÃO DE CONTAS</u></strong> referentes ao processo n° ______________________________, sendo que recebeu seu crédito, já abatido os honorários advocatícios contratados, dando assim por satisfeito.</td>
              </tr>
              
              
              
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:240px;">Por </span> ser expressão da verdade e para que produza os efeitos legais, firma a presente declaração.</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                    <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                </strong></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? }?>
    
    <!-- DECLARAÇÃO NÚCLEO FAMILIAR -->
	<? if(isset($_GET["nf"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>DECLARAÇÃO COMPOSIÇÃO DO NÚCLEO</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
				<?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora " : "portador "?> da cédula de identidade RG nº. <?=$rSetImp["rg"]?> e do CPF nº. <?=$rSetImp["cpf"]?> neste ato <?=$rSetImp["sexo"] == "Feminino" ? "representada " : "representado "?> por <?=mb_strtolower($rSetImp["r_representado"])?> e responsável legal <b><?=mb_strtoupper($rSetImp["r_nome"])?></b>, <?=mb_strtolower($rSetImp["r_nacionalidade"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["r_estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["r_estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["r_profissao"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["r_rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["r_cpf"]?></span>, residente e <?=$rSetImp["r_sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["r_cidade"]?> - <?=$rSetImp["r_estado"]?>, na <?=$rSetImp["r_endereco"]?>, nº <?=$rSetImp["r_numero"]?>&nbsp; <?=$rSetImp["r_complemento"]?> <?=$rSetImp["r_bairro"]?>, CEP: <?=$rSetImp["r_cep"]?>.<br /></td>
				<?}else{?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e <?=$rSetImp["sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["cidade"]?> - <?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>.<br /></td>
				<?}?>                
              </tr>              
              
              
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;">DECLARA(m)</span>, para os devidos fins e para que produza seus
jurídicos e legais efeitos que seu núcleo familiar é composto por: </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <?if(!empty($rSetImp["nucleo_familiar"]) && !isset($_GET["nucleo_familiar"])){?>
                  <tr>
                    <td align="left" valign="top" height="350" style="vertical-align: text-top;"><?=$rSetImp["nucleo_familiar"]?></td>
                  </tr>
              <?}else{?>
                  <tr>
                    <td align="left" height="350">&nbsp;</td>
                  </tr>
              <?}?>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;">Por</span> ser expressão da verdade, firma(m) a presente declaração que vai assinada de próprio punho e, sob as penas da lei.</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                    <?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
                        <strong><?=mb_strtoupper($rSetImp["r_nome"])?></strong>
                    <?}else{?>
                        <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                    <?}?>
                </strong></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style="border-top:solid 2px #000; height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
    <? } ?>
    
    <!-- DECLARAÇÃO DE ISENÇÃO IMPOSTO DE RENDA -->
	<? if(isset($_GET["iir"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>Declaração de Isenção do Imposto de Renda Pessoa Física (IRPF)</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
				<?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
					<td align="left" style="text-align:justify; line-height:200%;"><span><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora " : "portador "?> da cédula de identidade RG nº. <?=$rSetImp["rg"]?> e do CPF nº. <?=$rSetImp["cpf"]?> neste ato <?=$rSetImp["sexo"] == "Feminino" ? "representada " : "representado "?> por <?=mb_strtolower($rSetImp["r_representado"])?> e responsável legal <b><?=mb_strtoupper($rSetImp["r_nome"])?></b>, <?=mb_strtolower($rSetImp["r_nacionalidade"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["r_estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["r_estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["r_profissao"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["r_rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["r_cpf"]?></span>, residente e <?=$rSetImp["r_sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["r_cidade"]?> - <?=$rSetImp["r_estado"]?>, na <?=$rSetImp["r_endereco"]?>, nº <?=$rSetImp["r_numero"]?>&nbsp; <?=$rSetImp["r_complemento"]?> <?=$rSetImp["r_bairro"]?>, CEP: <?=$rSetImp["r_cep"]?>, DECLARO ser <?=$rSetImp["r_sexo"] == "Feminino" ? "isenta " : "isento "?> da apresentação da Declaração do Imposto de Renda Pessoa Física (DIRPF) no(s) exercício(s) ______________________________________________ por não incorrer em nenhuma das hipóteses de obrigatoriedade estabelecidas pelas Instruções Normativas (IN) da Receita Federal do Brasil (RFB).<br /></td>
				<?}else{?>
					<td align="left" style="text-align:justify; line-height:200%;"><span><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e <?=$rSetImp["sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["cidade"]?> - <?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>, DECLARO ser <?=$rSetImp["sexo"] == "Feminino" ? "isenta " : "isento "?> da apresentação da Declaração do Imposto de Renda Pessoa Física (DIRPF) no(s) exercício(s) ______________________________________________ por não incorrer em nenhuma das hipóteses de obrigatoriedade estabelecidas pelas Instruções Normativas (IN) da Receita Federal do Brasil (RFB).<br /></td>
				<?}?>
              </tr>
              
              <tr>
                <td align="left"><br>Esta declaração está em conformidade com a IN RFB no 1548/2015 e a Lei no 7.115/83*. <br><br> Declaro ainda, sob as penas da lei, serem verdadeiras todas as informações acima prestadas.</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">
                  <p>*Esclarecemos que a Receita Federal do Brasil não emite declaração de que o(a) cidadão(ã) está isento(a) de
apresentar a Declaração do Imposto de Renda da Pessoa Física (DIRPF), pois a Instrução Normativa RFB no 1548, de 25
de fevereiro de 2015, regula que, a partir do ano de 2008, deixa de existir a Declaração Anual de Isento. Ademais, a Lei
no 7.115/83 assegura que a isenção poderá ser comprovada mediante declaração escrita e assinada pelo próprio
interessado. Mais informações podem ser obtidas na página da RFB na internet, no seguinte endereço eletrônico:</p>
<p>http://receita.economia.gov.br/orientacao/tributaria/declaracoes-e-demonstrativos/dai-declaracao-anual-de-isento</p></td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">
                  <p><b>LEI Nº 7.115, DE 29 DE AGOSTO DE 1983.</b></p>
                  <p>Dispõe sobre prova documental nos casos que indica e dá outras providências.</p>
                  <p>O PRESIDENTE DA REPÚBLICA, faço saber que o Congresso Nacional decreta e eu sanciono a seguinte Lei:</p>
                  <p>Art. . 1o - A declaração destinada a fazer prova de vida, residência, pobreza, dependência econômica, homonímia ou bons
antecedentes, quando firmada pelo próprio interessado ou por procurador bastante, e sob as penas da Lei, presume-se verdadeira.
Parágrafo único - O dispositivo neste artigo não se aplica para fins de prova em processo penal.</p>
                  <p>Art. . 2o - Se comprovadamente falsa a declaração, sujeitar-se-á o declarante às sanções civis, administrativas e criminais previstas
na legislação aplicável.</p>
                  <p>Art. . 3o - A declaração mencionará expressamente a responsabilidade do declarante.</p>
                  <p>Art. . 4o - Esta Lei entra em vigor na data de sua publicação.</p>
                  <p>Art. . 5o - Revogam-se as disposições em contrário.</p>
                </td>
            </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? }?>

	<!-- PROCURAÇÃO FÍSICA -->
	<? if(isset($_GET["pr"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>PROCURAÇÃO</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>   
              <tr>
				<?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora " : "portador "?> da cédula de identidade RG nº. <?=$rSetImp["rg"]?> e do CPF nº. <?=$rSetImp["cpf"]?> neste ato <?=$rSetImp["sexo"] == "Feminino" ? "representada " : "representado "?> por <?=mb_strtolower($rSetImp["r_representado"])?> e responsável legal <b><?=mb_strtoupper($rSetImp["r_nome"])?></b>, <?=mb_strtolower($rSetImp["r_nacionalidade"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["r_estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["r_estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["r_profissao"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["r_rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["r_cpf"]?></span>, residente e <?=$rSetImp["r_sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["r_cidade"]?> - <?=$rSetImp["r_estado"]?>, na <?=$rSetImp["r_endereco"]?>, nº <?=$rSetImp["r_numero"]?>&nbsp; <?=$rSetImp["r_complemento"]?> <?=$rSetImp["r_bairro"]?>, CEP: <?=$rSetImp["r_cep"]?>.<br /></td>
				<?}else{?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e <?=$rSetImp["sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["cidade"]?> - <?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>.<br /></td>
				<?}?>                 
              </tr>              
              
            
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%; line-height:200%;"><strong>Outorgado (s): </strong> 
                
                <?=$rSetImp["e_outorgado"]?> Fernando Aparecido Baldan
                , brasileiro, casado, advogado, portador do CPF nº 002.519.718-56 e RG-SSP nº 6737489, inscrito na Ordem dos Advogados do Brasil, Seção de São Paulo sob o nº 58417; Paulo Rubens Baldan, brasileiro, solteiro, advogado, portador do CPF nº 285.863.778-48 e RG-SSP nº 29.728-974-3, inscrito na Ordem dos Advogados do Brasil, Seção de São Paulo sob o nº 288.842, todos com escritório na Rua Paraiba, nº. 377, Centro, na cidade de Catanduva-SP, aos qual confere, amplos, gerais e limitados poderes para o foro em geral, inclusive com a cláusula “ad judicia”, para em qualquer repartição, Instância, Juízo ou Tribunal, podendo propor contra quem de direito a (s) ação (ões) competente (s) e defende-lo (as) nas contrárias, seguindo umas e outras até final julgamento decisão, usando dos recursos legais e acompanhando-os conferindo-lhes ainda poderes especiais para confessar, transigir, desistir, firmar compromisso ou acordos, renunciar valores em execução, bem como renunciar ao valor de alçada, receber, levantar guias e alvarás judiciais, protocolar e dar quitação, propor ações, execuções, inclusive rescisória, contestar, adjudicar, bem como declaração de isenção de imposto de renda, agindo em conjunto ou separadamente podendo ainda, substabelecer esta à outrem, com ou sem reserva de iguais poderes, dando tudo, por bom firme e valioso na forma da Lei, com fins especial de renunciar o valor teto de alçada para fins de fixação de competência. </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                    <?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
                        <strong><?=mb_strtoupper($rSetImp["r_nome"])?></strong>
                    <?}else{?>
                        <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                    <?}?>
                </strong></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? }?>

    <!-- PROCURAÇÃO JURÍDICA -->
    <? if(isset($_GET["pr2"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>PROCURAÇÃO ADVOCACIA BALDAN</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>   
              <tr>
				<?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora " : "portador "?> da cédula de identidade RG nº. <?=$rSetImp["rg"]?> e do CPF nº. <?=$rSetImp["cpf"]?> neste ato <?=$rSetImp["sexo"] == "Feminino" ? "representada " : "representado "?> por <?=mb_strtolower($rSetImp["r_representado"])?> e responsável legal <b><?=mb_strtoupper($rSetImp["r_nome"])?></b>, <?=mb_strtolower($rSetImp["r_nacionalidade"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["r_estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["r_estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["r_profissao"])?>, <?=$rSetImp["r_sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["r_rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["r_cpf"]?></span>, residente e <?=$rSetImp["r_sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["r_cidade"]?> - <?=$rSetImp["r_estado"]?>, na <?=$rSetImp["r_endereco"]?>, nº <?=$rSetImp["r_numero"]?>&nbsp; <?=$rSetImp["r_complemento"]?> <?=$rSetImp["r_bairro"]?>, CEP: <?=$rSetImp["r_cep"]?>.<br /></td>
				<?}else{?>
					<td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;"><b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=mb_strtolower($rSetImp["nacionalidade"])?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>,</span> <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e <?=$rSetImp["sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["cidade"]?> - <?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>.<br /></td>
				<?}?>                 
              </tr>              
              
            
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%; line-height:200%;"><strong>Outorgado (s): </strong> 
                
                <?=$rSetImp["e_outorgado"]?> ADVOCACIA BALDAN, CNPJ: 07.070.927/0001-4, inscrita na Ordem dos Advogados do Brasil, Seção de São Paulo sob o nº 8.389, com escritório na Rua Paraiba, nº. 377, Centro, na cidade de Catanduva-SP, aos qual confere, amplos, gerais e limitados poderes para o foro em geral, inclusive com a cláusula “ad judicia”, para em qualquer repartição, Instância, Juízo ou Tribunal, podendo propor contra quem de direito a (s) ação (ões) competente (s) e defende-lo (as) nas contrárias, seguindo umas e outras até final julgamento decisão, usando dos recursos legais e acompanhando-os conferindo-lhes ainda poderes especiais para confessar, transigir, desistir, firmar compromisso ou acordos, renunciar valores em execução, bem como renunciar ao valor de alçada, receber, levantar guias e alvarás judiciais, protocolar e dar quitação, propor ações, execuções, inclusive rescisória, contestar, adjudicar, bem como declaração de isenção de imposto de renda, agindo em conjunto ou separadamente podendo ainda, substabelecer esta à outrem, com ou sem reserva de iguais poderes, dando tudo, por bom firme e valioso na forma da Lei, com fins especial de renunciar o valor teto de alçada para fins de fixação de competência. </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                    <?if(!empty($rSetImp["r_id"]) && isset($_GET["cassociados"])){?>
                        <strong><?=mb_strtoupper($rSetImp["r_nome"])?></strong>
                    <?}else{?>
                        <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                    <?}?>
                </strong></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? }?>

	<!-- AUTORIZAÇÃO BOLETO -->
	<? if(isset($_GET["bo"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>AUTORIZAÇÃO DE BOLETO</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>      
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><b>Outorgante(s):</b> <span ><b><?=mb_strtoupper($rSetImp["nome"])?></b></span>, <?=$rSetImp["nacionalidade"]?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e domiciliado em <?=$rSetImp["cidade"]?>-<?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?><br /></td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:230px;">Eu,</span> acima identificado, autorizo à emitir boletos de cobrança bancaria, referente a honorários advocatícios conforme previamente fixado em contrato escrito. </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                   <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                </strong></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? }?>

	<!-- TERMO COMPROMISSO -->
	<? if(isset($_GET["co"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" valign="top" style="border-bottom:solid 2px #000;"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp.png" border="0"/><br><br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" style="font-size:24px;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:16px;"><b><u>TERMO DE COMPROMISSO</u></b></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              
              <tr>
				<td align="left" style="text-align:justify; line-height:200%;"><b>COMPROMISSÁRIO:</b> <span ><b><?=mb_strtoupper($rSetImp["nome"])?></b></span>, <?=$rSetImp["nacionalidade"]?>, <?=$rSetImp["sexo"] == "Feminino" ? str_replace("o(a)", "a", mb_strtolower($rSetImp["estadoCivil"])) : str_replace("o(a)", "o", mb_strtolower($rSetImp["estadoCivil"]))?>, <?=mb_strtolower($rSetImp["profissao"])?>, <?=$rSetImp["sexo"] == "Feminino" ? "portadora" : "portador"?> do <span style="white-space: nowrap;">RG nº <?=$rSetImp["rg"]?></span> e do <span style="white-space: nowrap;">CPF nº <?=$rSetImp["cpf"]?></span>, residente e domiciliado em <?=$rSetImp["cidade"]?>-<?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?><br /></td>
              </tr>              
              
              
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:240px;">Comprometo-me</span> neste ato de não outorgar e também declaro não ter outorgado procuração para o mesmo fim, a outro profissional. Afirmo <strong>NÃO <u>ter ajuizado demanda judicial ou qualquer outro tipo com o mesmo objeto de ação,</u></strong> na comarca de meu domicilio ou em quaisquer outras comarcas do páis, sob pena de arcar com o pagamento de penalidades previstas em lei, além dos honorários advocatícios contratados, isentando os procurados de qualquer responsabilidade penal, cível ou administrativa.</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:240px;">Estou ciente</span> que toda documentação fornecida ao meu procurador (CÓPIAS DE CPF, RG, COMPROVANTE DE RESIDÊNCIA, LAUDOS MÉDICOS, PARECERES DA SEGURADORA DPVAT, DENTRE OUTROS NECESSÁRIOS) são verdadeiros(a), e com finalidade exclusiva para mover processo judicial em fase do Instituto Nacional do Seguro Social, objetivando o recebimento de beneficio previdenciários por incapacidade (Auxílio-Doença, Aposentadoria por Invalidez, Auxílio-Acidente, etc.)</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="text-align:justify; line-height:200%;"><span style="margin-left:240px;">Outrossim,</span> a "Procuração" e "Contrato de Honorários Advocatícios" firmados com o(s) advogados(a) desse escritório, respectivamente, é expressão verdadeira de minha livre e espontânea vontade.</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?=$_GET["cidade-estado"]?> 
                    <?if(strlen($_GET["data"]) == 10){?>
                       <?=$newformat?>
                    <?}else{?>
                        
                    <?}?>
                </td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">__________________________________________</td>
              </tr>
              <tr>
                <td align="center"><strong>
                  <strong><?=mb_strtoupper($rSetImp["nome"])?></strong>
                </strong></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style=" border-top:solid 2px #000;   height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? } ?>

	<!-- FICHA PREENCHIDA -->
	<? if(isset($_GET["fp"])){?>
    <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tbody>
        <tr>
          <td align="center" height="1%">
            <table width="75%" border="0" align="center" cellpadding="0" cellspacing="5" style="padding-bottom: 10px;">
              <tr>
                <td align="center" valign="top" style="font-size:18px; border-bottom:solid 3px #000;"><br>FICHA DE ATENDIMENTO<br></td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" valign="top">
          <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5" style="border:solid 1px #000;">              
              <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>NOME:</b> <?=mb_strtoupper($rSetImp["nome"])?></td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>
              <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>TELEFONE:</b> <?=$rSetImp["telefone1"]." "?> <?=$rSetImp["telefone2"]." "?> <?=$rSetImp["telefone3"]." "?> <?=$rSetImp["telefone4"]?></td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>ENDEREÇO:</b> <?=$rSetImp["endereco"].", ".$rSetImp["numero"].", ".$rSetImp["bairro"]." ".$rSetImp["complemento"]?></td>
              </tr>     
              <tr>
                <td align="left" style="line-height:200%; border-bottom:solid 1px #000;"><?="CEP: ".$rSetImp["cep"]." | ".$rSetImp["cidade"]."-".$rSetImp["estado"]?></td>
              </tr>
			  <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>RG:</b> <?=$rSetImp["rg"]." "?></td>
              </tr>     
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>CPF:</b> <?=$rSetImp["cpf"]." "?></td>
              </tr>     
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>DATA DE NASCIMENTO:</b> <?=data("mascara", $rSetImp["nascimento"], "d/m/Y");?></td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>AÇÃO:</b> </td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>DOCUMENTOS RECEBIDOS:</b> </td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>DOCUMENTOS FALTANTES:</b> </td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr> 
			  <tr>
				<td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>RELATÓRIO:</b> </td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>
			  <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>     
              <tr>
                <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
              </tr>          
              <tr>
                <td align="center" style="line-height:200%;">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        
        <tr>
          <td align="center" height="1%">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style="height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                  </tr>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
	<? } ?>

	<!-- FICHA BRANCO -->
	    <?php if(isset($_GET["fb"])){?>
        <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
          <tbody>
            <tr>
              <td align="center" height="1%">
                <table width="75%" border="0" align="center" cellpadding="0" cellspacing="5" style="padding-bottom: 10px;">
                  <tr>
                    <td align="center" valign="top" style="font-size:18px; border-bottom:solid 3px #000;"><br>FICHA DE ATENDIMENTO<br></td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td align="center" valign="top">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5" style="border:solid 1px #000;">              
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>NOME:</b></td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>TELEFONE:</b></td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>ENDEREÇO:</b></td>
                  </tr>     
                  <tr>
                    <td align="left" style="line-height:200%; border-bottom:solid 1px #000;"></td>
                  </tr>
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>RG:</b></td>
                  </tr>     
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>CPF:</b></td>
                  </tr>     
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>DATA DE NASCIMENTO:</b></td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>AÇÃO:</b> </td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>DOCUMENTOS RECEBIDOS:</b> </td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>DOCUMENTOS FALTANTES:</b> </td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr> 
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; border-bottom:solid 2px #000;"><b>RELATÓRIO:</b> </td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>     
                  <tr>
                    <td align="center" style="line-height:200%; border-bottom:solid 1px #000;">&nbsp;</td>
                  </tr>          
                  <tr>
                    <td align="center" style="line-height:200%;">&nbsp;</td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td align="center" height="1%">
                  <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                      <tr>
                        <td align="center" style="height:30px;"><br><?=$GLOBALS["cms"]["rodape"][3]?></td>
                      </tr>
                  </table>
              </td>
            </tr>
          </tbody>
        </table>
        <?php } ?>

        <? if(isset($_GET["tr"])){?>
        <table width="100%" height="1030px" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
          <tbody>
            <tr>
              <td align="center">
                <table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center"><img src="<?=$GLOBALS["cms"]["base"]?>/dist/img/logo-imp2.png" border="0" style="height: 70px;"><br><br>
                    INSTITUTO NACIONAL DO SEGURO SOCIAL</td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td align="center" valign="top">
              <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td align="center" style="font-size:14px;"><b>TERMO DE REPRESENTAÇÃO E AUTORIZAÇÃO DE ACESSO A INFORMAÇÕES PREVIDENCIÁRIAS</b></td>
                  </tr>
                  <tr>
                        <td align="left" style="text-align:justify; line-height:200%;"><span>Eu, <b><?=mb_strtoupper($rSetImp["nome"])?></b>, <?=$rSetImp["sexo"] == "Feminino" ? "inscrita" : "inscrito"?> no CPF nº <?=$rSetImp["cpf"]?>, RG nº <?=$rSetImp["rg"]?>, residente e <?=$rSetImp["sexo"] == "Feminino" ? "domiciliada" : "domiciliado"?> em <?=$rSetImp["cidade"]?> - <?=$rSetImp["estado"]?>, na <?=$rSetImp["endereco"]?>, nº <?=$rSetImp["numero"]?>&nbsp; <?=$rSetImp["complemento"]?> <?=$rSetImp["bairro"]?>, CEP: <?=$rSetImp["cep"]?>. representado pelo advogado FERNANDO APARECIDO BALDAN, CPF nº 002.519.718-56, OAB nº 58.417, NIT nº________________, CONFIRO PODERES
ESPECÍFICOS para me representar perante o INSS na solicitação do serviço ou benefício abaixo indicado e AUTORIZO o (a) referido (a) profissional a ter acesso apenas às informações pessoais necessárias a subsidiar o requerimento eletrônico do serviço ou benefício abaixo elencado:</td>              
                  </tr>
                  <tr>
                    <td align="left">
                        <table width="85%" border="0" align="center" cellpadding="0" cellspacing="5" style="font-size: 12px;">
                          <tr>
                            <td>I</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Aposentadoria por Idade</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Urbana</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Rural</td>
                          </tr>
                          <tr>
                            <td>II</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Aposentadoria por Tempo de Contribuição</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td>&nbsp;</td>
                            <td></td>
                          </tr>  
                          <tr>
                            <td>III</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Aposentadoria Especial</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td>&nbsp;</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>IV</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Pensão por Morte Previdenciária</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Urbana</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Rural</td>
                          </tr>
                          <tr>
                            <td>V</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Auxílio-Reclusão</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Urbana</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Rural</td>
                          </tr>
                          <tr>
                            <td>VI</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Salário Maternidade</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Urbana</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Rural</td>
                          </tr>
                          <tr>
                            <td>VII</td>
                            <td style="border: 1px solid;" width="12">&nbsp;</td>
                            <td>Atualização cadastral</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td>&nbsp;</td>
                            <td></td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%;">Podendo, para tanto, praticar os atos necessários ao cumprimento deste mandato, em especial, prestar
informações, acompanhar requerimentos, cumprir exigências, ter vistas e tomar ciência de decisões sobre processos de requerimento de benefícios operacionalizados pelo Instituto.</td>
                  </tr>
                  <tr>
                    <td align="center"><?=$_GET["cidade-estado"]?> 
                        <?if(strlen($_GET["data"]) == 10){?>
                           <?=$newformat?>
                        <?}else{?>
                            
                        <?}?>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">__________________________________________</td>
                  </tr>
                  <tr>
                    <td align="center"><strong>
                        <strong>Assinatura do (a) Representado (a)</strong>
                    </strong></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" style="font-size:12px;"><b>TERMO DE RESPONSABILIDADE</b></td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%;">Por este Termo de Responsabilidade, comprometo-me a comunicar ao INSS qualquer evento que
possa anular esta Procuração, no prazo de trinta dias, a contar da data que o mesmo ocorra, principalmente o óbito do segurado / pensionista, mediante apresentação da respectiva certidão.
Estou ciente de que o descumprimento do compromisso ora assumido, além de obrigar a devolução de importâncias recebidas indevidamente, quando for o caso, sujeitar-me-á às penalidades previstas
nos arts. 171 e 299, ambos do Código Penal.</td>
                  </tr>
                  <tr>
                    <td align="center"><?=$_GET["cidade-estado"]?> 
                        <?if(strlen($_GET["data"]) == 10){?>
                           <?=$newformat?>
                        <?}else{?>
                            
                        <?}?>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">__________________________________________</td>
                  </tr>
                  <tr>
                    <td align="center"><strong>
                        <strong>Assinatura do procurador</strong>
                    </strong></td>
                  </tr>
                  <tr>
                    <td align="left" style="text-align:justify; line-height:200%; font-size: 10px;">
                        <b>CÓDIGO PENAL</b><br>
                        Art. 171. Obter, para si ou para outrem, vantagem ilícita, em prejuízo alheio, induzindo ou manter alguém em erro, mediante artifício, ardil ou qualquer outro meio fraudulento. <br>
                        Art. 299. Omitir, em documento público ou particular, declaração que devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da que devia ser escrita, com o fim de prejudicar direito, criar, obrigação ou alterar a verdade sobre fato juridicamente relevante.</td>
                  </tr>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
	    <? } ?>

</body>
</html>
<? 
if (!isset($_GET["cassociados"])){
	break;
}
} } }?>
