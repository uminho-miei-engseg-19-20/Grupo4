# TPC 6 - Aula 7

## Exercício 1 - **Vulnerabilidade de codificação**

### Pergunta 1.1
#### 1.

**CWE-119: Improper Restriction of Operations within the Bounds of a Memory Buffer**

**Características:** 
Este *CWE* diz respeito a software que realiza operações no *buffer* da memória, mas que pode ler ou escrever em localizações da memória fora dos limites do *buffer*. O nível de explorabilidade desta fraqueza é alto.

**Linguagens Afetadas:** *C*, *C++* e *Class: Assembly*

**Consequências:** 
Se a memória acessível pelo invasor puder ser efetivamente controlada, talvez seja possível executar código arbitrário. Se o invasor puder sobrescrever a memória de um *pointer*, poderá redirecionar um *pointer* de função para seu próprio código malicioso. Para além disso, o acesso à memória fora dos limites provavelmente resultará na corrupção da memória relevante e, possivelmente levando a uma falha. Outros ataques que levam à indisponibilidade são possíveis, incluindo colocar o programa em um *loop* infinito. Por fim, no caso de uma leitura fora dos limites, o invasor pode ter acesso a informações confidenciais. Se as informações confidenciais contiverem detalhes do sistema, como a posição atual dos *buffers* na memória, esse conhecimento poderá ser usado para criar novos ataques, possivelmente com consequências mais graves.


**CWE-79: Improper Neutralization of Input During Web Page Generation ('Cross-site Scripting')**

**Características:**
Esta fraqueza corresponde a software que não neutraliza ou neutraliza incorretamente o *input* controlável pelo utilizador antes de ser colocado no *output* usado como uma página *web* que é servida a outros utilizadores. Esta fraqueza é conhecida como *Cross-site scripting (XSS)* e existem 3 tipos principais: *Type 1: Reflected XSS*, *Type 2: Stored XSS* e *Type 0: DOM-Based XSS*.

A fraqueza normalmente é introduzida durante a implementação de uma tática de segurança na arquitetura.

**Linguagens Afetadas:** *Class: Language-Independent*
**Tecnologias Afetadas:** *Class: Web Based*
						 
**Consequências:** 
O ataque mais comum realizado com *scripts* entre sites envolve a divulgação de informações armazenadas nos *cookies* do utilizador. Normalmente, um atacante cria um *script* do lado do cliente, que realiza alguma atividade (como enviar todos os *cookies* do site para um determinado endereço de email). Este *script* será carregado e executado por cada utilizador que visitar o site. Como o site que solicita a execução do *script* tem acesso aos *cookies* em questão, o *script* malicioso também. Em algumas circunstâncias, pode ser possível executar código arbitrário no computador da vítima quando o *script* entre sites é combinado com outras falhas. 

A consequência de um ataque *XSS* é a mesma, independentemente de ser *stored* ou *reflected*. A diferença está em como a carga útil chega ao servidor. O *XSS* pode causar uma variedade de problemas para o utilizador final, que variam em gravidade, desde um aborrecimento até o comprometimento total da conta. Algumas vulnerabilidades de *script* entre sites podem ser exploradas para manipular ou roubar *cookies*, criar solicitações que podem ser confundidas com as de um utilizador válido, comprometer informações confidenciais ou executar código malicioso nos sistemas do utilizador final para vários propósitos nefastos. Outros ataques prejudiciais incluem a divulgação de arquivos do utilizador final, a instalação de programas de cavalos de Troia e o redirecionamento do utilizador para outra página ou site.


**CWE-20: Improper Input Validation**

**Características:** 
Neste *CWE* o produto não valida ou valida incorretamente os *inputs* que podem afetar o fluxo de controlo ou o fluxo de dados de um programa. Quando o software não valida o *input* corretamente, um invasor pode criar a entrada de uma forma que não é esperada pelo resto da aplicação. Isso fará com que partes do sistema recebam entrada não intencional, o que pode resultar em fluxo de controlo alterado, controlo arbitrário de um recurso ou execução arbitrária de código.

