# TPC 9 - Aula 11

## Pergunta 1

1. A vulnerabilidade que salta mais à vista é a utilização da função ```system``` que permite executar comandos na linha de comando. Esta função vai receber como argumento a *string* dada pelo utilizador, sem qualquer tipo de verificação, o que é extremamente perigoso, termos de segurança. 
Outra das vulnerabilidade existentes, é que não é verificado nem o tamanho do input (quantos argumentos foram passados) nem o tamnho da string do ```agrv[1]```, assim, o que pode ser um simples comando inocente pode acabar por relevar informações confidenciais.

2. 
    * No primeiro caso, se o programa fosse chamado da seguinte maneira:```./filetype "/etc/passwd | cat /etc/shadow"``` iria ser possível aceder ás passwords do sistema, caso a execução tivesse as permissões necessárias.

    * No segundo caso, 

3. Como foi dito anteriormente (num dos exemplos), se o programa tivesse permissões *setuid root* todo o sistema ficava comprometido, uma vez que, seria possível executar qualquer código na máquina. Com as permissões *root* através do programa era possível executar programas malignos, alterar comandos do sistema (como o ```ls```), ver o conteúdo de todos os ficheiros, apagar ou encriptar certos ficheiros. Ou seja, caso o programa tivesse permissões root iria comprometer a integridade, disponibilidade e confidenciabilidade do sistema.

## Pergunta 2


```

```