# TPC 6 - Aula 7

## Exercício 1 - **Vulnerabilidade de codificação**

### Pergunta 1.1
#### 1.

**CWE-119: Improper Restriction of Operations within the Bounds of a Memory Buffer**

Características: 
- Este *CWE* diz respeito a software que realiza operações no *buffer* da memória, mas que pode ler ou escrever em localizações da memória fora dos limites do *buffer*. O nível de explorabilidade desta fraqueza é alto.

Linguagens Afetadas: *C*, *C++* e *Class: Assembly*

Consequências: Se a memória acessível pelo invasor puder ser efetivamente controlada, talvez seja possível executar código arbitrário. Se o invasor puder sobrescrever a memória de um *pointer*, poderá redirecionar um *pointer* de função para seu próprio código malicioso. Para além disso, o acesso à memória fora dos limites provavelmente resultará na corrupção da memória relevante e, possivelmente levando a uma falha. Outros ataques que levam à indisponibilidade são possíveis, incluindo colocar o programa em um *loop* infinito. Por fim, no caso de uma leitura fora dos limites, o invasor pode ter acesso a informações confidenciais. Se as informações confidenciais contiverem detalhes do sistema, como a posição atual dos *buffers* na memória, esse conhecimento poderá ser usado para criar novos ataques, possivelmente com consequências mais graves.


**CWE-79: Improper Neutralization of Input During Web Page Generation ('Cross-site Scripting')**

Características: 
- Esta fraqueza corresponde a software que não neutraliza ou neutraliza incorretamente o *input* controlável pelo utilizador antes de ser colocado no *output* usado como uma página *web* que é servida a outros utilizadores. Esta fraqueza é conhecida como *Cross-site scripting (XSS)* e existem 3 tipos principais: *Type 1: Reflected XSS*, *Type 2: Stored XSS* e *Type 0: DOM-Based XSS*.
- A fraqueza normalmente é introduzida durante a implementação de uma tática de segurança na arquitetura.

Linguagens Afetadas: *Class: Language-Independent*
Tecnologias Afetadas: *Class: Web Based*
						 
Consequências: 
- O ataque mais comum realizado com *scripts* entre sites envolve a divulgação de informações armazenadas nos *cookies* do utilizador. Normalmente, um atacante cria um *script* do lado do cliente, que realiza alguma atividade (como enviar todos os *cookies* do site para um determinado endereço de email). Este *script* será carregado e executado por cada utilizador que visitar o site. Como o site que solicita a execução do *script* tem acesso aos *cookies* em questão, o *script* malicioso também. Em algumas circunstâncias, pode ser possível executar código arbitrário no computador da vítima quando o *script* entre sites é combinado com outras falhas. 
- A consequência de um ataque *XSS* é a mesma, independentemente de ser *stored* ou *reflected*. A diferença está em como a carga útil chega ao servidor. O *XSS* pode causar uma variedade de problemas para o utilizador final, que variam em gravidade, desde um aborrecimento até o comprometimento total da conta. Algumas vulnerabilidades de *script* entre sites podem ser exploradas para manipular ou roubar *cookies*, criar solicitações que podem ser confundidas com as de um utilizador válido, comprometer informações confidenciais ou executar código malicioso nos sistemas do utilizador final para vários propósitos nefastos. Outros ataques prejudiciais incluem a divulgação de arquivos do utilizador final, a instalação de programas de cavalos de Troia e o redirecionamento do utilizador para outra página ou site.


**CWE-20: Improper Input Validation**

Características: 
- Neste *CWE* o produto não valida ou valida incorretamente os *inputs* que podem afetar o fluxo de controlo ou o fluxo de dados de um programa. Quando o software não valida o *input* corretamente, um invasor pode criar a entrada de uma forma que não é esperada pelo resto da aplicação. Isso fará com que partes do sistema recebam entrada não intencional, o que pode resultar em fluxo de controlo alterado, controlo arbitrário de um recurso ou execução arbitrária de código.
- A fraqueza normalmente é introduzida durante a implementação de uma tática de segurança na arquitetura.

Linguagens Afetadas: *Class: Language-Independent*
						 
Consequências: Um invasor pode fornecer valores inesperados e causar uma falha no programa ou consumo excessivo de recursos, como memória e CPU. Para além disso, pode ler dados confidenciais se conseguir controlar as referências de recursos. E ainda, pode usar entrada maliciosa para modificar dados ou possivelmente alterar o fluxo de controlo de formas inesperadas, incluindo a execução arbitrária de comandos.

#### 2.

**CWE-416: Use After Free** (*Rank* 7)

Características: 
- Esta fraqueza faz referência à memória depois dela ser liberada. Pode causar falha no programa, usar valores inesperados ou executar código.

- Os erros de uso após libertação têm duas causas comuns e às vezes sobrepostas:
	- Condições de erro e outras circunstâncias excecionais.
	- Confusão sobre qual parte do programa é responsável por libertar a memória.

Nesse cenário, a memória em questão é alocada para outro *pointer* valido após ter sido libertada. O *pointer* original para a memória libertada é usado novamente e aponta para algum lugar dentro da nova alocação. À medida que os dados são alterados, ele corrompe a memória usada corretamente, o que induz um comportamento indefinido no processo. Se os dados recém-alocados tiverem chances de manter uma classe, vários *pointers* de função podem estar espalhados nos dados de *heap*. Se um desses *pointers* de função for sobrescrito por um endereço para código de *shell* válido, a execução de código arbitrário poderá ser alcançada.

Linguagens Afetadas: *Class: Language-Independent*
						 
Consequências:
- O uso da memória libertada anteriormente pode ter inúmeras consequências adversas, desde a corrupção de dados válidos até a execução de código arbitrário, dependendo da instanciação e do momento da falha. As formas mais simples de corrupção de dados que podem ocorrer envolvem a reutilização da memória libertada pelo sistema. 

- O uso da memória libertada anteriormente pode corromper dados válidos, se a área de memória em questão tiver sido alocada e usada corretamente em outro local. Se a consolidação de bloco ocorrer após o uso de dados libertados anteriormente, o processo poderá falhar quando dados inválidos forem usados como informações de bloco. Se dados mal intencionados forem inseridos antes da consolidação da parte, talvez seja possível tirar proveito de uma primitiva *write-what-where* para executar código arbitrário.

Exemplo de código:
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

### Pergunta 1.4
