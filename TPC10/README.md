# TPC 10 - Aula 12

## Pergunta 1 - *SQL Injection*

### Passo 1 - Apenas informação

![Passo1](./Imagens/Passo1.png)

### Passo 2 - Realização de uma *query* SQL

![Passo2](./Imagens/Passo2.png)

#### Solução

Apenas uma simples *query* SQL.

![Passo2S](./Imagens/Passo2S.png)

### Passo 3 - Query de manipulação

![Passo3](./Imagens/Passo3.png)

#### Solução 

Apenas era necessário a introdução de uma simples *query* SQL.

![Passo3S](./Imagens/Passo3S.png)

### Passo 4 - Query de alteração/modificação de tabelas

![Passo4](./Imagens/Passo4.png)

#### Solução 

Mais uma vez a solução apenas a construção de uma *query* SQL.

![Passo4S](./Imagens/Passo4S.png)

### Passo 5 - Query de alteração de permissões

![Passo5](./Imagens/Passo5.png)

#### Solução 

Mais uma vez a solução apenas a construção de uma *query* SQL.

![Passo5S](./Imagens/Passo5S.png)

### Passo 6 - Passo informativo

![Passo61](./Imagens/Passo61.png)

![Passo62](./Imagens/Passo62.png)

### Passo 7 - Passo informativo

![Passo7](./Imagens/Passo7.png)

### Passo 8 - Passo informativo

![Passo8](./Imagens/Passo8.png)

### Passo 9 - *String* SQl *Injection* 

![Passo9](./Imagens/Passo9.png)

#### Descrição do passo e explicação da solução 

Para fechar a apóstrofe e o *last_name* temos de introduzir o nome ```Smith``` seguido de apóstrofe. Para obter a informação sem ter as informações corretas insere-se o ```1=1```, ou seja, verdadeiro. Os apóstrofes também devem corresponder.

### Passo 10 - *Number* SQl *Injection* 

![Passo10](./Imagens/Passo10.png)

#### Descrição do passo e explicação da solução 

Neste caso, não existe um problema obvio com as aspas ou apóstrofes. Na segunda variável usa-se o mesmo truque que no passo anterior, ou seja, ```OR 1=1```. Neste caso, os números postos no primeiro campo ou antes do **OR** não eram importantes. A solução final está na imagem em cima.

### Passo 11 - *Compromising confidentiality with String* SQl *Injection* 

![Passo11](./Imagens/Passo11.png)

#### Descrição do passo e explicação da solução 

Mais uma vez, a repitação do processo das queries anteriores, desta feita, era um pouco mais difícil lidar com as aspas e apóstrofes. A solução final está na imagem em cima.

### Passo 12 - *Compromising Integrity* com *Query chaining* 

![Passo12](./Imagens/Passo12.png)

#### Solução 

- Employee Name - ```Smith```
- Authentication TAN - ```3SL99A'; UPDATE employees SET salary=100000 WHERE last_name='Smith```


### Passo 13 - *Compromising Availability* 

![Passo13](./Imagens/Passo13.png)

#### Solução 

Neste caso, a solução neste caso era apagar como complemento a tabela. Usando o que foi visto no passo informativo número 6, a solução era a seguinte: ```'; DROP TABLE access_log;--```.

## Pergunta 2 - *XSS*

### Passo 1 - Passo informativo

![Passo1XSS](./Imagens/Passo1XSS.png)

### Passo 2 - *Cookies*

![Passo2XSS](./Imagens/Passo2XSS.png)

#### Solução

A resposta é **YES**. Para conseguir chegar a esta conclusão basta ir a cada *tab*, abrir o modo *developer*, ir a *Console* (o *browser* é o *Firefox*) e executar a linha dada: ```alert(document.cookie)``` e verificar ambos os *outputs*, que são iguais nas duas páginas.

### Passo 3 - Passo informativo

![Passo3XSS](./Imagens/Passo3XSS.png)

### Passo 4 - Passo informativo

![Passo4XSS](./Imagens/Passo4XSS.png)

