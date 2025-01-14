jQuery(function($) {
    $('form#formUser').validate({
        errorPlacement: function(error, element) { },
        rules: {
            name: 'required',
            username: 'required',
            email: {
                required: true,
                email: true
            }
        }
    });

    $('form#formRole').validate({
        errorPlacement: function(error, element) { },
        rules: {
            name: 'required',
            display_name: 'required',
            description: 'required'
        }
    });

    $('form#formPermission').validate({
        errorPlacement: function(error, element) { },
        rules: {
            name: 'required',
            display_name: 'required',
            description: 'required'
        }
    });

    $('form#formEmpresa').validate({
        errorPlacement: function(error, element) { },
        rules: {
            nome: 'required',
            apelido: 'required',
            cep: 'required',
            rua: 'required',
            numero: 'required',
            bairro: 'required',
            cidade: 'required',
            estado: 'required',
            cnpj: 'required',
            telefone: 'required',
            email: {
                required: true,
                email: true
            },
            email_nfe: {
                required: true,
                email: true
            }
        }
    });

    $('form#formOrcamento').validate({
        errorPlacement: function(error, element) { },
        rules: {
            cliente: 'required',
        }
    });

    $('form#formOrdemCompra').validate({
        errorPlacement: function(error, element) { },
        rules: {
            para: 'required',
            onde_comprar: 'required'
        }
    });

    $('form#formPassword').validate({
        errorPlacement: function(error, element) { },
        rules: {
            password: "required",
            confirm_password: {
                required : true,
                equalTo: "#password"
            }
        }
    });
});