A fraqueza normalmente é introduzida durante a implementação de uma tática de segurança na arquitetura.

**Linguagens Afetadas:** *Class: Language-Independent*
						 
**Consequências:**
Um invasor pode fornecer valores inesperados e causar uma falha no programa ou consumo excessivo de recursos, como memória e CPU. Para além disso, pode ler dados confidenciais se conseguir controlar as referências de recursos. E ainda, pode usar entrada maliciosa para modificar dados ou possivelmente alterar o fluxo de controlo de formas inesperadas, incluindo a execução arbitrária de comandos.

#### 2.

**CWE-416: Use After Free** (*Rank* 7)

**Características:**
Esta fraqueza faz referência à memória depois dela ser liberada. Pode causar falha no programa, usar valores inesperados ou executar código.

Os erros de uso após libertação têm duas causas comuns e às vezes sobrepostas:
	- Condições de erro e outras circunstâncias excecionais.
	- Confusão sobre qual parte do programa é responsável por libertar a memória.

Nesse cenário, a memória em questão é alocada para outro *pointer* valido após ter sido libertada. O *pointer* original para a memória libertada é usado novamente e aponta para algum lugar dentro da nova alocação. À medida que os dados são alterados, ele corrompe a memória usada corretamente, o que induz um comportamento indefinido no processo. Se os dados recém-alocados tiverem chances de manter uma classe, vários *pointers* de função podem estar espalhados nos dados de *heap*. Se um desses *pointers* de função for sobrescrito por um endereço para código de *shell* válido, a execução de código arbitrário poderá ser alcançada.

**Linguagens Afetadas:** *Class: Language-Independent*
						 
**Consequências:**
O uso da memória libertada anteriormente pode ter inúmeras consequências adversas, desde a corrupção de dados válidos até a execução de código arbitrário, dependendo da instanciação e do momento da falha. As formas mais simples de corrupção de dados que podem ocorrer envolvem a reutilização da memória libertada pelo sistema. 

O uso da memória libertada anteriormente pode corromper dados válidos, se a área de memória em questão tiver sido alocada e usada corretamente em outro local. Se a consolidação de bloco ocorrer após o uso de dados libertados anteriormente, o processo poderá falhar quando dados inválidos forem usados como informações de bloco. Se dados mal intencionados forem inseridos antes da consolidação da parte, talvez seja possível tirar proveito de uma primitiva *write-what-where* para executar código arbitrário.

**Exemplo de código:**
```
char* ptr = (char*)malloc (SIZE);
if (err) {
	abrt = 1;
	free(ptr);
}
...
if (abrt) {
	logError("operation aborted before commit", ptr);
}
```

Quando ocorre um erro, o *pointer* é libertado imediatamente. No entanto, esse *pointer* é usado incorretamente posteriormente na função *logError*.

Um exemplo de um *CVE* que inclui esta fraqueza é o *CVE-2010-4168*. Nele é relatado que em *OpenTTD 1.0.x* antes da versão 1.0.5 é possível forçar a libertação de memória fechando uma conexão enquanto os dados ainda estão a ser transmitidos.

### Pergunta 1.2

### Pergunta 1.3

##### Vulnerabilidades de projeto 

* Introduzidas durante a fase de projeto do software.

###### [CWE-327: Use of a Broken or Risky Cryptographic Algorithm](https://cwe.mitre.org/data/definitions/327.html)

O uso de algoritmos criptográficos arriscados ou *avariado* acrescenta um risco de exposição a ataques a um produto. Neste caso, se durante a fase de planeamento escolherem algoritmos *non-standard*, que podem ser fáceis de quebrar, está-se a por em causa toda a integridade, confidencialidade e disponibilidade do sistema.

Neste caso, a correção é simples, por assim dizer, basta mudar o algoritmo para outro mais forte, com níveis de segurança aceitáveis.

###### [CWE-521: Weak Password Requirements](https://cwe.mitre.org/data/definitions/521.html)

