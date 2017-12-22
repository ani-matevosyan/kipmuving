@extends('site.layouts.default-new')

@section('content')

<main>
    <section class="s-plans">
        <div class="container">
            <div class="filters">
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
                    <div class="filters__list filters__list_3">
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
                        </label>
                        <label>
                            <input type="checkbox" name="intensity" value="2">
                        </label>
                        <label>
                            <input type="checkbox" name="intensity" value="3">
                        </label>
                        <label>
                            <input type="checkbox" name="intensity" value="4">
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
    </section>
    <section class="s-own-plans">

    </section>
</main>

@stop