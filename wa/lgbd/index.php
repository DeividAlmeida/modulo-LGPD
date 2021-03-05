<?php
header('Access-Control-Allow-Origin: *');
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
    #INICIO
$modulo = 'cardapio';
$atual = $modulo.'_';
$id = $_GET['id'];
    #FIM
$conf = $modulo.'_config';
$config =  json_encode(DBRead($conf,'*')[0]);
$db =  json_encode(DBRead($atual,'*' ,"WHERE id = '{$id}'"));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/src/style/main.css">
    <?php require_once('src/style/wacrl.php') ?>
    <?php  echo DBRead($modulo,'*',"WHERE id = '1'")[0]['modo']; ?>
    <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.2/js/fontawesome.min.js"></script>
</head>
<body>
    <div id="main">

    </div>
<script>
    const vue = new Vue({
        el: '#main',
        data:{
            origin:'<?php echo ConfigPainel('base_url') ?>',
            idx:null,
            config:<?php echo $config ?>,
            db: <?php echo $db ?>
        },
        methods:{

        }
    })
</script> 
<?php require_once('src/script/wacrl.php') ?>    
<script src="src/script/main.js"></script>
</body>
</html>