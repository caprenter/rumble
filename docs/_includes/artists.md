<div class="row">
<div class="col-md-3" markdown="1">
 ![{{ artist.Name }}]({{ site.url }}{% if site.baseurl %}{{ site.baseurl }}{% endif %}/assets/images/bands/{{ artist.Image }}){:class="img-responsive"}
</div>

<div class="col-md-6 px-5" markdown="1">

## {{ artist.Name }}

{{ artist.About }}

<div class="artist icons">

<ul class="list-inline">
{% if artist.Web %}<li class="list-inline-item"><a href="{{ artist.Web }}" title="{{ artist.Name }} Website"><i class="fa-solid fa-globe" aria-hidden="true"></i></a></li>{% endif %}
{% if artist.Bandcamp %}<li class="list-inline-item"><a href="{{ artist.Bandcamp }}" title="{{ artist.Name }} on Bandcamp"><i class="fa-brands fa-bandcamp" aria-hidden="true"></i></a></li>
{% endif %}
{% if artist.Facebook %}<li class="list-inline-item"><a href="{{ artist.Facebook }}" title="{{ artist.Name }} on Facebook"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a></li>{% endif %}
{% if artist.Twitter %}<li class="list-inline-item"><a href="{{ artist.Twitter }}" title="{{ artist.Name }} on X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a></li>{% endif %}
{% if artist.Instagram %}<li class="list-inline-item"><a href="{{ artist.Instagram }}" title="{{ artist.Name }} on Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a></li>
{% endif %}
</ul>

</div>
</div>
</div>