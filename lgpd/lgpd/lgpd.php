<?php
$nome = 'categoria';
$filho = null;
$pai = 'lgpd';
$db = $modulo['tabela'].'_'.$nome;
$main = json_encode(DBRead($db,'*'));
if(isset($_GET[$nome])){
    $status = $_GET[$nome];
}else{
    $status = null;
}
if(isset($_GET['salvar'])):
    foreach($_POST as $name => $valor){
        $data[$name]=$valor;
    }
    $id = $_GET['salvar'];
    if($id == 0){
        $query = DBCreate($db, $data, true);  
    }else{
        $query =  DBUpdate($db, $data, "id = '{$id}'");
    };
endif;
?>
<script src='https://cdn.jsdelivr.net/npm/vue-mce@1.5.2/dist/vue-mce.web.js'></script>
<div class="card"  >    
    <div id="control" v-if="!status">
        <div class="card-header white" >
            <strong>Adicionar aviso</strong>
                <a class="adicionarListagemItem tooltips" data-tooltip="Adicionar" href="#" @click="move(0, -1)" >
                    <i class="icon-plus blue lighten-2 avatar"></i> 
                </a>
        </div>
        <div class="card-body p-0" v-if="ctrls != false && idx == null">
            <div>
                <div>
                    <table id="DataTable" class="table m-0 table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Implementação</th>
                            <th v-if="filho">Item</th>
                            <th width="53px">Ações</th>
                        </tr>
                        <tr v-for="ctrl, index in ctrls">
                            <td>{{index+1}}</td>
                            <td>{{ctrl.nome}}</td>
                            <td>
                                <button :id="'btnCopiarCodSite'+ctrls[index].id" class="btn btn-primary btn-xs m-1" :idi="ctrls[index].id" onclick="CopiadoCodSite(getAttribute('idi'))" :data-clipboard-text="'<script '+vue+'></script><div '+div+'></div><script>'+codigo[index]+'</script>'" type="button">
                                    <i class="icon icon-code"></i> Copiar Código 
                                </button>
                            </td>
                            <td v-if="filho">
                                <a class="tooltips" data-tooltip="Adicionar" :href="'?filho='+filho+'&pai=<?php echo $pai?>&id_pai='+ctrls[index].id+'&id_filho=0'">
                                    <i class="icon-plus blue lighten-2 avatar"></i>
                                </a>
                                    <a class="tooltips" data-tooltip="Visualizar" :href="'?filho='+filho+'&pai=<?php echo $pai?>&id_pai='+ctrls[index].id+'&id_filho'"><i class="icon-eye blue lighten-2 avatar"></i>
                                </a>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="" href="#" data-toggle="dropdown">
                                        <i class="icon-apps blue lighten-2 avatar"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) { ?>
                                            <a class="dropdown-item"  @click="move(ctrl.id, index)" href="#!"><i class="text-primary icon icon-pencil" ></i> Editar</a>
                                        <?php } ?>
                                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) { ?>
                                            <a class="dropdown-item" :data-id="ctrl.id"  onclick="DeletarItem(getAttribute('data-id'), 'db=<?php echo $db ?>&Deletar');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-body" v-if="ctrls == false && idx == null">
            <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
                <div class="alert alert-info">Nenhum registro adicionado a essa listagem até o momento, <a class="adicionarListagemItem" href="javascript:vue.status=0;vue.idx=0" >clique aqui</a> para adicionar.</div>
            <?php } ?>
        </div>
    </div>
    <div class="card-body" v-if="idx != null">
        <form method="post" :action="'?<?php echo $nome ?>&salvar='+status" enctype="multipart/form-data">            
            <div class="row" v-if="idx >= 0">
                <input type="hidden" name="analitycs" :value="JSON.stringify(ctrls[idx].analitycs)">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input class="form-control" :value="ctrls[idx].nome" name="nome" required>
                    </div>
                    <div v-if='ctrls[idx].tipo'>
                        <div class="form-group">
                            <label>Texto conteúdo ajuda: </label>
                            <vue-mce :config="config" :value="ctrls[idx].mce_0" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="hidden" name="tipo" value="1">
                    <div v-if='ctrls[idx].tipo'>
                        <div class="form-group" v-if='ctrls[idx].tipo == "0"'>
                            <label>Texto título: </label>
                            <input class="form-control" :value="ctrls[idx].titulo" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label>Texto principal: </label>
                            <input class="form-control" :value="ctrls[idx].principal" name="principal" required>
                        </div>
                        <div class="form-group">
                            <label>Texto botão: </label>
                            <input class="form-control" :value="ctrls[idx].botao" name="botao" required>
                        </div>
                        <div class="form-group">
                            <label>Texto ajuda: </label>
                            <input class="form-control" :value="ctrls[idx].ajuda" name="ajuda" required>
                        </div>
                        <div class="form-group" v-if="ctrls[idx].tipo == '1'">
                            <label>Cor da Barra:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input v-once :value="ctrls[idx].cor_barra" class="form-control" name="cor_barra" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor do Fundo {{ctrls[idx].tipo == '1'? 'do Popup': ''}}:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input v-once :value="ctrls[idx].cor_fundo" class="form-control" name="cor_fundo" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor texto {{ctrls[idx].tipo == '1'? 'do Popup': 'do título'}}:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input v-once :value="ctrls[idx].cor_txt_titulo" class="form-control" name="cor_txt_titulo" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor texto principal:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input v-once :value="ctrls[idx].cor_txt_principla" class="form-control" name="cor_txt_principla" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor texto botão:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input v-once :value="ctrls[idx].cor_txt_btn" class="form-control" name="cor_txt_btn" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cor botão:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input v-once :value="ctrls[idx].cor_btn" class="form-control" name="cor_btn" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cor texto ajuda:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input v-once :value="ctrls[idx].cor_txt_ajuda" class="form-control" name="cor_txt_ajuda" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="idx >=0">
                <div class="col-md-12" v-if="ctrls[idx].tipo == '1' && idx >=0"> 
                    <br><br>              
                    <div class="form-group">
                        <div class="col-md-12"><button type="button" @click="add" class="btn btn-primary btnAdd" style="margin-bottom: 15px;"><i class=" icon-plus"></i></button></div>
                    </div>
                </div> 
            </div>
            <div v-if="idx >= 0"  >
                <div class="row" v-if="ctrls[idx].tipo == '1'" v-for='field, index in ctrls[idx].analitycs'>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Título: </label>
                            <input class="form-control" v-model="field.titulo" :key="index+field">
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Descrição: </label>
                            <textarea class="form-control" v-model="field.descricao" :key="index+field"></textarea>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Código: </label>
                            <textarea class="form-control" v-model="field.codigo"   rows="5" :key="index+field"></textarea>
                        </div>
                    </div>
                
                    <div class="col align-self-center pull-right"  >
                        <button type="button" @click="remove(index)" class="btn btn-danger btnRemove"><i class="icon-trash"></i></button>
                    </div>            
                </div>
            </div>
            <div class="row" v-if="idx == -1">
                <input type="hidden" name="analitycs" :value="JSON.stringify(analitycs)">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input class="form-control"  name="nome" required>
                    </div>
                    <div v-if='tipo'>
                        <div class="form-group">
                            <label>Texto conteúdo ajuda: </label>
                            <vue-mce :config="config" name="mce_0"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="hidden" name="tipo" value="1">                    
                    <div v-if='tipo'>
                        <div class="form-group" v-if='tipo == "0"'>
                            <label>Texto título: </label>
                            <input class="form-control"  name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label>Texto principal: </label>
                            <input class="form-control"  name="principal" required>
                        </div>
                        <div class="form-group">
                            <label>Texto botão: </label>
                            <input class="form-control"  name="botao" required>
                        </div>
                        <div class="form-group">
                            <label>Texto ajuda: </label>
                            <input class="form-control"  name="ajuda" required>
                        </div>
                        <div class="form-group" v-if="tipo == '1'">
                            <label>Cor da Barra:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input  class="form-control" name="cor_barra" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor do Fundo {{tipo == '1'? 'do Popup': ''}}:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input  class="form-control" name="cor_fundo" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor texto {{tipo == '1'? 'do Popup': 'do título'}}:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input  class="form-control" name="cor_txt_titulo" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor texto principal:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input  class="form-control" name="cor_txt_principla" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cor texto botão:</label>
                            <div class="color-picker input-group colorpicker-element focused">
                              <input  class="form-control" name="cor_txt_btn" >
                                <span class="input-group-append">
                                    <span class="input-group-text add-on white">
                                        <i class="circle"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cor botão:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input  class="form-control" name="cor_btn" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cor texto ajuda:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input  class="form-control" name="cor_txt_ajuda" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" v-if="idx == -1">               
                    <br><br>
                    <div class="form-group">
                        <div class="col-md-12"><button type="button" @click="add" class="btn btn-primary btnAdd" style="margin-bottom: 15px;"><i class=" icon-plus"></i></button></div>
                    </div>
                </div> 
            </div>     
            <div v-if="idx == -1" v-for='field, index in analitycs' >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Título: </label>
                            <input class="form-control" v-model="field.titulo" :key="index+field">
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Descrição: </label>
                            <textarea class="form-control" v-model="field.descricao" :key="index+field"></textarea>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Código: </label>
                            <textarea class="form-control" v-model="field.codigo" rows="5" :key="index+field"></textarea>
                        </div>
                    </div>
                
                    <div class="col align-self-center pull-right"  >
                        <button type="button" @click="remove(index)" class="btn btn-danger btnRemove"><i class="icon-trash"></i></button>
                    </div>            
                </div>
            </div>
            <div class="card-footer white">
                <button style="margin-bottom: 7px;" class="btn btn-primary float-right" type="submit"><i class="icon icon-save" aria-hidden="true"></i> Salvar</button>
            </div>
        </form>
    </div>
