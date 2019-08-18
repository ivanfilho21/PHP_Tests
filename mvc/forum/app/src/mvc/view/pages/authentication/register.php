<section class="container-narrow">
    <div class="container">
        <h1>Criar Conta</h1>

        <form method="post">
            <!-- <label class="rf">Nome Completo</label>
            <div class="input-wrapper">
                <input type="text" name="name">
            </div> -->

            <!-- <div class="input-wrapper">
                <span class="info-icon" data-info="birthday" onmouseover="showInfoMessage.call(this)"><i class="fa fa-question-circle"></i></span>
                <label class="rf">Data de Aniversário</label>
            </div>
            <div class="input-wrapper">
                <select name="birthday">
                    <option value="0">Dia</option>
                </select>
                <select name="birthmonth">
                    <option value="0">Mês</option>
                </select>
                <select name="birthyear">
                    <option value="0">Ano</option>
                </select>
            </div> -->

            <?php showErrorMessages() ?>

            <div class="input-wrapper">
                <label class="rf">Nome de Usuário</label>
                <span class="info-icon" data-info="username" onmouseover="showInfoMessage.call(this)"><i class="fa fa-info-circle"></i></span>
            </div>
            <div class="input-wrapper">
                <input type="text" name="username" maxlength="12" autofocus="on" value="<?= (isset($_POST["username"])) ? $_POST["username"] : "" ?>">
            </div>

            <label class="rf">E-mail</label>
            <div class="input-wrapper">
                <input type="text" name="email" maxlength="100" value="<?= (isset($_POST["email"])) ? $_POST["email"] : "" ?>">
            </div>

            <div class="input-wrapper">
                <label class="rf">Senha</label>
                <span class="info-icon" data-info="password" onmouseover="showInfoMessage.call(this)"><i class="fa fa-info-circle"></i></span>
            </div>
            <div class="input-wrapper">
                <input type="password" name="password">
            </div>

            <label class="rf">Repita a Senha</label>
            <div class="input-wrapper">
                <input type="password" name="password2">
            </div>

            <p class="container legal-warning">
                Ao se cadastrar, você estará concordando com nossos <a href="#" title="Termos de Serviço">Termos de Serviço</a> e com nossa <a href="#" title="Política de Privacidade">Política de Privacidade</a>.
            </p>

            <input class="btn btn-default" type="submit" name="submit" value="Cadastrar">
            
            <script>const URL = "<?= URL ?>";</script>
            <script>
                /*function initBirthday() {
                    let monthsList = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
                    let today = new Date();
                    let days = document.forms[0].birthday;
                    let months = document.forms[0].birthmonth;
                    let years = document.forms[0].birthyear;

                    let maxDays = new Date(today.getUTCFullYear(), today.getUTCMonth(), 0).getDate();
                    for (let i = 1; i <= maxDays; i++) {
                        days.innerHTML += "<option value='" + i + "' " + (i == today.getDate() ? "selected" : "") + ">" + i + "</option>";
                    }
                    for (let i = 0; i < monthsList.length; i++) {
                        months.innerHTML += "<option value='" + i + "' " + (i == today.getUTCMonth() ? "selected" : "") + ">" + monthsList[i] + "</option>";
                    }
                    for (let i = today.getUTCFullYear(); i >= 1905; i--) {
                        years.innerHTML += "<option value='" + i + "' " + (i == today.getUTCFullYear() ? "selected" : "") + ">" + i + "</option>";
                    }
                }*/

                function showInfoMessage() {
                    if (! this) return;

                    let icon = this;
                    let parent = icon.parentNode;

                    let type = icon.getAttribute("data-info");
                    switch(type) {
                        case "username":
                            res = "<b>Nome de Usuário:</b><ul class='ul ul-circle'><li>De 6 a 12 caracteres.</li><li>Não incluir caracteres epeciais.</li></ul>";
                            break;
                        case "password":
                            res = "<b>Senha:</b><ul class='ul ul-circle'><li>No mínimo 6 caracteres.</li></ul>";
                            break;
                        default:
                            res = "";
                    }

                    let msg = parent.getElementsByClassName("info-msg")[0];
                    
                    if (res == "0" || res == "1") {
                        if (typeof msg != typeof undefined) msg.remove();
                        return;
                    }

                    msg = (typeof msg != typeof undefined) ? msg : document.createElement("span");
                    msg.setAttribute("class", "info-msg");
                    msg.innerHTML = res;

                    // CLONE
                    let clone = document.createElement("span");
                    clone.innerHTML = res;
                    clone.style.position = "absolute";
                    clone.style.visibility = "hidden";
                    clone.style.opacity = "0";
                    document.body.appendChild(clone);

                    let msgWidth = clone.offsetWidth;
                    let msgHeight = clone.offsetHeight;
                    let msgMargin = 26;
                    let msgLeft = icon.offsetLeft + icon.offsetWidth + msgMargin;
                    let msgRight = icon.offsetLeft + icon.offsetWidth - msgMargin - msgWidth;
                    let msgTop = icon.offsetTop - icon.offsetHeight - msgMargin/2 - msgHeight;
                    let msgBottom = icon.offsetTop + icon.offsetHeight + msgMargin;

                    document.body.removeChild(clone);

                    msg.style.top = msgTop + "px";
                    msg.style.left = icon.offsetLeft + "px";
                    
                    parent.appendChild(msg);
                }
            </script>
        </form>
    </div>
</section>