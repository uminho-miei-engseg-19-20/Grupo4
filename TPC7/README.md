# TPC 7 - Aula 9

## Exercício 1 - **Buffer Overflow**

### Pergunta 1.1 - *Buffer overflow* em várias linguagens

O programa 'LOverflow2', está escrito em 3 linguagens diferente, *Java*, *Python* e *C++*. Começa por pedir a introdução de quantos números se pretende introduzir. De seguida, os números, são lidos e armazenados num *array* estático, com 10 posições, tantos números quantos os indicados inicialmente.

O problema deste programa encontra-se na ausência de verificação do primeiro valor inserido, isto é, se a quantidade de números que se pretende indicar é inferior ou igual a 10. Para além disso, não é validado se o input introduzido corresponde a um inteiro.

Dessa forma, as situações consideradas para teste do programa são:

+ Inserção de um número com valor muito grande;
+ Inserção de uma quantidade de números muito superior a 10;
+ Inserção de letras, em vez de números;
+ Inserção de uma quantidade de números negativa;
+ Inserção de uma operação (no caso da linguagem *Python*).

Relativamente ao programa escrito em *Java*, verificou-se que nos casos de inserção de valores muito elevados ou com inputs não inteiros, é lançada uma exceção. Para além disso, quando é inserida uma quantidade de números negativa, não é solicitado nenhum valor. O output gerado pelo programa *Java* para estas situações é apresentado na imagem que se segue.

![Java_array_overflow](./Imagens/Java_array_overflow.png)
![Java_input_overflow](./Imagens/Java_input_overflow.png)
![Java_letra](./Imagens/Java_letra.png)
![Java_negativo](./Imagens/Java_negativo.png)

Quanto ao programa escrito em *Python*, continuou a verificar-se o lançamento de exceções no caso da introdução de inteiros demasiado elevados. Na introdução de uma quantidade de números negativa, ainda se constatou que simplesmente não era solicitado nenhum valor.

Um aspeto curioso que se verifica com o recurso à função input do *Python*, é que a expressão lida do *stdin* é executada. Assim, a introdução de 1+3 é equivalente à introdução do *input* 4.

Todas estas experiências são apresentadas na imagem que se segue.

![Python_array_overflow](./Imagens/Python_array_overflow.png)
![Python_input_overflow](./Imagens/Python_input_overflow.png)
![Python_letra](./Imagens/Python_letra.png)
![Python_negativo](./Imagens/Python_negativo.png)
![Python_Script](./Imagens/Python_Script.png)

Em último lugar, para o programa escrito em *C++*, verificou-se que após indicação de uma quantidade de números válida, caso se introduza um valor que cause overflow, as restantes solicitações de valores são impressas e o programa termina, sem introdução de mais qualquer input por parte do utilizador.

![C_array_overflow](./Imagens/C++_array_overflow.png)

Verificou-se também que a inserção de uma quantidade de números ligeiramente superior ao suportado (10), faz com que de seguida sejam solicitados mais valores do que o indicado. Caso se introduza uma quantidade de números bastante superior, o programa começa a solicitar a inserção de números repetidamente, sem parar, conforme se pode verificar na figura apresentada de seguida.

![C_input_overflow](./Imagens/C++_input_overflow.png)

Quando se inserem *inputs* que não sejam inteiros no campo de quantos números o programa simplesmente termina.

![C_letra](./Imagens/C++_letra.png)

Por fim, a introdução de uma quantidade de números negativa continua a ter o mesmo resultado que para as restantes linguagens, isto é, não é solicitada a inserção de nenhum valor.

![C_negativo](./Imagens/C++_negativo.png)

### Pergunta 1.2 - *Root Exploit*

![RootExploit](./Imagens/RootExploit.png)

### Pergunta 1.3 - *Read Overflow*

![ReadOverflow1](./Imagens/ReadOverflow1.png)
![ReadOverflow2](./Imagens/ReadOverflow2.png)

### Pergunta 1.4

### Pergunta 1.5 - Buffer overflow na Heap

### Pergunta 1.6 - Buffer overflow na Stack