Neste caso, o produto não requer que os seus utilizadores usem passwords fortes sendo, desta forma, mais fácil aos atacantes atacar as contas. Como o sistema não requer passwords fortes (Minimo de 8 ou 16 carateres, letras, números e simbolos) é normal que os utilizadores não liguem tanto à segurança e criem passwords fracas, facilmente atacáveis por força bruta.

Mais uma vez, a correção deste problema é simples. Para este caso basta passar a pedir passwords fortes aos utilizadores, desta forma, as contas estarão mais protegidas dos ataques.

##### Vulnerabilidades de codificação

- Introduzidas durante a programação do software, i.e., um bug com implicações de segurança.

###### [CWE-20: Improper Input Validation](https://cwe.mitre.org/data/definitions/20.html)

Esta vulnerabilidade acontece quando o programa não valida ou valida incorretamente o *input* que pode after o fluxo de dados de um programa. Isto pode permitir ao atacante modificar o *input* de forma a não ser o esperado pelo resto da aplicação. E, desta forma, leva a que partes do sistema recebam *input* não esperado, podendo resultar em alterações no fluxo de controlo ou ainda em controlo sobre determinados recursos ou execução de código maligno.

Para corrigir este tipo de problemas já é necessário uma maior alteração de código, a solução mais simples e mais segura é considerar que todo o tipo de *input* é maligno, desta forma, todo o tipo de *input* deve ser validado.

###### [CWE-125: Out-of-bounds Read](https://cwe.mitre.org/data/definitions/125.html)

A leitura *out-of-bounds* é um vulnerabilidade causada pelo facto do programa tentar ler fora do *buffer* ou antes do mesmo começar. Isto acontece quando o código lê uma certa quantidade de data e assume que exise um *sentinel* para parar a leitura, caso este esteja fora de posição ou localizado no sentido errado, o processo da leitura vai continuar podendo causar *buffer overflow* ou *segmentation fault*. As consequências mais frequentes são a perda de confidenciabilidade por parte do sistema.

Possíveis correções passam por:

- Usar uma linguaguem que cuide das abstrações da memória.
- Verificar e assegurar que os calculos para o tamanho dos argumentos, do buffer e do *offset* estão corretos.
- Ter cuidado em confiar nos *sentinel* para parar as leituras e *inputs* não confiáveis.

##### Vulnerabilidades operacionais

- Causadas pelo ambiente no qual o software é executado ou pelas suas configurações.

###### [CWE-11: ASP.NET Misconfiguration: Creating Debug Binary](https://cwe.mitre.org/data/definitions/11.html)

As aplicações ASP.NET podem ser configuradas de forma a produzir binários de *debug*. Estes dão detalhes de messagens de debug e, portanto, não devem ser utilizados em produtos finais. Se, por engano, estes binários forem lançados juntamente com a versão final do produto. Pode trazer consequências graves para o produto e muitas facilidades para os ataques.

Neste caso, a correção passa apenas por não introduzir a parte de *debug* na versão final do produto (que é lançado para o mercado).

###### [CWE-453: Insecure Default Variable Initialization](https://cwe.mitre.org/data/definitions/453.html)

O *software* incializa as variáveis internas com valores inseguros ou menos seguros que os possíveis.

Solução: verificar que todos os valores cumpre os requisitos de seguranaça desejados.

### Pergunta 1.4

As vulnerabilidades do dia-zero, ou *0-day vulnerability*, são vulnerabilidades desconhecidas ou não abordadas pelas partes interessadas em mitigá-la, nomeadamente, o vendedor do produto ou responsável pelo mesmo. Para além do facto de ser desconhecida pelos responsáveis do produto, o que distingue a vulnerabilidade de dia-zero das restantes é a ameaça que estas acarreta. Uma vez que ainda não são conhecidas ou ainda não foi encontrada uma solução para as mesmas ao contrário das outras (que já são conhecidas, divulgadas e corrigidas). Nos primeiros dias este tipo de vulnerabilidade está sujeita a ataque, que muito provavelmente terão sucesso porque a vulnerabilidade ainda não foi solucionada ou, em caso de ter sido solucionada, muitos clientes ainda não terem feito o *update* para o *patch* mais recente.