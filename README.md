DOCUMENTAÇÃO INICIAL DO WEBLOJA V.1.0

 ** TESTE DE CONFLITO
 •Esta sasdasdasdas
 
asd as d as da sdf sd fo webloja atual, com adaptações para integrar-se com o symfony. ds f sd fsd f sdf sd fsd f - DABundle: Programas usados pelo departamento DA.
 •DCM: Programas usados pelo departamento DCM.
 •DCP: Programas usados pelo departamento DCP.
 •DFI: Programas usados pelo departamento DFI.
 •DOL: Programas usados pelo departamento DOL.
 •GRL: Programas usados pelo departamento GRL.
 •LIB: Programas usados por todos os Bundles, bibliotecas e ultilitarios.
 •Merchan: Programas usados pelo departamento Merchan.
 •MKT: Programas usados pelo departamento de Marketing.
 •SENG: Programas usados pelo departamento SENG.
 •Webloja: Controllers,Views,Formularios,Repository que serão usados por todos os Bundles.
 
** LIB
 •
DBALConnection.php: Biblioteda de conexão com banco de dados, para uso no sistema, nos casos em que não é possível usar a conexão nativa do sistema.(esta biblioteca tambem usa a conexão doctrine).

 •
Arquivo producao.ini: contem a configuração de conexão com o SAP (como é feito no sistema atual).

 •
TRfc.php: biblioteca adaptada ao uso do symfony 2, com a adaptação não se é mais necessário criar arquivos rfc para o sistema, a biblioteca é usada diretamente dentro da action do controller.

 
** CÓDIGO OBRIGATÓRIO NAS ACTION QUE ACESSAM TEMPLATES
      /**
     * codigo referente ao controle de sessão da pagina
     * este código deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulários
     */sdfsdfsdf
    $session = $thissdfsdfsd->getRequest()->getSession();
    if(!$session->get('id_user')){

         $this->get('sfsdfession')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
         return $this->fsdfsdf
    /*******************************************************/

    /**
     * Condigo referente a montagem do título da pagina
     * precisa ser colocado em toda página que gera formulário
     * ou que tenha saída para template
     */
    if($id_interno!=null){
         MenuRepository::getIdInterno($id_interno,$session);
    }
 •Biblioteca ExcelWriter.php
 
sdf sd f sdf sd fsd fsd f - createArquivo(): Monta o arquivo .xls.
        - gerarExcel(): executa o metodo privado createArquivo(), para gerar o arquivo .xls.

 ** ALERTAS JQUERY

 código js

$(docume sdf

sdf sd fsd f sdf sd fsd click: function() { $(this).dialog sd f sdf sd fsd("close"); sd fs dfsdf } } ] });
$("#componente").click(function(event) {
   event.preventDefausdfsdfsdlt();
   ....
        $("#dialog").dialog("open").html('<br /> Texto que vai aparecer no alert!');        
});

 });


 código na pagina html



** FORMATAÇÃO DOS CAMPOS DATA COM ALENDÁRIO
 •
adcionar o codigo na área de java scrfpt da pagina sdfsdfsdfsd src="{{ asset('bundles/wfsdfebloja/fsdfsdfjs/bootstrap-datetimepicker.min.js') }}">

 •
configuração na página js sdfsdfsdf

 •
para outras configurações acessar o site: 

http://tarruda.github.io/bootstrap-datetimepicker/

OBS: o plugin já foi modificado para mostrar dados em portugues Brasil.

