@extends('site.layouts.default-new')

@section('content')

    <main>
        <section class="s-plans">
            <div class="container">
                <div class="filters">
                    <button class="filters__open-modal" id="open-filters">Filters <span></span></button>
                    <div class="filters__modal" id="filters-modal">
                        <div class="filters__buttons">
                            <button id="confirm-filters">Confirm <span></span></button>
                            <button id="cancel-filters">Cancel</button>
                        </div>
                        <div class="filters__container">
                            <div class="filters__block">
                                <h3>How is the weather</h3>
                                <div class="filters__list filters__list_2">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="weather" value="Sun">
                                        <span class="custom-checkbox__mark"></span>
                                        Sun
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="weather" value="Cold">
                                        <span class="custom-checkbox__mark"></span>
                                        Cold
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="weather" value="Warm">
                                        <span class="custom-checkbox__mark"></span>
                                        Warm
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="weather" value="Rain">
                                        <span class="custom-checkbox__mark"></span>
                                        Rain
                                    </label>
                                </div>
                            </div>
                            <div class="filters__block">
                                <h3>It can be made</h3>
                                <div class="filters__list">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="when" value="Morning">
                                        <span class="custom-checkbox__mark"></span>
                                        Morning
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="when" value="Afternoon">
                                        <span class="custom-checkbox__mark"></span>
                                        Afternoon
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="when" value="Night">
                                        <span class="custom-checkbox__mark"></span>
                                        Night
                                    </label>
                                </div>
                            </div>
                            <div class="filters__block">
                                <h3>The intensity</h3>
                                <div class="filters__intensity-checkboxes">
                                    <label>
                                        <input type="checkbox" name="intensity" value="1">
                                        <span class="filters__intensity-mark"><span></span></span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="intensity" value="2">
                                        <span class="filters__intensity-mark"><span></span></span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="intensity" value="3">
                                        <span class="filters__intensity-mark"><span></span></span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="intensity" value="4">
                                        <span class="filters__intensity-mark"><span></span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="filters__block">
                                <h3>That has</h3>
                                <div class="filters__list filters__list_3">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="contains" value="Hiking">
                                        <span class="custom-checkbox__mark"></span>
                                        <img src="{{ asset('/images/hiking-icon.png') }}" alt="Hiking icon">
                                        Hiking
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="contains" value="View">
                                        <span class="custom-checkbox__mark"></span>
                                        <img src="{{ asset('/images/photo-icon.png') }}" alt="Photo icon">
                                        View
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="contains" value="Ski">
                                        <span class="custom-checkbox__mark"></span>
                                        <img src="{{ asset('/images/ski-icon.png') }}" alt="Ski icon">
                                        Ski
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="contains" value="Bicycle">
                                        <span class="custom-checkbox__mark"></span>
                                        <img src="{{ asset('/images/bicycle-icon.png') }}" alt="Bicycle icon">
                                        Bicycle
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="contains" value="Climbing">
                                        <span class="custom-checkbox__mark"></span>
                                        <img src="{{ asset('/images/climbing-icon.png') }}" alt="Climbing icon">
                                        Climbing
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="suggested-plans">
                    <header>
                        <h2>Suggested Plans</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the
                            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type
                            and scrambled it to make a type spec</p>
                        <a href="#" class="see-all-link">See all</a>
                    </header>
                    <ul>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span></span>
                                    <span class="chosen"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </footer>
                        </li>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span class="chosen"></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </footer>
                        </li>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span></span>
                                    <span></span>
                                    <span class="chosen"></span>
                                    <span></span>
                                </div>
                            </footer>
                        </li>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span class="chosen"></span>
                                </div>
                            </footer>
                        </li>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span></span>
                                    <span class="chosen"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </footer>
                        </li>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span></span>
                                    <span class="chosen"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </footer>
                        </li>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span></span>
                                    <span class="chosen"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </footer>
                        </li>
                        <li>
                            <figure>
                                <a href="#">
                                    <img class="lazyload"
                                         src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                         data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"
                                         alt="Title of activity">
                                </a>
                            </figure>
                            <div class="suggested-plans__description">
                                <h3><a href="#">Title blog to enter</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur
                                    doloremque dolores ducimus</p>
                            </div>
                            <footer>
                                <ul>
                                    <li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>
                                    <li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>
                                </ul>
                                <div class="suggested-plans__intensity">
                                    <span></span>
                                    <span class="chosen"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </footer>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="s-own-plans">
            <div class="container">
                <h2>Create you own landscape</h2>
                <div class="s-own-plans__plan-block">
                    <header>
                        <h3>Caminhando</h3>
                        <p>Conhcer Pucón caminhando. Principais ruas e seus atrativos</p>
                        <a href="#" class="see-all-link">See all</a>
                    </header>
                    <ul class="s-own-plans__slider owl-carousel csHidden">
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/3edfafd7184fcafeac9d069092437634.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Villarrica</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6d42c1f5fd10f5c2a717e0a4898ee139.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Base Volcán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6f3db1ee46eaa5778d1ce649ef69ef21.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Salto Marimán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/7fabb4b42ae60c561e9afc64963e64a6.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Saltos Palguín</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/09bde39f876e6e72ab2ae437b64c2ac1.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Something</figcaption>
                                </figure>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="s-own-plans__plan-block">
                    <header>
                        <h3>Tour Cultural</h3>
                        <p>Conheça Pucón pelos Mapuches uma experiencia inesquecível</p>
                        <a href="#" class="see-all-link">See all</a>
                    </header>
                    <ul class="s-own-plans__slider owl-carousel csHidden">
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/3edfafd7184fcafeac9d069092437634.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Villarrica</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6d42c1f5fd10f5c2a717e0a4898ee139.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Base Volcán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6f3db1ee46eaa5778d1ce649ef69ef21.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Salto Marimán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/7fabb4b42ae60c561e9afc64963e64a6.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Saltos Palguín</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/09bde39f876e6e72ab2ae437b64c2ac1.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Something</figcaption>
                                </figure>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="s-own-plans__plan-block">
                    <header>
                        <h3>De Carro ou Ônibus</h3>
                        <p>Os passeios tradicionais que a maioria dos turistas fazem</p>
                        <a href="#" class="see-all-link">See all</a>
                    </header>
                    <ul class="s-own-plans__slider owl-carousel csHidden">
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/3edfafd7184fcafeac9d069092437634.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Villarrica</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6d42c1f5fd10f5c2a717e0a4898ee139.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Base Volcán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6f3db1ee46eaa5778d1ce649ef69ef21.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Salto Marimán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/7fabb4b42ae60c561e9afc64963e64a6.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Saltos Palguín</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/09bde39f876e6e72ab2ae437b64c2ac1.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Something</figcaption>
                                </figure>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="s-own-plans__plan-block">
                    <header>
                        <h3>Bicicleta</h3>
                        <p>Trilhas e roteiros que pode pedalar e conhcer coisas bacanas</p>
                        <a href="#" class="see-all-link">See all</a>
                    </header>
                    <ul class="s-own-plans__slider owl-carousel csHidden">
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/3edfafd7184fcafeac9d069092437634.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Villarrica</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6d42c1f5fd10f5c2a717e0a4898ee139.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Base Volcán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/6f3db1ee46eaa5778d1ce649ef69ef21.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Salto Marimán</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/7fabb4b42ae60c561e9afc64963e64a6.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Saltos Palguín</figcaption>
                                </figure>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <figure>
                                    <img class="owl-lazy"
                                         data-src="{{ asset('/images/uploads/09bde39f876e6e72ab2ae437b64c2ac1.jpg') }}"
                                         alt="Title of something">
                                    <figcaption>Something</figcaption>
                                </figure>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

@stop