<?php
	$TitlePage = 'LGBD';
	require_once('includes/funcoes.php');
	require_once('includes/header.php');
	require_once('includes/menu.php');
	require_once('database/upload.class.php');
	$modulo = DBRead('modulos','*',"WHERE nome = '{$TitlePage }'")[0];
	$UrlPage   = $modulo['url'];
	echo DBRead($modulo['tabela'],'*',"WHERE id = '1'")[0]['modo'];

?>
<div class="has-sidebar-left">
    <header class="blue accent-3 relative nav-sticky">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<div class="container-fluid text-white">
    		<div class="row p-t-b-10 ">
    			<div class="col">
    				<h4><i class="<?php echo $modulo['icone'] ?>"></i> <?php echo $TitlePage; ?></h4>
    			</div>
    		</div>
    	</div>
    </header>
    <body>
    	<div class="container-fluid animatedParent animateOnce my-3" >
            <div class="pb-3">
    			<span class="dropdown">
    			        <a class="btn btn-sm btn-primary dropdown-toggle" href="#" data-toggle="dropdown">Categorias</a>
    				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start">
    					<a class="dropdown-item " href="?">Categorias</a>
    						<a class="dropdown-item" href="?categoria=0">Cadastrar Categoria</a>
    				</div>
    			</span>			
    			<a class="btn btn-sm btn-primary" href="?Config">Configuração</a>
    		</div>
            <?php 
            if (isset($_GET['Config']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'configuracao', 'acessar')) :
                require_once($modulo['tabela'].'/configuracao/'.$UrlPage); 
            elseif (isset($_GET['filho']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) :
                require_once($modulo['tabela'].'/'.$_GET['pai'].'/'.$_GET['filho'].'/'.$UrlPage); 
            else:
                if(checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')){
            		require_once($modulo['tabela'].'/'.$modulo['tabela'].'/'.$UrlPage); 
                }
            endif;
            ?>
        </div>
    </body>
</div>
<?php  
require_once('includes/footer.php'); 
#VUE
if(isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if($modo == 'dev'){
        $vue= '<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>';
    }else{
        $vue= '<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>';
    }   
    $query  = DBUpdate($modulo['tabela'], array('modo' => $vue), "id = '1'");
}
#DELETAR
if(isset($_GET['Deletar'])){
    $id     = $_GET['Deletar'];
    $db     = $_GET['db'];
    $query  = DBDelete($db,"id = '{$id}'");
}
#REDIRECIONAR
if(isset($query)){
    if ($query != 0)  {
        Redireciona($UrlPage.'?sucesso'.$route);
    } else {
        Redireciona($UrlPage.'?erro'.$route);
    }
}

?>