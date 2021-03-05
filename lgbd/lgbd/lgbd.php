<?php
$nome = 'categoria';
$filho = 'item';
$pai = 'lgbd';
$db = $modulo['tabela'].'_'.$nome;
$main = json_encode(DBRead($db,'*'));
$status = $_GET[$nome];
if(isset($_GET['salvar'])):
    foreach($_POST as $nome => $valor){
        $data[$nome]=$valor;
    }
    $id = $_GET['salvar'];
    if($id == 0){
        $query = DBCreate($db, $data, true);  
    }else{
        $query =  DBUpdate($db, $data, "id = '{$id}'");
    };
endif;
?>
<div class="card"  >
    <div id="control" v-if="!status">
        <div class="card-header white" >
            <strong>Adicionar <?php echo $nome ?></strong>
                <a class="adicionarListagemItem tooltips" data-tooltip="Adicionar" @click="move('0')" >
                    <i class="icon-plus blue lighten-2 avatar"></i> 
                </a>
        </div>
        <div class="card-body p-0" v-if="ctrls != false">
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
                                <button :id="'btnCopiarCodSite'+ctrls[index].id" class="btn btn-primary btn-xs m-1" :idi="ctrls[index].id" onclick="CopiadoCodSite(getAttribute('idi'))"  :data-clipboard-text="codigo[index]" type="button">
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
        <div class="card-body" v-else>
            <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
                <div class="alert alert-info">Nenhum registro adicionado a essa listagem até o momento, <a class="adicionarListagemItem" href="?<?php echo $nome ?>=0" >clique aqui</a> para adicionar.</div>
            <?php } ?>
        </div>
    </div>
    <div class="card-body" v-else>
        <form method="post" :action="'?<?php echo $nome ?>&salvar='+status" enctype="multipart/form-data">
            <div class="row" v-if="status !=0">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input class="form-control" v-model="ctrls[idx].nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição: </label>
                        <textarea class="form-control" v-model="ctrls[idx].descricao" name="descricao" required>{{ctrls[idx].descricao}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row" v-if="status == 0">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input class="form-control"  name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição: </label>
                        <textarea class="form-control"  name="descricao" required></textarea>
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
    const vue = new Vue({
        el:".card",
        data: {
            idx:'',
            status:'<?php echo $status ?>',
            ctrls:<?php echo $main ?>,
            filho:'<?php echo $filho ?>',
            codigo:[]            
        },
        methods:{
            move: function(a, b){
                this.status = a;
                this.idx = b;
            }
        }
    })
    for(let i = 0; i<vue.ctrls.length; i++){
        vue.codigo.push("<iframe onload='frame(this)'  src='<?php echo ConfigPainel('base_url') ?>wa/cardapio/?id="+vue.ctrls[i].id+"' ></iframe>")
    }
</script>