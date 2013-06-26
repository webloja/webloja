DOCUMENTAÇÃO INICIAL DO WEBLOJA V.1.0
===============================

** PADRÕES DO SISTEMA
----------------------
	- Formatação dos butões do sistema:
	- class='btn btn-danger btn-mini', estão sendo usados também nos botões os icones do bootstrab.

** LOGIN DO SISTEMA
-------------------
  - Esta sendo o feito o mesmo que o webloja atual, com adaptações para integrar-se com o symfony.

** ORGANIZAÇÃO DO SISTEMA
--------------------------
 - O sistema esta organizado em Bundles, onde cada Departamento que intitula um menu principal forma um Bundle, possuindo também um Bundle geral onde são colocados os programas e códigos que são usados por todos os outros Bundles.

** BUNDLES
----------
  - AdminBundle: Aqui são colocados os programas ´referentes a parte administrativa do sistema webloja.
  - ChamadosBundle: Programas do modulo de apertura de chamados.
  - DABundle: Programas usados pelo departamento DA.
  - DCM: Programas usados pelo departamento DCM.
  - DCP: Programas usados pelo departamento DCP.
  - DFI: Programas usados pelo departamento DFI.
  - DOL: Programas usados pelo departamento DOL.
  - GRL: Programas usados pelo departamento GRL.
  - LIB: Programas usados por todos os Bundles, bibliotecas e ultilitarios.
  - Merchan: Programas usados pelo departamento Merchan.
  - MKT: Programas usados pelo departamento de Marketing.
  - SENG: Programas usados pelo departamento SENG.
  - Webloja: Controllers,Views,Formularios,Repository que serão usados por todos os Bundles.

** LIB
------
  - DBALConnection.php: Biblioteda de conexão com banco de dados, para uso no sistema, nos casos em que não é possível usar a conexão nativa do sistema.(esta biblioteca tambem usa a conexão doctrine).

  - Arquivo producao.ini: contem a configuração de conexão com o SAP (como é feito no sistema atual).

  - TRfc.php: biblioteca adaptada ao uso do symfony 2, com a adaptação não se é mais necessário criar arquivos rfc para o sistema, a biblioteca é usada diretamente dentro da action do controller.

** CÓDIGO OBRIGATÓRIO NAS ACTION QUE ACESSAM TEMPLATES

          /**
         * codigo referente ao controle de sessão da pagina
         * este código deve ser colocado em todos os controllers
         * nos metodos que reenderizam formulários
         */
        $session = $this->getRequest()->getSession();
        if(!$session->get('id_user')){
            
             $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
             return $this->redirect($this->generateUrl('logout'));
        }
        /*******************************************************/
        
        /**
         * Condigo referente a montagem do título da pagina
         * precisa ser colocado em toda página que gera formulário
         * ou que tenha saída para template
         */
        if($id_interno!=null){
             MenuRepository::getIdInterno($id_interno,$session);
        }
   - Biblioteca ExcelWriter.php
        - Foi nescessário criar uma nova biblioteca para gerar arquivos .xls(Excel).

            É uma classe simples , que faz a leitura de uma tabela html,
            a classe é composta pelos metodos:

            - setNameArquivo($arquivo): Recebe como parametro no nome do arquivo.

            - createTituloCol($valor): Cria a linha contendo os lables de cada coluna, recebe como parametro
              o nome dessa coluna.

            - createCol($linha, $valor): Cria as linhas e colunas referentes ao conteudo da planilha.

            - createArquivo(): Monta o arquivo .xls.

            - gerarExcel(): executa o metodo privado createArquivo(), para gerar o arquivo .xls.
            

** ALERTAS JQUERY
==========
código js
==========
$(document).ready(function() {

    $("#dialog").dialog({
        autoOpen: false,
        width: 400,
        buttons: [
            {
                text: "Ok",
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    });

    $("#componente").click(function(event) {
       event.preventDefault();
       ....
            $("#dialog").dialog("open").html('<br /> Texto que vai aparecer no alert!');        
    });

});

=====================
código na pagina html
=====================
 <div id="dialog" title="Erro"></div>

** FORMATAÇÃO DOS CAMPOS DATA COM ALENDÁRIO

 - adcionar o codigo na área de java script da pagina

<script type="text/javascript" src="{{ asset('bundles/webloja/js/bootstrap-datetimepicker.min.js') }}"></script>

 - configuração na página js

 $('#data_dia').datetimepicker({
        pickTime: false,
        maskInput: true
});

 - para outras configurações acessar o site: 
 
 http://tarruda.github.io/bootstrap-datetimepicker/
 
 OBS: o plugin já foi modificado para mostrar dados em portugues Brasil.