jQuery(function($) {

    /**
     * This method ajax and return data into target.
     * @param url
     * @param index
     * @param target
     */
    function showAction(url, target)
    {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data){
                target.html(data);
                showTotal();
            }
        });
    }

    if (currentRoute == 'orcamentos.edit') {
        showAction('/servicos/show', $('.servico_tbody'));
        showAction('/produtos/show', $('.produto_tbody'));
    }

    if (currentRoute == 'ordens-compra.edit') {
        showAction('/itens/show', $('.itens_tbody'));
    }

    /**
     * This method ajax and return data into a modal
     * @param url
     */
    function createAction(url)
    {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data){
                $('#modal').html(data);
                setTimeout(function() {
                    $('#modal .focus').focus()
                }, 100);
            }
        });
    }

    /**
     * This method ajax and return data into a modal
     * @param url
     * @param index
     */
    function editAction(url, index)
    {
        $.ajax({
            url: url,
            type: 'GET',
            data: { index : index },
            success: function(data){
                $('#modal').html(data);
                setTimeout(function() {
                    $('#modal .focus').focus()
                }, 100);
            }
        });
    }

    /**
     * This method ajax and return data into target.
     * @param url
     * @param index
     * @param target
     */
    function destroyAction(url, index, target)
    {
        $.ajax({
            url: url,
            type: 'GET',
            data: { index : index },
            success: function(data){
                target.html(data);
                showTotal();
            }
        });
    }

    /**
     * This method ajax and return data into target and execute a method showTotals
     * @param url
     * @param fields
     * @param target
     * @param close
     * @param form
     */
    function saveAction(url, fields, target, close, form)
    {
        var values = {};
        $.each(fields, function (i, field) {
            values[field.name] = field.value;
        });

        values = JSON.stringify(values);

        $.ajax({
            type: "GET",
            dataType: "html",
            url: url,
            data: {
                values : values
            },
            success: function (data) {
                target.html(data);
                showTotal();

                if (close) {
                    $('#modal').modal('hide');
                } else {
                    form[0].reset();
                    setTimeout(function() {
                        $('#modal .focus').focus()
                    }, 100);
                }
            }
        });
    }

    /**
     * This method ajax and return data into target.
     * @param url
     * @param indexes
     * @param target
     */
    function orderAction(url, indexes, target)
    {
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                indexes : indexes
            },
            success: function(data){
                target.html(data);
                showTotal();
            }
        });
    }

    /**
     * This method ajax and return data into $('#totalOrcamento').
     */
    function showTotal()
    {
        console.log(currentRoute);
        if (currentRoute == 'orcamentos.edit' || currentRoute == 'orcamentos.create') {
            $.ajax({
                url: '/orcamentos/total',
                type: 'GET',
                success: function (data) {
                    $('#totalOrcamento').html(data);
                }
            });
        }
    }

    /**
     * This method ajax and show in modal a form
     *
     * @param url
     * @param id
     */
    function emailAction(url, id)
    {
        $.ajax({
            url: url,
            type: 'GET',
            data: { id : id },
            success: function(data){
                $('#modal').html(data);
                setTimeout(function() {
                    $('#modal .focus').focus()
                }, 100);
            }
        });
    }

    function sendAction(url, fields)
    {
        var values = {};
        $.each(fields, function (i, field) {
            values[field.name] = field.value;
        });

        values = JSON.stringify(values);

        $.ajax({
            type: "GET",
            dataType: "html",
            url: url,
            data: {
                values : values
            },
            success: function (data) {
                $('#modal').modal('hide');
            } 
        });
    }

    /**
     * Modal Actions
     */
    $(document).on('click', '.action[data-action]', function(e) {
        var action = $(this).attr('data-action');
        if (action == 'createServico') {
            createAction('/servicos/create');
        } else if (action == 'editServico') {
            editAction('/servicos/edit', $(this).attr('data-id'));
        } else if (action == 'destroyServico') {
            destroyAction('/servicos/destroy', $(this).attr('data-id'), $('.servico_tbody'));
        } else if (action == 'createProduto') {
            createAction('/produtos/create');
        } else if (action == 'editProduto') {
            editAction('/produtos/edit', $(this).attr('data-id'));
        } else if (action == 'destroyProduto') {
            destroyAction('/produtos/destroy', $(this).attr('data-id'), $('.produto_tbody'));
        } else if (action == 'emailOrcamento') {
            emailAction('/orcamentos/email', $(this).attr('data-id'));
        } else if (action == 'createItem') {
            createAction('/itens/create');
        } else if (action == 'editItem') {
            editAction('/itens/edit', $(this).attr('data-id'));
        } else if (action == 'destroyItem') {
            destroyAction('/itens/destroy', $(this).attr('data-id'), $('.itens_tbody'));
        }

        e.preventDefault();
    });

    $('.dd').nestable({
        callback: function(l, e){
            var indexes = [];
            l.find('.dd-list').find('.dd-item').each(function() {
                indexes.push($(this).attr('data-id'));
            });

            var list = l.attr('data-list');
            orderAction('/' + list + '/order', indexes, l.find('tbody'));
        }
    });

    /**
     * Create and Edit FormServico
     */
    $(document).on('submit', 'form#formServico', function(e) {
        var index = $(this).find('input[name=index]').val();
        var fields = $(this).serializeArray();
        var close = $('input[type=submit][clicked=true]').attr('data-close');
        var target = $('.servico_tbody');
        var form = $('form#formServico');

        if (index != '') {
            saveAction('/servicos/update', fields, target, close, form);
        } else {
            saveAction('/servicos/store', fields, target, close, form);
        }
        e.preventDefault();
    });

    /**
     * Create and Edit FormProduto
     */
    $(document).on('submit', 'form#formProduto', function(e) {
        var index = $(this).find('input[name=index]').val();
        var fields = $(this).serializeArray();
        var close = $('input[type=submit][clicked=true]').attr('data-close');
        var target = $('.produto_tbody');
        var form = $('form#formProduto');

        if (index != '') {
            saveAction('/produtos/update', fields, target, close, form);
        } else {
            saveAction('/produtos/store', fields, target, close, form);
        }
        e.preventDefault();
    });

    /**
     * Create and Edit FormItem
     */
    $(document).on('submit', 'form#formItem', function(e) {
        var index = $(this).find('input[name=index]').val();
        var fields = $(this).serializeArray();
        var close = $('input[type=submit][clicked=true]').attr('data-close');
        var target = $('.itens_tbody');
        var form = $('form#formItem');

        if (index != '') {
            saveAction('/itens/update', fields, target, close, form);
        } else {
            saveAction('/itens/store', fields, target, close, form);
        }
        e.preventDefault();
    });

    /**
     * Submited Button Clicked
     */
    $(document).on('click', 'form input[type=submit]', function(e) {
        $('input[type=submit]', $(this).parents('form')).removeAttr('clicked');
        $(this).attr('clicked', 'true');
    });


    /**
     * Form Email Orcamento AJAX
     */
    $(document).on('submit', 'form#formEmailOrcamento', function(e) {
        var id = $(this).find('input[name=id]').val();
        var fields = $(this).serializeArray(); 

        sendAction('/orcamentos/send', fields);

        e.preventDefault();
    });

    /**
     * Ajax to toggle orçamento detail
     */
    $(document).on('click', '.openDetalhe', function(e) {
        var detalhe = $(this).parent('td').parent('tr').next('tr.detalhe');
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');

        if (!detalhe.hasClass('loaded')) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    detalhe.html(data);
                    detalhe.addClass('loaded');
                }
            });
        }
        detalhe.toggle();

        e.preventDefault();
    });

});