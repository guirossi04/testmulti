<?php
include("header.php");
include("menu.php");
require_once("DataRequest.php");
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        Widget settings form goes here
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn blue">Save changes</button>
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Dashboard <small>tudo que você precisa à um click.</small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="pull-right">
                        <div id="dashboard-report-range" class="dashboard-date-range tooltips" data-placement="top" data-original-title="Change dashboard date range">
                            <i class="fa fa-calendar"></i>
                            <span>
                            </span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            1349
                        </div>
                        <div class="desc">
                            Clientes
                        </div>
                    </div>
                    <a class="more" href="#">
                        Visualizar <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            549
                        </div>
                        <div class="desc">
                            Usuários
                        </div>
                    </div>
                    <a class="more" href="#">
                        Visualizar <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            89
                        </div>
                        <div class="desc">
                            Fornecedores
                        </div>
                    </div>
                    <a class="more" href="#">
                        Visualizar <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- END DASHBOARD STATS -->
        <div class="clearfix">
        </div>
        <!--Tabela-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box grey" id="tabela">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-folder-open"></i>Tabela Simples
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                            <a href="#portlet-config" data-toggle="modal" class="config"></a>
                            <a href="javascript:;" class="reload"></a>
                            <a href="javascript:;" class="remove"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tabela-simples">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Nome
                                        </th>
                                        <th>
                                            cpf
                                        </th>
                                        <th>
                                            endereco
                                        </th>
                                        <th>
                                            telefone
                                        </th>
                                        <th>
                                            email
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<script>
    document.querySelectorAll('.dashboard-stat .more').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            let cont = 1;
            var statDiv = this.closest('.dashboard-stat');
            var cor = Array.from(statDiv.classList).find(function(cls) {
                return cls !== 'dashboard-stat';
            });
            var cores = ['blue', 'green', 'purple', 'grey'];
            var tabela = document.getElementById('tabela');
            const classes = Array.from(statDiv.classList);

            let tipo = '';
            if (classes.includes('blue')) tipo = 'clientes';
            if (classes.includes('green')) tipo = 'usuarios';
            if (classes.includes('purple')) tipo = 'fornecedores';

            fetch('DataRequest.php?tipo=' + tipo)
                .then(response => response.json())
                .then(dados => {
                    const tbody = document.querySelector('#tabela-simples tbody');
                    tbody.innerHTML = '';

                    if (dados.erro) {
                        tbody.innerHTML = `<tr><td colspan="3">${dados.erro}</td></tr>`;
                        return;
                    }

                    cores.forEach(function(c) {
                        tabela.classList.remove(c);
                    });

                    if (cores.includes(cor)) {
                        tabela.classList.add(cor);
                    }

                    dados.forEach(item => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>${cont}</td>
                        <td>${item.nome ?? 'N/A'}</td>
                        <td>${item.cpf ?? 'N/A'}</td>
                        <td>${item.endereco ?? 'N/A'}</td>
                        <td>${item.telefone ?? 'N/A'}</td>
                        <td>${item.email ?? 'N/A'}</td>
                    `;
                        tbody.appendChild(tr);
                        cont++;
                    });
                })
                .catch(error => {
                    console.error('Erro ao carregar dados:', error);
                });
        });
    });
</script>
<?php
include("footer.php");
?>