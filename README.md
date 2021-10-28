# API para referencia feita em CI4 e autenticação usando JWT.

# Framework CodeIgniter 4

## O que é CodeIgniter?

CodeIgniter é um framework web PHP full-stack que é leve, rápido, flexível e seguro.
Mais informações podem ser encontradas no [site oficial] (http://codeigniter.com).

Este repositório contém a versão distribuível da estrutura,
incluindo o guia do usuário. Foi construído a partir do
[repositório de desenvolvimento] (https://github.com/codeigniter4/CodeIgniter4).

Mais informações sobre os planos para a versão 4 podem ser encontradas em [o anúncio] (http://forum.codeigniter.com/thread-62615.html) nos fóruns.

O guia do usuário correspondente a esta versão da estrutura pode ser encontrado
[aqui] (https://codeigniter4.github.io/userguide/).


## Mudança importante com index.php

`index.php` não está mais na raiz do projeto! Ele foi movido para dentro da pasta * public *,
para melhor segurança e separação de componentes.

Isso significa que você deve configurar seu servidor web para "apontar" para a pasta * pública * do seu projeto, e
não para a raiz do projeto. Uma prática melhor seria configurar um host virtual para apontar para lá. Uma prática ruim seria apontar seu servidor web para a raiz do projeto e esperar inserir * public /...*, como o resto de sua lógica e o
quadro são expostos.

** Por favor ** leia o guia do usuário para uma melhor explicação de como funciona o CI4!

## Gerenciamento de repositório

Usamos problemas do Github, em nosso repositório principal, para rastrear ** BUGS ** e para rastrear pacotes de trabalho de ** DESENVOLVIMENTO ** aprovados.
Usamos nosso [fórum] (http://forum.codeigniter.com) para fornecer SUPORTE e para discutir
SOLICITAÇÕES DE RECURSOS.

Este repositório é uma "distribuição", construída por nosso script de preparação de lançamento.
Problemas com ele podem ser levantados em nosso fórum ou como problemas no repositório principal.

## Contribuindo

Aceitamos contribuições da comunidade.

Leia a seção [* Contribuindo para o CodeIgniter *] (https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) no repositório de desenvolvimento.

## Requisitos do servidor

É necessária a versão 7.3 ou superior do PHP, com as seguintes extensões instaladas:

- [intl] (http://php.net/manual/en/intl.requirements.php)
- [libcurl] (http://php.net/manual/en/curl.requirements.php) se você planeja usar a biblioteca HTTP \ CURLRequest

Além disso, certifique-se de que as seguintes extensões estejam ativadas em seu PHP:

- json (ativado por padrão - não desligue)
- [mbstring] (http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd] (http://php.net/manual/en/mysqlnd.install.php)
- xml (ativado por padrão - não desligue)