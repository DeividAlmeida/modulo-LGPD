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
        .lgpd_popup{
            position: fixed;
            width: 50%;
            height: auto;
            background: #fff;
            z-index: 9999999999;
            top:12%;
            left:25%;
            padding:30px;
        }
        .lgbf_fechar{
            font-size: 50px;
            margin: 0px 10px;
            position: absolute;
            right: 0px;
            cursor: pointer;
            top: -10px;
        }
        .lgpd_conteudo{
            margin:10px 1px;
            overflow-y:scroll;
            overflow-x:hidden;
            max-height:150px;
        }
        
        
        

        /*COMPLETO*/ 
        .gdpr-privacy-bar{
            position:fixed;
            bottom:0px;
            background:<?php echo $banco['cor_barra']?> !important;
            width:100%;
            height:auto;
            left:0px;
            padding: 5px;
            z-index: 999999999;
            display:none;
        }
        .gdpr-right{
            float:right;
            margin-left:50px;
        }
        .gdpr-content {
            
        }
        .gdpr-content p{
            padding-top: 12px;
            margin: 5px;
            color:<?php echo $banco['cor_txt_principla']?> !important;
        }
        .gdpr-preferences{
            background:transparent;
            border:0;
            color:<?php echo $banco['cor_txt_ajuda']?> !important;
            text-align: inherit;
        }
        .gdpr-agreement{
            color:<?php echo $banco['cor_txt_btn']?> !important;
            background:<?php echo $banco['cor_btn']?> !important;
            border:0;
            padding:12px;
            margin:4px;
        }
        
        
        
        
        
        .lgpd_anali{
            display: flex;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .lgpd_titulo_anali{
            float:left;
            width:25%;
            white-space: nowrap;
           
        }
        .lgpd_descricao_anali{
            width:100%;
            margin:0 15px;
            font-size: 12px;
        }
        .lgbf_fechar div{
            margin:15px;
        }
        
        .lgpd_conteudo::-webkit-scrollbar {
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

        .form-group_lgpd {
        display: block;
        margin-bottom: 15px;
        }

        .form-group_lgpd input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
        }

        .form-group_lgpd label {
        position: relative;
        cursor: pointer;
        }

        .form-group_lgpd label:before {
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

        .form-group_lgpd input:checked + label:after {
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
            max-height:250px;
        }
        #lgpd_btn{
            margin-top: 15px;
        }
        .gdpr-wrapper{
            display: flex;
            justify-content: space-between;
            margin: 0 25px;
        }
        .mob{
            display: flex;
            width: 100%;
            justify-content: space-between;
        }
         @media only screen and (max-width: 1024px){
            .lgpd_anali{
                display:grid;
            }
            .lgpd_titulo_anali{
                    position: relative;
                    width: 100%;
                    text-align: center;
                
            }
            .gdpr-wrapper {
                display: grid;
                justify-content: center;
                margin: 0 25px;
            }
            .gdpr-right {

            display: grid;
            justify-content: center;

            }
            .gdpr-preferences {
                margin: 10px 0;
            }
            .gdpr-right {
            margin-left: 0px; 
    
            }
            .gdpr-content p {
            text-align: center;
        }
        .lgpd_popup {
            position: fixed;
            width: 75%;
            height: auto;
            background: #fff;
            z-index: 9999999999;
            top: 7%;
            left: 11%;
            padding: 30px;
        }
    }
    </style>