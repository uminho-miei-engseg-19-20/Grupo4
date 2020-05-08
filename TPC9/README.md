# TPC 9 - Aula 11

## Pergunta 1

1. A vulnerabilidade que salta mais à vista é a utilização da função ```system``` que permite executar comandos na linha de comando. Esta função vai receber como argumento a *string* dada pelo utilizador, sem qualquer tipo de verificação, o que é extremamente perigoso, termos de segurança. 
Outra das vulnerabilidade existentes, é que não é verificado nem o tamanho do input (quantos argumentos foram passados) nem o tamnho da string do ```agrv[1]```, assim, o que pode ser um simples comando inocente pode acabar por relevar informações confidenciais.

2. 
    * No primeiro caso, se o programa fosse chamado da seguinte maneira:```./filetype "/etc/passwd | cat /etc/shadow"``` iria ser possível aceder ás passwords do sistema, caso a execução tivesse as permissões necessárias.

    * No segundo caso, 

3. Como foi dito anteriormente (num dos exemplos), se o programa tivesse permissões *setuid root* todo o sistema ficava comprometido, uma vez que, seria possível executar qualquer código na máquina. Com as permissões *root* através do programa era possível executar programas malignos, alterar comandos do sistema (como o ```ls```), ver o conteúdo de todos os ficheiros, apagar ou encriptar certos ficheiros. Ou seja, caso o programa tivesse permissões root iria comprometer a integridade, disponibilidade e confidenciabilidade do sistema.

## Pergunta 2

