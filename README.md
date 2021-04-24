## Descrição do Projeto
<p align="center">Esse projeto foi feito com intuito de demonstrar meus conhecimento em algumas tecnologias.</p>

Tabela de conteúdos
=================
<!--ts-->
   * [AUTENTICAÇÃO EM API REST UTILIZANDO JWT](#auth-jwt)
   * [ACL](#acl)
<!--te-->

Auth JWT
========
Neste exemplo eu utilizo como autenticação para a API REST o JWT.
Utilizei um pacote tymon/jwt-auth DOC na https://jwt-auth.readthedocs.io/en/develop/, e segui a explicação encontrada do canal LARAVEL TIPS Por Robson V. Leite.
Também fiz a implementação dos tests para os end point de login, me, logout

ACL
====
O controle de permissões eu fiz manualmente. A ideia veio de uma experiencia que tive com um sistema ERP focado no agronegócio desenvolvido em DELPHI, para desktop.
A ideia consiste em controlar as permissões de um usuário Individualmente ou em grupo.
No cadastro o usuário você pode setar o campo "control_permissions_by" com os valore "I" para individual ou "G" para grupo.
Se for Individual você passa uma array "permissions" no cadastro ou atualização do usuário com os id das permissões que serão associado ao usuário.
Se form em grupo as permissões são associada pelo cadastro ou atualização do grupo. Da mesma forma deve passar um array "permissions" para fazer a associação ao grupo e no cadastro ou atualização do usuário setar o role_id.
O Grupo de usuário também possue um campo status, que se setado com false todos as permissões desse grupo passam ser negadas ao usuários.
