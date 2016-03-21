# Sobre o Plugin

Nós somos a <a href="http://www.bibliomundi.com.br" target="blank">Bibliomundi</a>, uma distribuidora de livros digitais e disponibilizamos este Plugin, para o Prestashop, com o objetivo de integrar os ebooks cadastrados em nossa plataforma com a sua loja. Para que você possa vender nossos ebooks em sua loja é muito simples e não necessita conhecimentos em programação.

#Versão

1.0

#Requerimentos

<a href="https://www.prestashop.com" target="blank">Prestashop</a> na versão 1.6 ou maior.

<a href="http://php.net" target="blank">PHP</a> na versão 5.4 ou maior.

Extensão <a href="http://php.net/manual/pt_BR/book.mcrypt.php" target="blank">mcrypt</a> do PHP

#Instalação

Baixe o arquivo e renomei a pasta dentro do zip para "bibliomundi"(NECESSÁRIO) e na aba de criação de módulos do Prestahop faça o upload. Automaticamentne o nosso Módulo aparecerá em sua lista. Clique em instalar. Um alerta será exibido. Apenas clique em “prosseguir com a instalação”.

Obs. Caso esteja tendo dificuldades na instalação, configuração ou importação dos ebooks, disponibilizamos um tutorial com ilustrações. Você pode visualizar <a href="https://drive.google.com/open?id=0BzwFNhJ9FBNwV3BoTHdqeEl0WGc">aqui</a>.

#Configurando o Módulo

Após instalar o Módulo com sucesso clique em configurar. Na tela inicial você terá apenas que escolher como deseja que os autores dos nossos ebooks sejam exibidos em sua loja. Escolha a opção que mais lhe agrada e clique em prosseguir.

#Importando os Ebooks

Esse é o momento em que você irá importar os ebooks cadastrados em nossa plataforma para a sua loja. Você precisa apenas informar a chave e a senha que enviamos para você, escolher a o tipo da operação, o ambiente e clique em importar. 
Atenção. O tempo da importação irá variar de acordo com vários fatores, tais como a  velocidade do seu servidor e da conexão de sua internet!

#Atualizações Diárias

Realizamos atualizações diárias em nosso sistema e você precisará, também diariamente, criar uma rotina para checar se existem ebooks a serem inseridos, atualizados ou deletados.
Recomendamos que crie uma agendador de tarefas para rodar entre 01 e 06 da manhã(GMT-3) afim de evitar que ebooks sejam disponibilizados com dados defasados podendo assim causar erros na venda.
Tudo o que você precisa fazer é executar, periodicamente, o arquivo "cron.php" que se encontra no diretório "modules/bibliomundi".

Atenção. Esta etapa requer conhecimentos de infra-estrutura. Sugerimos que contacte o administrador do servidor. 

Você não irá conseguir fazer a chamada via url, como por exemplo "/seuprestashop.com.br/admin/modules/bibliomundi/cron.php", pois o prestashop requer um token de autenticação e o mesmo é dinâmico, portanto você deverá executar o arquivo via linha de comando. Ex: "php /home/USER/public_html/modules/bibliomundi/cron.php"

#Observações

- Não se esqueça de renomear a pasta, que se encontra na raiz do zip, para "bibliomundi". Sem isso você não conseguirá instalar o módulo.
- Após desinstalar o nosso módulo, todos os nossos ebooks serão removidos de sua lista de produtos, bem como suas respectivas categorias, características e etiquetas.
- Execute as atualizações entre 01 e 06 da manhã(GMT-3).

#FAQ

Após a instalação do módulo os meus produtos não estão sendo pesquisáveis em minha loja, por quê?.

R. Na administração, navegue até Preferências > Buscar e clique em Reconstruir indíces.

Por que os produtos da Bibliomundi aparecem como "sem estoque" ? 

R. Não há limitações de unidade para os nossos ebooks e no Prestashop não existe uma maneira nativa de configurar isto, logo, foi necessário alguns ajustes. Simplesmente ignore está mensagem. Não se preocupe.
