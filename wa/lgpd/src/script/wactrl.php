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
                        $('#analitycs'+i).load(vue.origin+'wa/lgpd/api/api.php?id=<?php echo $id; ?>&codigo='+i) 
                    }
                }else{
                    for(let i = 0; i< this.db.analitycs.length; ++i){
                        if(document.getElementById('css'+i).checked){                            
                            localStorage.setItem('WAC'+this.db.analitycs[i].titulo,true) 
                            $('#analitycs'+i).load(vue.origin+'wa/lgpd/api/api.php?id=<?php echo $id; ?>&codigo='+i)
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
                if(!localStorage.getItem('WACcompleto')){ 
                    document.getElementsByClassName('gdpr-privacy-bar')[0].style.display ='block'
                    for(let i = 0; i< vue.db.analitycs.length; ++i){
                        localStorage.removeItem('WAC'+vue.db.analitycs[i].titulo)
                }
            }else{
                document.getElementsByClassName('gdpr-privacy-bar')[0].style.display ='none'
            }
            for(let i = 0; i< vue.db.analitycs.length; ++i){
                if(localStorage.getItem('WAC'+vue.db.analitycs[i].titulo)){
                    $('#analitycs'+i).load(vue.origin+'wa/lgpd/api/api.php?id=<?php echo $id; ?>&codigo='+i)
                }                            
            }
        }
    }
</script> 