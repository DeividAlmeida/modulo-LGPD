<?php
header('Access-Control-Allow-Origin: *');
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
    #INICIO
$modulo = 'lgpd';
$atual = $modulo.'_categoria';
$id = $_GET['id'];
    #FIM
$conf = $modulo.'_config';
#$config =  json_encode(DBRead($conf,'*')[0]);
$banco = DBRead($atual,'*' ,"WHERE id = '{$id}'")[0];
$db =  json_encode($banco);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/src/style/main.css">
    <?php require_once('../../wa/'.$modulo .'/src/style/wactrl.php'); 
        echo DBRead('lgpd','*',"WHERE id = '1'")[0]['modo'];
    ?>
    <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.2/js/fontawesome.min.js"></script>
    
</head>
<body>
    <div id="main">
        <div v-if="db.tipo == 0" class="card cookie-alert ">
        <!-- REDUZIDO -->
            <div class="card-body">
                <h5 class="card-title">🍪 {{db.titulo}}</h5>
                <p class="card-text">{{db.principal}}</p>
                <div class="btn-toolbar justify-content-end">
                    <a @click="open()" class="btn btn-link ajuda">{{db.ajuda}}</a>
                    <a href="#" class="btn btn-primary accept-cookies">{{db.botao}}</a>
                </div>
            </div>
        </div>
        <div v-if="idx" class="back" @click="Close()"></div>
        <div v-if="idx" class="lgpd_popup">            
            <div class="controle">
                <div class="lgpd_anali" v-for="row, id of db.analitycs">
                    <b class="lgpd_titulo_anali form-group_lgpd">{{row.titulo}}</b>
                    <div class="form-group_lgpd mob">
                        <div class="lgpd_descricao_anali">{{row.descricao}}</div>
                        <input :value="row.titulo" checked type="checkbox" :id="'css'+id">
                        <label :for="'css'+id"></label>
                    </div>
                </div>
            </div>
            <div class="lgpd_conteudo" >
                <span v-html="db.mce_0" ></span>
            </div>
            <div>
                <button id="lgpd_btn" class="gdpr-agreement btn-accent btn-flat" type="button" @click="all(1)">Salvar Preferências</button>            
            </div>
        </div>
        <div class="gdpr gdpr-privacy-bar" >
        <!-- COMPLETO -->
            <div class="gdpr-wrapper">
                <div class="gdpr-content">
                    <p>{{db.principal}}</p>
                </div>
                <div class="gdpr-right">
                    <button class="gdpr-preferences" type="button" @click="open()"><b>{{db.ajuda}}</b></button>
                    <button class="gdpr-agreement btn-accent btn-flat" type="button" @click="all(0)">{{db.botao}}</button>
                </div>
            </div>
        </div>
        <div :id="'analitycs'+id" v-for="div, id of db.analitycs">          
        </div>
    </div>

<?php require_once('../../wa/'.$modulo .'/src/script/wactrl.php') ?>    
<script src="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/src/script/main.js"></script>
</body>
</html>