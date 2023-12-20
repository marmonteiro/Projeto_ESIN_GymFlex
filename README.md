ESIN
Gymflex Website - Grupo G

- Marta Monteiro (up202307915@fe.up.pt)
- Patrícia Gomes (up202308700@fe.up.pt)
- Rita Marques (up202004717@fe.up.pt)

- O site que nós desenvolvemos é um site de um ginásio, GymFlex, cujo nome e logotipo são da nossa autoria. 

- A cadeia de ginásios GymFlex oferece uma variedade de serviços através do seu site. Todos os visitantes têm acesso a informações detalhadas sobre os clubes disponíveis, planos de adesão e aulas de grupo oferecidas no ginásio, para além de uma seção de ajuda abrangente. Para os membros registados, o site oferece uma área de cliente onde é possível gerenciar dados pessoais (alterar dados, foto de perfil e password), detalhes do plano de adesão (verificar dados do plano, alterar o tipo do plano caso tenham passado pelo menos 2 meses da última adesão e cancelar subscrição), além de possibilitar a verificação do histórico de treinos e aulas de grupo. Adicionalmente, os membros podem-se inscrever em novas aulas de grupo para expandir suas experiências de treino.

- É possível aceder ao conteúdo do nosso projeto através do repositório do GitHub: 
    https://github.com/marmonteiro/Projeto_ESIN_GymFlex;

 De seguida, corre-se o seguinte comando no terminal do VisualStudioCode:
    -> linux/mac: 
     sudo docker run -d -p 8080:8080 -it --name=nome_container -v ~/caminho_pasta_projeto/Projeto_ESIN_GymFlex:/var/www/html quay.io/vesica/php73:dev;
    
    -> windows: 
     docker run -d -p 8080:8080 -it --name=nome_container -v C:\caminho_pasta_projeto\Projeto_ESIN_GymFlex:/var/www/html quay.io/vesica/php73:dev;

 O caminho_pasta_projeto deverá ser substituido de acordo com a localização do ficheiro.

 Para abrir a página inicial utilizamos o link abaixo no browser: 
   http://localhost:8080/paginicial.php 


- Organização de ficheiros: 
  -> Pasta css: inclui um ficheiro css, onde se definiu o design do site;
  -> Pasta database: inclui as funções php utilizadas para aceder à base de dados;
  -> Pasta imagens: inclui todas imagens/icons utilizadas no site, suborganizadas por pastas, de acordo com a sua "categoria";
  -> Pasta sql: inclui a base de dados criada para suporte do site;
  -> Pasta templates: inclui diferentes templates utilizados (html e php).

- Como explorar o site:
Para explorar todas as funcionalidades do nosso site como membro do gymflex recomendamos o login com as seguintes informações:
  -> mail: joao@gmail.com;
  -> password: password1;

É também possível registar um novo membro e aceder às diferentes funcionalidades mencionadas anteriormente. Adicionalmente na base de dados existem mais 6 membros, com os quais é possível fazer o login. 

- Notas:
  -> Caso o membro tenha efetuado o login os botões das páginas de aulas de grupo e planos altera;
  -> Sempre que se clica no logotipo presente no header somos encaminhados para a página principal do site.


- Na elaboração do site foi utilizado sqlite, css, html e php.