### Passo 5 - Passo informativo

![Passo5XSS](./Imagens/Passo5XSS.png)

### Passo 6 - Passo informativo

![Passo6XSS](./Imagens/Passo6XSS.png)

### Passo 7 - *Reflected XSS*

![Passo7XSS](./Imagens/Passo7XSS.png)

#### Solução

O campo vulnerável era o ```Enter your credit card number:``` e, nesse campo, foi introduzido o seguinte código: ```<script>alert()</script>```, desta forma, aparece um alerta no ecrã (vazio).

### Passo 8 - Passo informativo

![Passo8XSS](./Imagens/Passo8XSS.png)

### Passo 9 - Passo informativo

![Passo9XSS](./Imagens/Passo9XSS.png)

### Passo 10 - *Identify potential for DOM-Based XSS*

![Passo10XSS](./Imagens/Passo10XSS.png)
**Solution 4**
#### Solução

- Primeiro abrir o *development tools* e ir ao separador *Debugger*
- Encontrar o ficheiro das *routes* (```goatApp/View/GoatRouter.js```)
- Inserir ```start.mvc#test/``` na caixa de resposta

### Passo 11 - *DOM-Based XSS*

![Passo11XSS](./Imagens/Passo11XSS.png)

#### Solução

- Noutro separador abrir o URL ```localhost:8080/WebGoat/start.mvc#test/<script>webgoat.customjs.phoneHome()<%2Fscript>```
- Abrir o *development tools*
- Ir ao separador *console*
- Copiar e colar na caixa de resposta o valor encontrado na consola

### Passo 12 - 

![Passo12XSS](./Imagens/Passo12XSS.png)

#### Soluções

- 1 - **Solution 4**
- 2 - **Solution 3**
- 3 - **Solution 1**
- 4 - **Solution 2**
- 5 - **Solution 4**

## Pergunta 3 - *Password Reset*

Utilizando o *WebGoat* a lição A2 *Broken Authentication > Password Reset* serve como forma de testar ataques a *Password Reset*.

A lição começa por testar o acesso ao *e-mail* do *WebWolf*, para garantir que está operacional. Em seguida é explicado como verificar se uma conta existe.

O ponto seguinte consiste em ativar a recuperação de *password* a partir do *username* e de uma pergunta de segurança (por força bruta) tentar submeter uma tentativa de recuperação de *password* (através de Força Bruta).

Tento isto em mente são explicadas quais os tipos de perguntas de segurança são mais adequados, levando à conclusão que as melhores perguntas são as que têm uma resposta fácil de memorizar mas difícil de descobrir.

Por fim, é criado um *link* para resetar a *password* do *e-mail tom@webgoat-cloud.org*. É neste passo que é concluída a *Password Reset*.

![Resultado](./Imagens/A2_final.png)

## Pergunta 4 - *Vulnerable components*

Como forma de entender melhor os componentes vulneráveis o *WebGoat* têm a lição A9 *Vulnerable Components*.

O processo da lição inicia-se com uma explicação do que são ecossistemas *Open Source* e a razão pela qual este problema de componentes vulneráveis está no top 10 do *OWASP*. Em seguida é mostrado que os componentes estão em todo lado e que até no *WebGoat* existem imensos componentes de risco.

Depois de uma introdução, são apresentados dois exemplos de vulnerabilidades que não estão no "nosso" código (*jquery-ui:1.10.4* e *jquery-ui:1.12.0 Not Vulnerable*). 

No passo seguinte são introduzidas formas de gerar listas de componentes que estão a ser utilizados de forma a identificar quais os que representam risco.

Na parte final da lição é explicado o que é sobrecarga de informação de segurança, informações de arquitetura e alguns exemplos de riscos *OSS*. Por fim, é feito um exercício de exploração da vulnerabilidade *VE-2013-7285 (XStream)*, ou seja, a partir da introdução de uma representação *XML* de um contacto e o *XStream.fromXML(xml)* é possível converter esse *XML* para um contacto.