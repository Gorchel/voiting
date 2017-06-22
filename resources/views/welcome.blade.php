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
                        <a data-toggle="modal" data-target="#oferta-modal">Публичная Оферта</a>
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

        <div class="modal fade" id="oferta-modal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Публичная оферта</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <h3>ОФЕРТА</h3>
                        <h3>КОНКУРС «БЕГОВАЯ ЖИРОТОПКА»</h3>
                        <h3>ТЕРМИНЫ И ОПРЕДЕЛЕНИЯ</h3>
                        <h4>Конкурс:</h4>
                        <p>открытый публичный конкурс под названием «БЕГОВАЯ ЖИРОТОПКА» между Участниками, представляющий собой выполнение заданий, разработанных специально для Конкурса, по результатамв процессе выполнения которых будут подводиться итоги Конкурса и определяться победители. Конкурс направлен на распространение идей здорового образа жизни и занятия спортом.</p>
                        <h4>Организатор:</h4>
                        <p>Индивидуальный предприниматель Санджиева Фаина Санджаевна, ОГРНИП 315081600010093, ИНН 081410033690.</p>
                        <h4>Официальный сайт Конкурса:</h4>
                        <p><a href="http://беговаяжиротопка.рф">http://беговаяжиротопка.рф</a></p>
                        <h4>Группа Конкурса в социальной сети ВКонтакте</h4>
                        <p>Официальная Группа Конкурса в социальной сети ВКонтакте.</p>
                        <h4>Страница Конкурса в Instagram:</h4>
                        <p>Официальная страница Конкурса в социальной сети Instagram.</p>
                        <h4>Участник:</h4>
                        <p>Любое дееспособное физическое лицо, достигшее возраста 14 (Четырнадцать) лет и не имеющее медицинских и иных противопоказаний для участия в Конкурсе.</p>
                        <h4>Победитель:</h4>
                        <p>Участник, признанный победителем в соответствии с условиями его проведения, предусмотренными настоящей Офертой.</p>
                        <h4>Оферта:</h4>
                        <p>предложение Организатора заключить договор на участие в Конкурсе на указанных в настоящей Оферте условиях с любым физическим лицом, отвечающим критериям Участника.</p>
                        <h4>Акцепт Оферты:</h4>
                        <p>совершение любым физическим лицом, отвечающим критериям Участника, в срок, установленный для ее акцепта, действий, указанных в п. 3 настоящей Оферты.</p>
                        <h4>Договор:</h4>
                        <p>соглашение между Организатором и Участником на участие в Конкурсе, заключаемое путем акцепта Оферты.</p>
                        <h4>Начало Конкурса:</h4>
                        <p>Каждое воскресенье в 00:00 начиная с 00:00 14 мая 2017 года</p>
                        <h4>Продолжительность Конкурса</h4>
                        <p>4 (Четыре) календарные недели с Начала Конкурса</p>
                        <h4>Окончание Конкурса</h4>
                        <p>Каждую субботу с учетом Продолжительности Конкурса начиная с 23:59 10 июня 2017 года</p>
                        <h4>Дата и время розыгрыша денежных призов от автора проекта</h4>
                        <p>Каждое воскресенье в 21:00 начиная с 14 мая 2017 года</p>
                        <ul>
                            <li>Ссылки на пункты и приложения являются ссылками на пункты настоящей Оферты и приложения к ней.</li>
                            <li>Заголовки созданы исключительно для удобства и должны игнорироваться при толковании настоящей Оферты.</li>
                        </ul>
                    </div>
                    <div>
                        <h3>ПРЕДМЕТ ОФЕРТЫ</h3>
                        <ul>
                            <li>С момента Акцепта Оферты Участник считается заключившим Договор с Организатором.</li>
                            <li>Организатор обязуется в соответствии с заключенным Договором выдать награду Победителю, а Участник своевременно выполнять условия участия в Конкурсе, предусмотренные настоящей Офертой.</li>
                        </ul>
                        <h3>АКЦЕПТ ОФЕРТЫ</h3>
                        <p>Для Акцепта Оферты Участник обязан зарегистрироваться на официальном сайте Конкурса, выбрать пакет участия, оплатить участие в Конкурсе любым способом, указанным на официальном сайте Конкурса, а также выполнить действия, указанные в инструкции согласно п. 3.2 настоящей Оферты;</p>
                        <p>Организатор направляет на электронный ящик Участника подтверждение оплаты и инструкцию о действиях, которые необходимо выполнить для участия в Конкурсе:</p>
                        <ul>
                            <li>заполнить и отправить Организатору анкету. Все данные, указанные в анкете, должны строго соответствовать официальным документам, удостоверяющим личность Участника;</li>
                            <li>зарегистрироваться в социальной сети ВКонтакте и вступить в группу Конкурса в социальной сети ВКонтакте;</li>
                            <li>установить на свой телефон любое приложение-трекер, способное измерять время, скорость и дистанцию беговых тренировок; а также</li>
                            <li>выполнить иные действия, указанные в инструкции.</li>
                        </ul>
                        <p>Оферта считается акцептованной Участником только при условии выполнения всех действий, указанных в п.п. 3.1 и 3.2 выше, до начала Конкурса.</p>
                        <h3>ЗАВЕРЕНИЯ УЧАСТНИКА</h3>
                        <p>Участник заверяет, что:</p>
                        <ul>
                            <li>предоставил достоверные и актуальные данные, существенные для заключения и исполнения Договора;</li>
                            <li>не имеет каких-либо медицинских и иных противопоказаний для занятий физической культурой и спортом и участия в Конкурсе;</li>
                            <li>принимает на себя полную ответственность и понимает риски за все возможные психические, физические и физиологические изменения, которые могут произойти с ним и с его организмом во время участия в Конкурсе.</li>
                            <li>перед выполнением каждого конкурсного задания адекватно оценивает свое самочувствие, имеет физическую возможность выполнять задания, соотносить риски их выполнения со своим самочувствием и нести такие риски;</li>
                            <li>является автором предоставляемой для участия в Конкурсе фотографии либо гарантирует, что использование фотографий в рамках Конкурса не нарушает прав других Участников или третьих лиц (в том числе авторских и смежных прав, а также прав на средства индивидуализации). Предоставляя свою фотографию на участие в Конкурсе, Участник дает свое согласие на использование своего изображения, а также безвозмездно передает все права на такую фотографию Организатору.</li>
                        </ul>
                        <h3>ПРАВА И ОБЯЗАННОСТИ СТОРОН ДОГОВОРА</h3>
                        <p>Организатор вправе:</p>
                        <ul>
                            <li>В одностороннем порядке изменить условия Конкурса и отменить Конкурс в любое время до начала Конкурса, о чем Участник оповещается путем публикации соответствующего уведомления на официальном сайте Конкурса и группе Конкурса в социальной сети, доступном для всех пользователей сети Интернет, и публикации соответствующей редакции Оферты. Изменения Оферты для ранее заключённых и действующих Договоров вступают в силу через 3 (три) дня со дня публикации соответствующих изменений (редакции) Оферты.</li>
                            <li>По своему усмотрению передавать свои права и обязанности по Договору, а также привлекать третьих лиц для выполнения своих обязательств по Договору.</li>
                            <li>Аннулировать признание Участника Победителем в случае обнаружения фальсификации таким Участником выполнения конкурсных заданий и/или результатов голосования.</li>
                        </ul>
                        <p>Организатор обязан:</p>
                        <ul>
                            <li>Своевременно предоставлять Участнику задания и проверять их выполнение;</li>
                            <li>Делать замечания и давать рекомендации Участнику по факту выполнения им задания;</li>
                            <li>Надлежащим образом выполнять все свои обязанности по Договору.</li>
                        </ul>
                        <p>Участник вправе:</p>
                        <ul>
                            <li>В любой момент отказаться от участия в Конкурсе, незамедлительно известив об этом Организатора. При этом денежные средства, уплаченные для участия в Конкурсе, не подлежат возврату Участнику.</li>
                        </ul>
                        <p>Участник обязан:</p>
                        <ul>
                            <li>Самостоятельно отслеживать изменения Оферты посредством ознакомления с действующей (актуальной) редакцией Оферты. Риск любых негативных последствий в связи с неознакомлением или несвоевременным ознакомлением с действующей редакцией Оферты, возлагается на Участника.</li>
                            <li>Надлежащим образом выполнять все представленные рекомендации и конкурсные задания.</li>
                            <li>Отчитываться о выполнении каждого конкурсного задания в соответствии с условиями Договора.</li>
                        </ul>
                        <h3>ПРАВИЛА УЧАСТИЯ В КОНКУРСЕ</h3>
                        <p>Срок проведения Конкурса – 5 (Пять) недель. Указанный срок включает в себя 4 (Четыре) недели на выполнение конкурсных заданий Участником и проверку выполненных заданий Организатором, а также 1 (Одну) неделю на определение Победителя путем голосования в группе Конкурса в социальной сети ВКонтакте.</p>
                        <p>Участнику запрещается:</p>
                        <ul>
                            <li>Множественная регистрация в Конкурсе одного пользователя под разными именами и/или аккаунтами и голосование от их имени.</li>
                            <li>Покупка голосов за деньги или иное вознаграждение.</li>
                            <li>Фальсификация выполнения конкурсных заданий.</li>
                            <li>Иные аналогичные способы влияния на результат голосования.</li>
                        </ul>
                        <p>Нарушение Участником любого запрета, указанного в п. 6.2 выше, влечет незамедлительное его исключение из Конкурса. При этом денежные средства, уплаченные для участия в Конкурсе, не подлежат возврату такому Участнику.</p>
                        <p>Организатор не отвечает за невозможность осуществления связи с Победителем из-за указания им неверных или неактуальных контактных сведений, ненадлежащей работы сетей и средств связи.</p>
                        <p>В случае аннулирования признания Участника Победителем в связи с фальсификацией им факта выполнения конкурсных заданий и/или результатов голосования Победителем объявляется следующий Участник, набравший наибольшее число голосов.</p>
                        <p>Конкурсные задания доводятся до сведения Участника путем публикации в группе Конкурса в социальной сети ВКонтакте.</p>
                        <p>Конкурсные задания делятся на 2 (Два) вида: обязательные и необязательные. В случае невыполнения Участником обязательного задания такой Участник исключается из Конкурса. Выполнение необязательных заданий дает Участнику возможность принимать участие в еженедельных розыгрышах денежных призов от автора проекта.</p>
                        <p>Участник обязан отчитаться о выполнении задания путем публикации фото и/или видео в комментариях к своей фотографии в группе Конкурса в социальной сети ВКонтакте. Участник обязан опубликовать отчет до 22 часов 59 минут дня, в котором должно было быть выполнено задание, либо в другое время, если это указано в задании.</p>
                        <p>Организатор проверяет выполнение задания до публикации следующего задания. В случае если Организатор выявит, что обязательное задание Участником не выполнено или выполнено ненадлежащим образом, то такой Участник подлежит немедленному исключению из Конкурса путем удаления из группы Конкурса в социальной сети ВКонтакте. Денежные средства, уплаченные для участия в Конкурсе, не подлежат возврату такому Участнику.</p>
                        <p>Победитель определяется путем открытого голосования в группе Конкурса в социальной сети ВКонтакте, либо иным образом, о чем Организатор уведомит Участников не позднее дня окончания заданий.</p>
                        <p>Победителем становится Участник, набравший наибольшее количество голосов.</p>
                    </div>
                    <div>
                        <p>В течение 1-го сезона проекта будут разыгрываться дополнительно 4 приза (Денежные призы от автора проекта) по результатам случайного определения победителя. Для того чтобы принять участие в таком розыгрыше Участнику необходимо:</p>
                        <ul>
                            <li>загружать на свою страницу в социальной сети Instagram фото- или видеоотчеты по выполнению обязательных и необязательных заданий;</li>
                            <li>быть действующим Участником Конкурса на момент проведения розыгрыша (каждое воскресенье в течение Конкурса);</li>
                            <li>быть подписчиком на официальную страницу Конкурса в Instagram;</li>
                            <li>иметь открытый профиль в Instagram; </li>
                            <li>оставлять в подписи определенные хэштеги, на основании которых будет проводиться случайное определение победителя, а также следовать другим инструкциям, информация о которых будет публиковаться в группе Конкурса.</li>
                        </ul>
                        <p>Организатор обязуется опубликовать результаты Конкурса и имена Победителей незамедлительно по окончании Конкурса на официальном сайте Конкурса и в группе Конкурса в социальной сети ВКонтакте.</p>
                    </div>
                    <div>
                        <h3>ПЕРСОНАЛЬНЫЕ ДАННЫЕ</h3>
                        <p>Организатор обязуется не распространять третьим лицам персональные данные Участника.</p>
                        <p>После прекращения участия в Конкурсе Участника Организатор вправе по своему усмотрению, а также на основании письменного требования Участника удалить со всех своих информационных носителей все персональные данные Участника.</p>
                        <p>Участник дает Организатору свое согласие на неограниченные сроками хранение и обработку своих персональных данных.</p>
                        <p>Организатор вправе хранить и обрабатывать персональные данные Участника, в том числе в статистических и маркетинговых целях, а также для рекламного информирования Участника.</p>
                    </div>
                    <div>
                        <h3>ОБСТОЯТЕЛЬСТВА НЕПРЕОДОЛИМОЙ СИЛЫ</h3>
                        <p>Организатор и Участник не несут ответственность за частичное или полное неисполнение своих обязательств по Договору по причине обстоятельств непреодолимой силы.</p>
                        <p>Под обстоятельствами непреодолимой силы понимаются землетрясения, пожары, наводнения, прочие стихийные бедствия, эпидемии, аварии, взрывы, военные действия, а также изменения законодательства, повлекшие за собой невозможность исполнения обязательств по Договору.</p>
                        <p>При возникновении обстоятельств непреодолимой силы, соответствующая сторона Договора обязана незамедлительно после возникновения таких обстоятельств оповестить об этом другую сторону. Срок исполнения обязательств по Договору при этом продлевается на период действия обстоятельства непреодолимой силы.</p>
                    </div>
                    <div>
                        <h3>ОТВЕТСТВЕННОСТЬ, РАЗРЕШЕНИЕ СПОРОВ</h3>
                        <p>Стороны несут ответственность за неисполнение либо за ненадлежащее исполнение обязательств по Договору в соответствии с законодательством Российской Федерации и условиями настоящей Оферты.</p>
                        <p>Все споры и требования, которые возникнут на основании заключенного Договора, или будут иным образом связаны с его заключением, исполнением, изменением или прекращением, как во время, так и после прекращения его действия, подлежат рассмотрению в суде по месту нахождения Организатора в порядке, установленном законодательством Российской Федерации.</p>
                        <p>Стороны устанавливают досудебный порядок урегулирования споров. Срок для рассмотрения претензий составляет 20 (Двадцать) календарных дней.</p>
                    </div>
                    <div>
                        <h3>ДЕЙСТВИЕ ОФЕРТЫ И ДОГОВОРА</h3>
                        <p>Настоящая Оферта действует до момента ее отзыва Организатором.</p>
                        <p>Договор, заключенный в результате Акцепта настоящей Оферты, действует с момента его заключения до момента его прекращения, в том числе до момента расторжения в порядке, предусмотренном действующим законодательством Российской Федерации, а также настоящей Офертой.</p>
                        <p>Моментом заключения Договора считается момент Акцепта Оферты.</p>
                        <p>Стороны вправе в одностороннем внесудебном порядке отказаться от исполнения Договора путем уведомления другой стороны Договора не менее чем за 1 (Один) календарный день до момента расторжения Договора.</p>
                    </div>
                    <div>
                        <h3>ПРОЧИЕ УСЛОВИЯ.</h3>
                        <p>Все юридически значимые уведомления и сообщения в рамках Договора направляются сторонами Договора друг другу по электронной почте.</p>
                        <p>При необходимости стороны взаимодействуют также в письменной форме посредством почтовой связи, с использованием курьерских услуг по доставке корреспонденции или путём вручения лично в руки, а также посредством телефонной связи.</p>
                        <p>Вся переписка посредством электронных документов может использоваться как безусловное подтверждение тех или иных фактических обстоятельств, связанных с исполнением договора.</p>
                        <p>Адрес электронной почты Участника, указанный им при регистрации, а также адрес электронной почты Организатора, указанный в реквизитах настоящей Оферты, считаются основными каналами взаимодействия по Договору.</p>
                        <p>Любое направленное по обозначенным адресам электронной почты сообщение считается доставленным в день его отправки.</p>
                        <p>Участник не вправе уступать третьим лицам свои права по Договору.</p>
                        <p>Настоящая Оферта и Договор регулируются в соответствии с законодательством Российской Федерации.</p>
                    </div>
                    <div>
                        <p>Реквизиты Организатора</p>
                        <p>Индивидуальный предприниматель Санджиева Фаина Санджаевна, ОГРНИП 315081600010093, ИНН 081410033690</p>
                    </div>
                    <div>
                        <p>Текст Оферты составлен юридической фирмой ООО «Уайт Сар» (ОГРН 1167746485653, 127473, г. Москва, 1-ый Щемиловский пер., д. 17 <a href="www.whitesar.ru">www.whitesar.ru</a>)</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
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
