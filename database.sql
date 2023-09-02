SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET @@time_zone = `+03:00`;

INSERT INTO `modulos` (`nome`, `url`, `icone`, `status`, `ordem`, `tabela`, `cod_head`, `data_atualizacao`, `chave`, `acao`)
SELECT "LGPD", "lgpd.php", "icon-gavel", 1, 0, "lgpd", "lgpd/lgpd.js", "2019-05-07", "72b4b1d7ce2b514a981a49b1db5790a7", "{\"item\":[\"adicionar\",\"editar\",\"deletar\"],\"categoria\":[\"adicionar\",\"editar\",\"deletar\"],\"codigo\":[\"acessar\"],\"configuracao\":[\"acessar\"]}";

-- VUE
CREATE TABLE IF NOT EXISTS `lgpd` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `modo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `lgpd` (`id`, `modo`) VALUES (
    1, 
    '<script src=\"https://cdn.jsdelivr.net/npm/vue@2\"></script>'
    );
CREATE TABLE IF NOT EXISTS `lgpd_categoria` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` varchar(255) DEFAULT NULL,
    `tipo` varchar(255) DEFAULT NULL,
    `titulo` text DEFAULT NULL,
    `principal` text DEFAULT NULL,
    `botao` varchar(255) DEFAULT NULL,
    `ajuda` text DEFAULT NULL,
    `cor_txt_ajuda` varchar(255) DEFAULT NULL,
    `cor_btn` varchar(255) DEFAULT NULL,
    `cor_barra` varchar(255) DEFAULT NULL,
    `cor_txt_btn` varchar(255) DEFAULT NULL,
    `cor_fundo` varchar(255) DEFAULT NULL,
    `cor_txt_titulo` varchar(255) DEFAULT NULL,
    `cor_txt_principla` varchar(255) DEFAULT NULL,
    `analitycs` text DEFAULT NULL,
    `mce_0` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
