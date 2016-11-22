<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{{ csrf_token() }}}">
        <title>Kipmuving</title>
        <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
        <link href="/css/prettyPhoto.css" rel="stylesheet" type="text/css">
        <link href="/css/brand.css" rel="stylesheet" type="text/css" media="all">
        <link href="/css/custom.css" rel="stylesheet" type="text/css" media="all">
        <link href="/css/style.css" rel="stylesheet" type="text/css" media="all">
        <link href="/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
        <link href="/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" media="all">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.js"></script>
        <script type="text/javascript" src="/js/jquery.main.js"></script>
        <script type="text/javascript" src="/js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="/owl-carousel/owl.carousel.min.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
        <script type="text/javascript" src="/js/custom2.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
        <script type="text/javascript"
        src="http://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&sensor=false"></script>
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    </head>



    @if(Auth::user())
    <a href="{{ url('/logout') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @endif





    <body class="home2">
        <div id="wrapper">
            <div class="w1">
                <header id="header" class="new">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="logo-block">
                                    <div class="animated-logo"><img src="/images/vivesimples.svg" alt="image description"></div>
                                    <div class="logo-pucon"><img src="/images/pucon.svg" alt="image description" width="71" height="30" onerror="this.onerror=null; this.src='/images/logo-pucon.png'"></div>
                                    <div class="logo"><a href="{{ action('HomeController@index') }}"><img src="/images/KipMuving.svg" alt="image description" width="220" height="56" onerror="this.onerror=null; this.src='/images/logo1.png'"></a></div>
                                </div>
                                <a href="#" class="nav-opener"><span></span></a>
                                <div class="right-block">
                                    <div class="topbar">
                                        <div class="login-panel">
                                            <div class="login-box">
                                                <div class="country">
                                                    <div class="img-flag">													
                                                        <img src="/images/rad-flag4.png" alt="image description">
                                                    </div>
                                                    <a href="#" data-target="#" data-toggle="dropdown">CLP</a>
                                                    <!--<li><a href="#">CLP $</a></li>
                                                            <li><a href="#">CLP $</a></li>
                                                            <li><a href="#">CLP $</a></li>-->
                                                </div>
                                                <div class="btn-holder">
                                                    @if (Auth::check())
                                                    <a href="/user" class="btn btn-primary">{{ Auth::user()->first_name ? Auth::user()->first_name : Auth::user()->first_name }}</a>
                                                    <a href="/logout" class="btn btn-primary">SALIR</a>
                                                    @else
                                                    <a href="/register" class="btn btn-primary">Registro</a>
                                                    <a href="/login" class="btn btn-primary">Login</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="top-holder">
                                            <nav id="nav">
                                                <ul>
                                                    <li><a href="{{ action('ActivityController@index') }}">Actividades</a></li>
                                                    <li><a href="{{ action('AgencyController@index') }}">Agencias</a></li>
                                                    <li><a href="{{ action('GuiaController@index') }}">Guia Pucon</a></li>
                                                    <!--<li><a href="/ofertas">Ofertas</a></li> -->
                                                </ul>
                                            </nav>
                                            <div class="compare-price">
                                                <p>Compara precios entre <strong>30 agencias</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Content -->
                @yield('content')
                <!-- ./ content -->

                <footer id="footer">
                    <aside class="holder">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-12 box">
                                        <!-- <strong class="title">Aventura Chile</strong>
                                        <nav class="footer-nav">
                                                <ul>
                                                        <li><a href="#">Quien Somos</a></li>
                                                        <li><a href="#">Time</a></li>
                                                        <li><a href="#">Trabaje con nosotros</a></li>
                                                        <li><a href="#">Contacto</a></li>
                                                </ul>
                                        </nav>-->
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-12 box">
                                    <ul class="payment-cards">
                                        <li><a href="#"><img src="/images/card1.png" alt="image description"></a></li>
                                        <li><a href="#"><img src="/images/card2.png" alt="image description"></a></li>
                                        <li><a href="#"><img src="/images/card3.png" alt="image description"></a></li>
                                        <li><a href="#"><img src="/images/card4.png" alt="image description"></a></li>
                                        <li><a href="#"><img src="/images/card5.png" alt="image description"></a></li>
                                        <li><a href="#"><img src="/images/card6.png" alt="image description"></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-12 box">
                                    <strong class="title">Donde Estamos</strong>
                                    <address class="address">
                                        <span>Colo Colo 485 - Pucón - Chile</span>
                                        <span><a href="tel:56452444035" class="tel">+56 45 2444035</a></span>
                                        <span><a href="tel:56962266304" class="tel">+56 9 62266304</a></span>
                                    </address>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 box">
                                    <strong class="title">Contactese con nosotros</strong>
                                    <form action="https://formspree.io/rafaelzarro@gmail.com" class="contact-form" method="POST">
                                        <div class="sub-row">
                                            <label for="name">Nome</label>
                                            <div class="text-field"><input type="text" class="form-control" id="name" name="name"></div>
                                        </div>
                                        <div class="sub-row">
                                            <label for="email">Email</label>
                                            <div class="text-field"><input type="email" class="form-control" id="email" name="email"></div>
                                        </div>
                                        <div class="sub-row">
                                            <label for="message">Mensaje</label>
                                            <div class="text-field"><textarea rows="5" cols="5" class="form-control" id="message" name="message"></textarea></div>
                                        </div>
                                        <input type="submit" value="OK" class="btn btn-success">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <div class="footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="mailto:contacto@kipmuving.com" class="email">contacto@kipmuving.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="message-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Por favor</h4>
                    </div>
                    <div class="modal-body">
                        <p id="message">&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Cerrar</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">CONFIRMAR</h4>
                    </div>
                    <div class="modal-body">
                        <p id="message">¿Le gustaría remover esta actividad?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-success btn-confirm">CONFIRMAR</a>
                        <a href="#" class="btn btn-warning" data-dismiss="modal">CANCELAR</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="map-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">MAPA</h4>
                    </div>
                    <div class="modal-body">
                        <div id="map-container" style="width: 100%; height: 500px"></div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#" class="btn btn-success btn-confirm">CONFIRMAR</a> -->
                        <a href="#" class="btn btn-warning" data-dismiss="modal">CERRAR</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script type="text/javascript">
            if (navigator.userAgent.match(/IEMobile\/10\.0/) || navigator.userAgent.match(/MSIE 10.*Touch/)) {
                var msViewportStyle = document.createElement('style')
                msViewportStyle.appendChild(
                        document.createTextNode(
                                '@-ms-viewport{width:auto !important}'
                                )
                        )
                document.querySelector('head').appendChild(msViewportStyle)
            }
        </script>
    </body>
</html>
