import datetime

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

def verifyNIC(nic):
    try:
        n = int(nic)

        if len(nic) != 8 :
            return 1
        else:
            return 0
    except ValueError:
        return 1

def verifyNCC(ncc):
    try:
        n = int(ncc)

        if len(ncc) != 16 :
            return 1
        else:
            return 0
    except ValueError:
        return 1

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

def verifyCVV(cvv):
    try:
        n = int(cvv)

        if len(cvv) != 3 :
            return 1
        else:
            return 0
    except ValueError:
        return 1

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

if __name__ == "__main__":
    main()