No [Programa](https://github.com/uminho-miei-engseg-19-20/Grupo4/blob/master/TPC9/Programa.py) são pedidos os *inputs* e só depois é feita a validação deles. Os *inputs* são verificados e validados individualmente, se algum *input* falhar o programa retorna uma mensagem de erro. 

Nos capítulos seguintes irá ser explicado o pensamento para cada uma das validação assim como o código usado. Falta acrescentar que este programa foi feito em *python*.

### Função main

```
def main():
    ok = 0
    debt     = input("Introduzir o valor a pagar (Duas casas decimais obrigatórias, separadas das restantes com ponto): ")
    birth    = input("Introduzir a data de nascimento (Formato: DD-MM-AAAA): ")
    name     = input("Introduzir o nome (Primeiro e último apenas): ")
    nif      = input("Introduzir o NIF: ")
    nic      = input("Introduzir o NIC (número mais os 3 carateres de verificação, sendo o número separado dos carateres de verificação por um espaço): ")
    ncc      = input("Introduzir o número de cartão de crédito: ")
    validade = input("Introduzir a validade do cartão de crédito (Formato: MM-AAAA): ")
    cvv      = input("Introduzir os números de verificação do cartão de crédito:" )

    ok = verifyDebt(debt) + verifyBirth(birth) + verifyName(name) + verifyNIF(nif) + verifyNIC(nic) + verifyNCC(ncc) + verifyValid(validade) + verifyCVV(cvv)

    if (ok == 0):
        print("All went well")
    else:
        print("Error: bad input")
```

### Verificar valor a pagar

Como foi dito na ```main``` é obrigatório o valor a pagar ter duas e só duas casa decimais sendo o carater de separação um ponto. E ainda se o valor não for um *float* não será aceite.

```
def verifyDebt(debt):
    try:
        valor = float(debt)
        point = debt.find('.')
        if point == -1 :
            return 1
        elif point == (len(debt)-3) :
            return 0
        else:
            return 1
    except ValueError:
        return 1
```

### Verificar a data de nascimento

Na ```main``` é pedido que o formato seja **DD-MM-AAAA**, se este formato não for cumprido o *input* é considerado inválido. Na função verifica-se se o dia é possível, ou seja, se não é menor que zero ou que não é dia 31 de fevereiro, por exemplo. O programa também tem um requerimento que o utilizador seja maior de idade, ou seja, caso a data de nascimento não seja correspondente a uma pessoa maior de idade, o *input* é inválido.

```
def verifyBirth(birth):
    data = birth.split('-')

    if (len(data) == 3 and len(data[0]) == 2 and len(data[1]) == 2 and len(data[2]) == 4):
        try:
            dia = int(data[0])
            mes = int(data[1])
            ano = int(data[2])

            dt = datetime.date.today()
            anoAtual = int(dt.strftime("%Y"))
            if (ano <= anoAtual):
                if (mes > 0 and mes < 13):
                    if (dayCorrect(mes,dia) == 0):
                        return 1
                else:
                    return 1
            else:
                return 1

            if (older18(dia,mes,ano,dt) == 1):
                return 0
            else:
                return 1
        except ValueError:
            return 1
    else:
        return 1

def dayCorrect(mes,dia):
    if (dia < 1 or dia > 31):
        return 0

    if (mes == 2 and dia > 28):
        return 0

    if (mes == 4 or mes == 6 or mes == 9 or mes == 11 and dia > 30):
        return 0

    return 1

def older18(dia,mes,ano,dt):
    anoAtual = int(dt.strftime("%Y"))
    mesAtual = int(dt.strftime("%m"))
    diaAtual = int(dt.strftime("%d"))

    if (ano > (anoAtual-18)):
        return 0
    elif (ano == (anoAtual-18)):
        if (mes < mesAtual):
            return 1
        elif (mes == mesAtual):
            if (dia <= diaAtual):
                return 1
            else:
                return 0
        else:
            return 0
    else:
         return 1
```

### Verificar o nome

Na ```main``` é dito que apenas são necessários o primeiro e o último nome. Para além disso, não são permitidos qualquer tipo de carateres especiais ou números nos nomes, apenas um ```-``` no último nome.

```    
def verifyName(name):
    nome = name.split(' ')
    r = 0
    l = 0

    if (len(nome) != 2):
        return 1
    else:
        for c in nome[0]:
            if (c.isalpha() is False):
                return 1

        for ch in nome[1]:
            if (ch.isalpha()):
                l = 0
            elif (ch == '-'):
                r = r + 1
                if (r != 1):
                    return 1
            else:
                return 1

        return 0
```

### Verificar NIF

Para o **NIF** são verificados se os nove primeiros digitos são números e se os 3 carateres de verificação são letras ou números.

```
def verifyNIF(nif):
    data = nif.split(' ')

    if (len(data) == 2):
        try:
            n = int(data[0])

            if len(data[0]) != 9 :
                return 1

            if len(data[1]) == 3 :
                for c in data[1]:
                    if (c.isalpha() is False and c.isdigit() is False):
                        return 1
                return 0
            else:
                return 1

        except ValueError:
            return 1
    else:
        return 1
```

### Verificar NIC

Apenas é verificado se todos os carateres são dígitos e se são 8.

```
def verifyNIC(nic):
    try:
        n = int(nic)

        if len(nic) != 8 :
            return 1
        else:
            return 0
    except ValueError:
        return 1
```

### Verificar NCC

O número do cartão de crédito é composto por 16 números, se isso não se verificar o *input* não é válido.

```
def verifyNCC(ncc):
    try:
        n = int(ncc)

        if len(ncc) != 16 :
            return 1
        else:
            return 0
    except ValueError:
        return 1
```

### Verificar validade do cartão de crédito

Verifica-se se a data é válida e se o cartão tem validade.

```
def verifyValid(validade):
    data = validade.split('-')

    if (len(data) == 2 and len(data[0]) == 2 and len(data[1]) == 4):
        try:
            mes = int(data[0])
            ano = int(data[1])

            dt = datetime.date.today()
            anoAtual = int(dt.strftime("%Y"))
            mesAtual = int(dt.strftime("%m"))

            if (mes > 0 and mes < 13):
                if (ano > anoAtual):
                    return 0
                elif (ano == anoAtual):
                    if (mes < mesAtual):
                        return 1
                    else:
                        return 0
                else:
                    return 1
            else:
                return 1

        except ValueError:
            return 1
    else:
        return 1
```

### Verificar CVV

Verifica-se se o código de verificação são 3 dígitos.

```
def verifyCVV(cvv):
    try:
        n = int(cvv)

        if len(cvv) != 3 :
            return 1
        else:
            return 0
    except ValueError:
        return 1
```