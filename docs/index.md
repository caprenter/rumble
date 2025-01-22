---
layout: default
title: Rumble Up the Ryshworth
class: 'home-template'
navigation: True
#logo: /assets/images/splashes/BillyBilly5p.jpg
current: home
#Use 'our_id' below for the next film to be shown. The id is in the csv file
# we use {% assign film = site.data.films | where:"our-id", page.our-id | first  %}
# in _includes/head.html to make use of the data below using e.g. film.main-image
# Defaults to use if no 'next film'
cover: splashes/BillyBilly5p.jpg

---
<!-- < default -->
<!-- The tag above means - insert everything in this file into the [body] of the default.hbs template -->
<!-- The big featured header  -->
<header class="main-header" style="background-image: linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)), url({{ site.baseurl }}/assets/images/{{ page.cover }}); background-position-y:0">

    <div class="vertical">
        <div class="main-header-content inner">
           <h1 class="page-title">Live Music</h1>
           <h2 class="page-sub-title">Third Friday Of The Month</h2>
        </div>
    </div>
    <a class="scroll-down icon-arrow-left" href="#content" data-offset="-45"><span class="hidden">Scroll Down</span></a>

</header>

<!-- The main content area on the homepage -->
<main id="content" class="content" role="main" markdown="1">
{% include main.md %}

</main>