</div>
<script>
    const config = {
        height: 561,
        inline: false,
        theme: 'modern',
        language:'pt_BR',
        fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 34px 38px 42px 48px 54px 60px",
        plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help emoticons',
        toolbar1: 'formatselect fontsizeselect | bold italic strikethrough forecolor backcolor link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | emoticons | image | video | preview | toc | charmap | codesample | pagebreak | media | searchreplace | directionality | fullscreen | imagetools ',
        image_advtab: true,
        templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }],
    };
    const vue = new Vue({
        el:".card",
        data: {
            config,
            tipo:1,
            idx:null,
            status:'<?php echo $status ?>',
            ctrls:<?php echo $main ?>,
            filho:'<?php echo $filho ?>',
            vue:'src="https://cdn.jsdelivr.net/npm/vue@2"',
            div:'id="lgpd"',
            codigo:[],
            analitycs:[{'titulo':'','descricao':'', 'codigo':''}]       
        },
        updated: function(){
            this.$nextTick(function(){
                $('.color-picker').colorpicker();                               
            })
        },
        methods:{
            move: function(a, b){
                this.status = a;
                this.idx = b;           
            },
            add: function(){
                this.status == 0? this.analitycs.push({'titulo':'','descricao':'', 'codigo':''}):this.ctrls[this.idx].analitycs.push({'titulo':'','descricao':'', 'codigo':''})
            }, 
            remove: function(index){
                this.status == 0? this.analitycs.splice(index, 1): this.ctrls[this.idx].analitycs.splice(index, 1)
            }
        }
    })
    window.onload = () =>{
        for(let i = 0; i<vue.ctrls.length; i++){
            vue.ctrls[i].analitycs = JSON.parse(vue.ctrls[i].analitycs)
            vue.codigo.push("$('#lgpd').load('<?php echo ConfigPainel('base_url')?>wa/lgpd/?id="+vue.ctrls[i].id+"')")
        }
    } 
</script>