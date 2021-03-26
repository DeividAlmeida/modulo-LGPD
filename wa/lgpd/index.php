<?php
header('Access-Control-Allow-Origin: *');
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
    #INICIO
$modulo = 'lgbd';
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
        echo DBRead('lgbd','*',"WHERE id = '1'")[0]['modo'];
    ?>
    <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.2/js/fontawesome.min.js"></script>
    <style>
        html{
            overflow-x: hidden;
            font-family: Montserrat, Arial, Helvetica, 'Liberation Sans', FreeSans, sans-serif;
        }
        .cookie-alert {
            position: fixed;
            bottom: 15px;
            right: 15px;
            width: 320px;
            margin: 0 !important;
            z-index: 9999999999999999999999999999999999999;
            transition: all 500ms ease-out;
            transform: translateY(100%);
            border: 1px <?php echo $banco['cor_fundo']?> solid;
            opacity:0;
        }     
        .card-body{
            padding:20px;
            background:<?php echo $banco['cor_fundo']?> !important;
        }
        .card-text{
            margin:16px 0;
            font-size: larger;
            color:<?php echo $banco['cor_txt_principla']?> !important;
        }
        .justify-content-end {
            -ms-flex-pack: end!important;
            justify-content: flex-end!important;
        }
        .btn-link {
            -webkit-box-shadow: none;
            box-shadow: none;
            color: #263238;
            padding: 10px 15px;
        }
        .card-title {
            font-size: 18px;
            font-weight: 600;
            color:<?php echo $banco['cor_txt_titulo']?> !important;
        }
        .accept-cookies{
            padding:10px 25px !important;
            color:<?php echo $banco['cor_txt_btn']?> !important;
            background:<?php echo $banco['cor_btn']?> !important;
        }
        .ajuda{
            font-size:16px;
            color:<?php echo $banco['cor_txt_ajuda']?> !important;
            text-decoration: none;
        }
        .show{
            opacity:1;
            transform:translateY(0%);
        }
        .back{
            position:fixed;
            margin:0;
            width:100%;
            height:100%;
            top:0;
            left:0;
            background: rgba(0, 0, 0,0.5);
            z-index: 99999999999;
        }
        .lgbd_popup{
            position: fixed;
            width: 50%;
            height: auto;
            background: #fff;
            z-index: 9999999999;
            top:25%;
            left:25%;
            padding:15px;
        }
        .lgbf_fechar{
            font-size: 50px;
            margin: 0px 10px;
            position: absolute;
            right: 0px;
            cursor: pointer;
            top: -10px;
        }
        .lgbd_conteudo{
            margin:10px 1px;
            overflow-y:scroll;
            overflow-x:hidden;
            max-height:150px;
            padding-left:5%;
        }

        /*COMPLETO*/ 
        .gdpr-privacy-bar{
            position:fixed;
            bottom:0px;
            background:<?php echo $banco['cor_barra']?> !important;
            width:100%;
            height:auto;
            left:0px;
            padding: 15px;
            z-index: 999999999;
            display:none;
        }
        .gdpr-right{
            float:right;
        }
        .gdpr-content p{
            margin: 5px;
            color:<?php echo $banco['cor_txt_principla']?> !important;
        }
        .gdpr-preferences{
            background:transparent;
            border:0;
            color:<?php echo $banco['cor_txt_ajuda']?> !important;
        }
        .gdpr-agreement{
            color:<?php echo $banco['cor_txt_btn']?> !important;
            background:<?php echo $banco['cor_btn']?> !important;
            border:0;
        }
        .lgbd_anali{
            display: flex;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 98%;
        }
        .lgbd_titulo_anali{
            float:left;
            width:25%;
            white-space: normal;
        }
        .lgbd_descricao_anali{
            width:65%;
            margin:0 10px;
            font-size: 12px;
        }
        .lgbf_fechar div{
            margin:15px;
        }
        
        ::-webkit-scrollbar {
        width: 0px;
        }
        ::-webkit-scrollbar-thumb {
        background-color: rgb(0,0,0,0.2);
        border-radius: 10px;
        }




                /* This css is for normalizing styles. You can skip this. */

        .new {
        padding: 50px;
        }

        .form-group {
        display: block;
        margin-bottom: 15px;
        }

        .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
        }

        .form-group label {
        position: relative;
        cursor: pointer;
        }

        .form-group label:before {
        content:'';
        -webkit-appearance: none;
        background-color: transparent;
        border: 2px solid <?php echo $banco['cor_btn']?>;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 10px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
        }

        .form-group input:checked + label:after {
        content: '';
        display: block;
        position: absolute;
        top: 2px;
        left: 9px;
        width: 6px;
        height: 14px;
        border: solid <?php echo $banco['cor_btn']?>;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        }
        .controle{
            overflow-x:hidden;
            overflow-y:scroll;
            max-height:150px;
            margin-left: 5%;
        }
        #lgbd_btn{
            margin-left: 5%;
            margin-top: 5%;
        }
    </style>
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
        <div v-if="idx" class="lgbd_popup">            
            <div class="controle">
                <div class="lgbd_anali" v-for="row, id of db.analitycs">
                    <b class="lgbd_titulo_anali">{{row.titulo}}</b>
                    <div class="lgbd_descricao_anali">{{row.descricao}}</div>
                    <div class="form-group">
                        <input :value="row.titulo" type="checkbox" :id="'css'+id">
                        <label :for="'css'+id"></label>
                    </div>
                </div>
            </div>
            <div class="lgbd_conteudo" >
                <span v-html="db.mce_0" ></span>
            </div>
            <div>
                <button id="lgbd_btn" class="gdpr-agreement btn-accent btn-flat" type="button" @click="all(1)">Salvar Preferências</button>            
            </div>
        </div>
        <div class="gdpr gdpr-privacy-bar" >
        <!-- COMPLETO -->
            <div class="gdpr-wrapper">
                <div class="gdpr-content">
                    <p>{{db.principal}}</p>
                </div>
                <div class="gdpr-right">
                    <button class="gdpr-preferences" type="button" @click="open()">{{db.ajuda}}</button>
                    <button class="gdpr-agreement btn-accent btn-flat" type="button" @click="all(0)">{{db.botao}}</button>
                </div>
            </div>
        </div>
        <div :id="'analitycs'+id" v-for="div, id of db.analitycs">          
        </div>
    </div>
