<div class="col-md-3" markdown="1">
 ![{{ event.Title }}]({{ site.url }}{% if site.baseurl %}{{ site.baseurl }}{% endif %}/assets/images/bands/{{ event.Image1 }}){:class="img-responsive"}
</div>

<div class="col-md-6 px-5" markdown="1">
<!-- PERFORMERS -->
{% if event.Presents %}<h5>{{ event.Presents }}</h5>{% endif %}
{% assign performers = event.Artists | split: "," %}
{% for performer in performers -%}
  {%- if forloop.length > 1 -%}
    {% if forloop.first %}
## {{ performer }} + {% continue %}{% endif %} {{ performer }}{% unless forloop.last %}, {% endunless -%}
  {% else %}
## {{ performer }}
  {%- endif -%}
{% endfor %}

<div class="event-date" markdown="1">
{{ event.Date | date: "%A %d %B %Y" }} <span style="color: #000">/</span> Doors: {{ event.Time}} <span style="color: #000">/</span> {{ event.Price }}
</div>

<a href="{{ site.url }}{% if site.baseurl %}{{ site.baseurl }}{% endif %}/events/{{ event.Date | date: '%b-%Y' | downcase }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">More Details</a>

{% if event.Cancelled == "1"  %}
## CANCELLED
{{ event.CancelledText }}
{: class="description" }
{% endif %} <!-- if cancelled -->
</div>
{% if event.Image2  %}
<div class="col-md-3" markdown="1">
 ![{{ event.Title }}]({{ site.url }}{% if site.baseurl %}{{ site.baseurl }}{% endif %}/assets/images/bands/{{ event.Image2 }}){:class="img-responsive"}
</div>
{% endif %}