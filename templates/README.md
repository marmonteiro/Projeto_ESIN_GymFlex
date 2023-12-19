ESIN
Gymflex Website - Grupo G

- Marta Monteiro (up202307915@fe.up.pt)
- Patrícia Gomes (up202308700@fe.up.pt)
- Rita Marques (up202004717@fe.up.pt)

É possível aceder ao conteúdo do nosso projeto através do repositório do GitHub: 
- https://github.com/marmonteiro/ESIN;

De seguida, corre-se o seguinte comando no terminal do VisualStudioCode:

- linux/mac: sudo docker run -d -p 8080:8080 -it --name=nome_container -v ~/caminho_pasta_projeto/ESIN:/var/www/html quay.io/vesica/php73:dev;

- windows: docker run -d -p 8080:8080 -it --name=nome_container -v C:\caminho_pasta_projeto/ESIN:/var/www/html quay.io/vesica/php73:dev;

O caminho_pasta_projeto deverá ser substituido de acordo com a localização do ficheiro.


Para explorar todas as funcionalidades do nosso site como membro do gymflex recomendamos o login com as seguintes informações:
- mail: joao@gmail.com;
- password: password1;

Adicionalmente, é possível registar um novo membro e aceder as diferentes funcionalidades mencionadas a seguir.

- O site que nós desenvolvemos é um site de um ginásio, GymFlex, cujo nome e logotipo são da nossa autoria. 

- A GymFlex é uma cadeia de ginásios que oferece treino acompanhado, autónomo, aulas de grupo e aconselhamento nutricional. Os membros podem efetuar o login no site e aceder à sua àrea de cliente onde podem gerir as suas aulas de grupo e verificar o registo dos treinos tendo em conta as retrições de acordo com o seu plano. Para além disso, podem alterar os seus dados pessoais.

Notas:
- Caso o membro tenha efetuado o login os botões das páginas de aulas de grupo e planos altera;
- Para verificar o registo de aulas de grupo e treinos é necessário escolher o ano e de seguida carregar em filtrar, de modo a aparecer a informação desejada.


Na elaboração do site foi utilizado sqlite, css, html e php.