<script>    
    const vue = new Vue({
        el: '#main',
        data:{
            origin:'<?php echo ConfigPainel('base_url') ?>',
            idx:null,
            db: <?php echo $db ?>
        },
        methods:{
            open: function(){
                this.idx = 'on'
            }, 
            Close: function(){
                this.idx = null
            },
            all: function(a){
                if(a==0){                    
                    for(let i = 0; i< this.db.analitycs.length; ++i){
                        localStorage.setItem('WAC'+this.db.analitycs[i].titulo,true)
                        $('#analitycs'+i).load(vue.origin+'wa/lgbd/api/api.php?id=<?php echo $id; ?>&codigo='+i) 
                    }
                }else{
                    for(let i = 0; i< this.db.analitycs.length; ++i){
                        if(document.getElementById('css'+i).checked){                            
                            localStorage.setItem('WAC'+this.db.analitycs[i].titulo,true) 
                            $('#analitycs'+i).load(vue.origin+'wa/lgbd/api/api.php?id=<?php echo $id; ?>&codigo='+i)
                        }
                    }
                    this.idx = null
                }
                localStorage.setItem('WACcompleto',true) 
                document.getElementsByClassName('gdpr-privacy-bar')[0].style.display ='none'
            }
        }
    });
    window.onload = () =>{
        vue.db.analitycs = JSON.parse(vue.db.analitycs);
        if( vue.db.tipo == 0){
            document.getElementsByClassName('accept-cookies')[0].addEventListener('click',a=>{
                localStorage.setItem('WACreduzido',true)
                document.getElementsByClassName('cookie-alert')[0].setAttribute('class', 'card cookie-alert')
            })
            !localStorage.getItem('WACreduzido')? setTimeout(document.getElementsByClassName('cookie-alert')[0].setAttribute('class', 'card cookie-alert  show'), 1000):null;
        }else{
            !localStorage.getItem('WACcompleto')? document.getElementsByClassName('gdpr-privacy-bar')[0].style.display ='block':document.getElementsByClassName('gdpr-privacy-bar')[0].style.display ='none';
            for(let i = 0; i< vue.db.analitycs.length; ++i){
                if(localStorage.getItem('WAC'+vue.db.analitycs[i].titulo)){
                    $('#analitycs'+i).load(vue.origin+'wa/lgbd/api/api.php?id=<?php echo $id; ?>&codigo='+i)
                }                            
            }
        }
    }
</script> 
<?php require_once('../../wa/'.$modulo .'/src/script/wactrl.php') ?>    
<script src="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/src/script/main.js"></script>
</body>
</html>