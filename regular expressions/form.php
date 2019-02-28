<?php  session_start(); include "validation.php"; ?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulário com Regex</title>
    <?php if ($dark_theme) : ?>
        <link rel="stylesheet" type="text/css" href="style-dark.css">
    <?php else : ?>
        <link rel="stylesheet" type="text/css" href="style.css">
    <?php endif; ?>
</head>
<body>
    <header>
        <nav class="top-nav">
            <ul>
                <li><a href="form.php">Index</a></li>
            </ul>
        </nav>

        <a class="dark-theme" href="?dark-theme"><img width="32px"></a>

        <div class="clear-fix" style="clear: both;"></div>
    </header>
    
    <div class="page-content">

        <h1>Formulário com Regex</h1>

        <nav>
            <h3>Índice:</h3>
            <ul>
                <li><a href="#sec-1">O que é Regex?</a></li>
                <li><a href="#sec-2">Validação de CPF</a></li>
                <li><a href="#sec-3">Formulário</a></li>
            </ul>
        </nav>

        <h2 id="sec-1">O que é Regex?</h2>
        
        <p>
            <strong>Regex</strong> ou ainda <strong>regexp</strong> são termos em inglês (abreviações de regular expression) cujo equivalente em português é <strong>expressão regular</strong>. Em computação, uma expressão regular é usada para identificar padrões em textos de maneira simples.
        </p>

        <p>
            Muitas linguagens de programação possuem seu próprio interpretador de expressões regulares, possuindo ainda funções próprias para avaliar uma dada variável de texto. Em PHP, por exemplo, a função <strong>preg_match()</strong> recebe como parâmetro duas variáveis, uma com o regex e outra com o texto a ser avaliado, retornando <strong>true</strong> caso o texto contenha o padrão informado ou <strong>false</strong> caso contrário.
        </p>

        <h2 id="sec-2">Validação de CPF</h2>

        <p>
            Um CPF (Cadastro de Pessoa Físia) é um documento com numeração de 11 (onze) dígitos fornecido a brasileiros pelo governo federal e tem função de identificar contribuintes. O CPF possui um padrão numérico composto por 3 números, um ponto, mais três números, outro ponto, mais três números, um hífen e finalmente mais dois números. Algo como: "XXX.XXX.XXX-XX".
        </p>

        <h2 id="sec-3">Formulário</h2>

        <p>
            Utilize o formulário abaixo para testar se seu CPF é válido, isto é, se ele segue o padrão.
        </p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <fieldset>
                <legend>Formulário</legend>

                <label>
                    CPF:
                    <input type="text" name="cpf" value="<?php echo (isset($cpf)) ? $cpf : '' ?>">
                    <input type="submit" name="submit" value="Testar CPF">
                </label>

                <span class="<?php echo ($valid) ? 'success' : 'error'; ?>-msg"><?php echo $message; ?></span>

            </fieldset>
        </form>
    </div>

    <footer>
        <div>Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/"              title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"              title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
        <p>Copyright © 2019 - Ivan Filho</p>
    </footer>
</body>
</html>