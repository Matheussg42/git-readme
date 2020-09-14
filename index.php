<?php

use App\Github;
use App\Readme;

require_once('src/Github.php');
require_once('src/Readme.php');

echo "*************************" . PHP_EOL;
echo "***** Update Readme *****" . PHP_EOL;
echo "*************************" . PHP_EOL;

$GitHubUser = (string)readline('Insira usuário do GitHub. -> ');
$projetoLocal = (string)readline('Insira a Localização do projeto Local. -> ');
$arquivoLocal = (string)readline('Insira o nome do arquivo: Ex:readme.md -> ');
$commit = (string)readline('Informe a mensagem do commit. -> ');

$github = new Github($GitHubUser);
$linguagensString = $github->getLinguagensString($github->getLinguagens());

echo "Buscando Repositórios";
usleep(800000);
echo ".";
usleep(800000);
echo ".";
usleep(800000);
echo "." . PHP_EOL;
usleep(500000);


$data = date("d/m/Y H:i:s");

$readmeTexto = "<p align='center'><a target='_blank' href='https://matheus.sgomes.dev'><img src='https://matheus.sgomes.dev/img/logo_azul.png'></a></p>

👤 **Matheus S. Gomes** 

### Olá!👋

#### Sou desenvolvedor Full-stack trabalhando com PHP, Node.js e React.js em Belo Horizonte, MG.

- **⚙️ Techs: `PHP`, `Laravel`, `Node.js`, `React.js`**
- **🌍 Website: https://matheus.sgomes.dev**
- **💻 Github: [@Matheussg42](https://github.com/Matheussg42)**
- **📝 LinkedIn: [@matheussg](https://linkedin.com/in/matheussg)**
- **🌐 Twitter: [@matheussg42](https://twitter.com/matheussg42)**
- **📝 Medium: [@matheussg](https://medium.com/@matheussg)**

<hr>

#### Sobre o meu GitHub eu possuo no momento {$github->getnumRepositorios()} projetos públicos nas seguintes linguagens:
   
<br>

{$linguagensString}

<br>

Atualizado no dia {$data}
";

$caminho = $projetoLocal . '/' . $arquivoLocal;
$readme = new Readme($caminho, $readmeTexto);
$mensagem = $commit . PHP_EOL . "Atualizando Readme em {$data}";

echo "Gerando readme";
usleep(800000);
echo ".";
usleep(800000);
echo ".";
usleep(800000);
echo "." . PHP_EOL;
usleep(500000);

if ($readme->gerarArquivo()) {
    echo shell_exec("cd {$projetoLocal} && /usr/bin/git add . && /usr/bin/git commit -m '{$mensagem}' && /usr/bin/git push");
}

echo "Finalizado!";
