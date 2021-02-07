@extends('master')
@section('title_pag', 'Dashboard')
@section('content')

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                </div>
                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                </div>
            </div>


            <div id='script-warning'>
                <code>ics/feed.ics</code> must be servable
            </div>

            <div id='loading'>loading...</div>

            <div id='calendar'></div>


            <div class="modal" id="modal-add" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionando dados na agenda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('dashboard.new.event')}}" id="addEvent" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEvent" class="col-sm-2 col-form-label">Nome do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="staticEvent" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputColor" class="col-sm-2 col-form-label">Cor do evento</label>
                                    <div class="col-sm-10">
                                        <input type="color" class="form-control" id="inputColor" name="color">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputStart" class="col-sm-2 col-form-label">Data inicial do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputStart" name="start" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEnd" class="col-sm-2 col-form-label">Data final do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEnd" name="end" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" form="addEvent" class="btn btn-success">Cadastrar Dados</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-delete">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('dashboard.update.event')}}" id="updateEvent" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" id="inputID">
                                <div class="form-group row">
                                    <label for="staticEvent" class="col-sm-2 col-form-label">Nome do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="staticEvent" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputColor" class="col-sm-2 col-form-label">Cor do evento</label>
                                    <div class="col-sm-10">
                                        <input type="color" class="form-control" id="inputColor" name="color">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputStart" class="col-sm-2 col-form-label">Data inicial do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputStart" name="start" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEnd" class="col-sm-2 col-form-label">Data final do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEnd" name="end" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('dashboard.delete.event')}}" id="deleteButton" method="post">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="id" id="inputID">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" form="deleteButton" data-bs-dismiss="modal">Deletar</button>
                            <button type="submit" class="btn btn-success" form="updateEvent">Salvar Aterações</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>



<script>
    function DataHora(evento, objeto) {
        var keypress = (window.event) ? event.keyCode : evento.which;
        campo = eval(objeto);
        if (campo.value == '00/00/0000 00:00:00') {
            campo.value = ""
        }

        caracteres = '0123456789';
        separacao1 = '/';
        separacao2 = ' ';
        separacao3 = ':';
        conjunto1 = 2;
        conjunto2 = 5;
        conjunto3 = 10;
        conjunto4 = 13;
        conjunto5 = 16;
        if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
            if (campo.value.length == conjunto1)
                campo.value = campo.value + separacao1;
            else if (campo.value.length == conjunto2)
                campo.value = campo.value + separacao1;
            else if (campo.value.length == conjunto3)
                campo.value = campo.value + separacao2;
            else if (campo.value.length == conjunto4)
                campo.value = campo.value + separacao3;
            else if (campo.value.length == conjunto5)
                campo.value = campo.value + separacao3;
        } else
            event.returnValue = false;
    }
</script>
@stop