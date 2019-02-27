<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulário com Regex</title>

</head>
<body>
    <h1>Formulário com Regex</h1>

    <h3>O que é Regex?</h3>
    
    <p>
        <strong>Regex</strong> ou ainda <strong>regexp</strong> são termos em inglês (abreviações de regular expression) cujo equivalente em português é <strong>expressão regular</strong>. Em computação, uma expressão regular é usada para identificar padrões em textos de maneira simples.
    </p>

    <p>
        Muitas linguagens de programação possuem seu próprio interpretador de expressões regulares, possuindo ainda funções próprias para avaliar uma dada variável de texto. Em PHP, por exemplo, a função <strong>preg_match()</strong> recebe como parâmetro duas variáveis, uma com o regex e outra com o texto a ser avaliado, retornando <strong>true</strong> caso o texto contenha o padrão informado ou <strong>false</strong> caso contrário.
    </p>

    <h3>Validação de CPF</h3>

    <p>
        Um CPF (Cadastro de Pessoa Físia) é um documento com numeração de 11 (onze) dígitos fornecido a brasileiros pelo governo federal e tem função de identificar contribuintes. O CPF possui o seguinte padrão numérico que pode ser usado como regex: "XXX.XXX.XXX-XX".
    </p>

    <p>
        Utilize o formulário abaixo para testar se seu CPF é válido, isto é, se ele segue o padrão.
    </p>

    <h3>Formulário</h3>
    
    <form>
        <fieldset>
            <legend>Form with Regex</legend>

            <label>
                CPF:
                <input type="text" name="name">
            </label>

            <input type="submit" name="submit" value="Testar CPF">

        </fieldset>
    </form>
</body>
</html>