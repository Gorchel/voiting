<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Конкурс жиротопка</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="/assets/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet">
        <link href="/assets/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="/css/animate.min.css" type="text/css" rel="stylesheet">
        <link href="/css/normalize.min.css" type="text/css" rel="stylesheet">
        <link href="/css/styles.css" type="text/css" rel="stylesheet">
        <link href="/css/flipclock.css" type="text/css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" type="text/css" rel="stylesheet">
        <link href="/css/app.css" type="text/css" rel="stylesheet">

        @section('css')
        
        @show
    </head>
    <body>
       <div class="container-fluid">
            <div class="row">
                <div class="header-nav-wrapper">
                    <div class="logo">
                        <img src="img/fav.gif" alt="">
                        <h3><b>Б</b>еговая <b>Ж</b>иротопка</h3>
                    </div>
                    <div class="primary-nav-wrapper">
                        <nav>
                            <ul class="primary-nav">
                                <li><a href="#team">Участники</a></li>
                            </ul>
                        </nav>
                        <div class="secondary-nav-wrapper">
                            <ul class="secondary-nav">
                                <li class="subscribe">
                                    @if (!empty($user))
                                        <a href="/logout">Выйти</a>
                                    @else
                                        <a href="#" class="registration">Зарегистрироваться</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- SECTION: Intro -->
        <header>
            <div class="container">
                <h1 class="text-center">Розыгрыш главных призов проекта <b>"БЖ"</b></h1>
                <h3 class="text-center">До конца розыгрыша осталось</h3>
                <table id="clock-table">
                    <tr id="clock-number">
                        <td id="day">
                        </td>
                        <td id="hour">
                        </td>
                        <td id="minute">
                        </td>
                    </tr>
                    <tr id="clock-text">
                        <td>Дней</td>
                        <td>Часов</td>
                        <td>Минут</td>
                    </tr>
                </table>
            </div>
        </header>
        <!-- END SECTION: Intro -->
        <!-- SECTION: Crew -->
        <section class="crew has-padding" id="team">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Участники</h4>
                    </div>
                </div>
                <div class="row text-center">
                    <ul id="сontestants-tab" class="nav nav-tabs">
                      <li class="active"><a href="#men" data-toggle="tab">Мужчины</a></li>
                      <li class=""><a href="#woman" data-toggle="tab">Женщины</a></li>
                    </ul>
                </div>
                <div id="сontestants-content" class="tab-content">
                    <div class="tab-pane fade active in" id="men">
                        <div class="row">
                            @forelse( $сontestants[1] as $сontestant ) 
                                <div class="col-md-3 col-sm-6 col-xs-12 crew-container">
                                    <article class="crew-member text-center {{!empty($user) ? (count($user->сontestants) == 0) && !empty($user->activated) ? 'voite' : '' : 'registration'}}" data-id="{{ $сontestant->id }}" style="background-image: url({{ 'img/'.$сontestant->file_path }})">

                                        @if(empty($user))
                                            <!-- <span class="crew-btn">Зарегистрироваться</span> -->
                                        @elseif(count($user->сontestants) == 0 && !empty($user->activated))
                                            <span class="crew-btn">Проголосовать</span>
                                        @endif
                                        <figure>
                                            <figcaption class="overlay">
                                                <h2>{{$сontestant->first_name.' '.$сontestant->last_name}}</h2>
                                                @if(empty($user))
                                                    <p class="overlay-check">Зарегистрироваться</p>
                                                @elseif(count($user->сontestants) == 0 && !empty($user->activated))
                                                    <p class="overlay-check">Проголосовать</p>
                                                @endif
                                            </figcaption>
                                        </figure>
                                    </article>
                                    <p class="vote-conter stats-number text-center" data-stop="{{ $сontestant->voite_count }}">{{ $сontestant->voite_count }}</p>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="woman">
                        <div class="row">
                            @forelse( $сontestants[0] as $сontestant ) 
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <article class="crew-member {{!empty($user) ? (count($user->сontestants) == 0) && !empty($user->activated) ? 'voite' : '' : 'registration'}}" data-id="{{ $сontestant->id }}" style="background-image: url({{ 'img/'.$сontestant->file_path }})">
                                        @if(empty($user))
                                            <!-- <span class="crew-btn">Зарегистрироваться</span> -->
                                        @elseif(count($user->сontestants) == 0 && !empty($user->activated))
                                            <span class="crew-btn">Проголосовать</span>
                                        @endif
                                        <figure>
                                            <figcaption class="overlay">
                                                <h2>{{$сontestant->first_name.' '.$сontestant->last_name}}</h2>
                                                @if(empty($user))
                                                    <p class="overlay-check">Зарегистрироваться</p>
                                                @elseif(count($user->сontestants) == 0 && !empty($user->activated))
                                                    <p class="overlay-check">Проголосовать</p>
                                                @endif
                                            </figcaption>
                                        </figure>
                                    </article>
                                    <p class="vote-conter stats-number text-center" data-stop="{{ $сontestant->voite_count }}">{{ $сontestant->voite_count }}</p>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
      
        <footer class="has-padding footer-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-branding">
                        <a href="#">Публичная Оферта</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 footer-nav">
                        <ul class="footer-secondary-nav">
                            <li>ИП Санджиева Фаина Санджаевна</li>
                            <li>ОГРНИП 315081600010093</li>
                            <li> ИНН 081410033690</li>
                            <li>127473, г. Москва, 1-ый Щемиловский пер., д. 17</li>
                            <li>admin@беговаяжиротопка.рф</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <div class="modal fade" id="registration-modal">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="/register" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Регистрация</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="Введите email" required="required">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" class="form-control" placeholder="Введите пароль" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn registration-btn" value="Зарегестрироваться">
                    </div>
                </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/retina.min.js"></script>
        <script type="text/javascript" src="js/jquery.waypoints.min.js"></script> 
        <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>  
        
        <!-- <script type="text/javascript" src="js/scripts-min.js"></script>  -->
        <script type="text/javascript" src="/js/app.js?2123"></script> 

    
        @section('js')
            
        @show

        
    </body>
</html>
