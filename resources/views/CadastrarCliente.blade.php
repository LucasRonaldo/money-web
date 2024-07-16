<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <div class="box">
        <div class="img-box">
        </div>
        <div class="form-box">
            <h2>Criar Conta</h2>
            <p> CLIENTE</p>
            <form id="cadastrarClienteForm" method="POST">
                @csrf
                <div class="input-group">
                    <label for="nome"> Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o seu nome completo" required>
                    <div id="nome-error" class="error-message"></div>
                </div>

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                    <div id="email-error" class="error-message"></div>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="number" id="cpf" name="cpf" placeholder="Digite o seu CPF" required>
                    <div id="cpf-error" class="error-message"></div>
                </div>

                <div class="input-group w50">
                    <label for="password">Senha</label>
                    <input type="password" id="senha" name="password" placeholder="Digite sua senha" required>
                    <div id="password-error" class="error-message"></div>
                </div>

                <div class="input-group w50">
                    <label for="Confirmarsenha">Confirmar Senha</label>
                    <input type="password" id="Confirmarsenha" name="password_confirmation" placeholder="Confirme a senha" >
                    <div id="Confirmarsenha-error" class="error-message"></div>
                </div>

                <div class="input-group">
                    <button type="submit">Cadastrar</button>
                </div>

            </form>
        </div>
    </div>

     <script>
        document.getElementById('cadastrarClienteForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            let form = this;

            // Limpar mensagens de erro anteriores
            clearErrors();

            fetch("{{ route('CadastrarCliente') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errors => { throw errors; });
                }
                return response.json();
            })
            .then(data => {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: data.title,
                        text: data.message
                    });
                    form.reset(); // Limpar o formulário após sucesso
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.title,
                        text: data.message
                    });
                }
            })
            .catch(errors => {
                displayErrors(errors.errors);
            });
        });

        function clearErrors() {
            document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
            document.querySelectorAll('.error-message').forEach(el => el.innerText = '');
        }

        function displayErrors(errors) {
            for (let key in errors) {
                if (errors.hasOwnProperty(key)) {
                    let input = document.querySelector(`[name="${key}"]`);
                    let errorDiv = document.getElementById(`${key}-error`);

                    if (input) {
                        input.classList.add('error');
                    }

                    if (errorDiv) {
                        errorDiv.innerText = errors[key][0];
                    }
                }
            }
        }
    </script>
</body>
</html>
