@extends('home')
@section('title_pag', 'register')
@section('content')


<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1>NoteCalendar Login</h1>
                    <form role="form" action="{{route('register.new.user')}}" method="post" id="login-form" autocomplete="off">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name" class="sr-only">Nome</label>
                            <input type="text" name="name" id="name" class="form-control {{($errors->has('name')) ? 'is-invalid' : ''}}" placeholder="Informe seu nome">
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control {{($errors->has('email')) ? 'is-invalid' : ''}}" placeholder="Informe seu e-mail">
                            <div class="invalid-feedback">
                                {{$errors->first('email')}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control {{($errors->has('password')) ? 'is-invalid' : ''}}" placeholder="Informe sua senha">
                            <div class="invalid-feedback">
                                {{$errors->first('password')}}
                            </div>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Registrar">
                    </form>

                    <hr>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Página © - 2021</p>
                <p>Feito por <strong><a href="https://github.com/LucasEduardo122" target="_blank">LucasEduardo122</a></strong></p>
            </div>
        </div>
    </div>
</footer>

@stop