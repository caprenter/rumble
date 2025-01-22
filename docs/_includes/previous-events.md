{% comment %}
  Used in:
  previous-events.md page
  Individual Venue pages to show past events
{% endcomment %}


{% assign dateToday = 'now' | date: "%Y-%m-%d" %}
{% assign events = site.data.events | sort: "Date" | reverse  %}
{% assign venues = site.data.venues %}

<div style="overflow-x:auto;" >
<table class="events">
<tr>
<th>Date</th>
<th>Artist(s)</th>
{% comment %}
  No need to show the Venue column if we're on Venue page already.
{% endcomment %}
{% if page.layout != 'venue_page' %}<th>Venue</th>{% endif %}
<th>Notes</th>
</tr>
{% for event in events %}
{% assign mod2 = forloop.index | modulo: 2 %}
{% if event.Date < dateToday  %}

{% comment %}
  If this is a venue page, we only want events that happened at that venue.
  Otherwise we want all past events at all venues
{% endcomment %}
{% if page.layout == "venue_page" %}
{% if event.Venue != page.Name %}
{% continue %}
{% endif %}
{% endif %}

{% assign venue = site.venues | where:"Name", event.Venue | first %}

<tr class="event-item {% if mod2 == 0 %}even{% else %}odd{% endif %}">
<td>{% if event.Link %}<a href="{{event.Link}}">{{ event.Date | date: "%a. %d %b %Y" }}</a>{% else %}{{ event.Date | date: "%a. %d %b %Y" }}{% endif %}</td>
<td>
{% assign performers = event.Artists | split: "," %}
{% for performer in performers -%}
{% assign artist = site.data.artists | where:"Name", performer | first  %}
{% if {{artist.Web}} %}
{% assign artist_web = {{artist.Web}} %}
{% elsif {{artist.Facebook}} %}
{% assign artist_web = {{artist.Facebook}} %}
{% endif %}
{% if artist_web %}<a href="{{ artist_web }}">{{ performer}}</a>{% else %}{{performer}}{% endif %}{%- if forloop.last -%}{% else %}, {% endif %}
{% endfor %}
</td>
{% if page.title != "Venues" and page.layout != 'venue_page'%}
<td>{% if venue.url %}<a href="{{site.url}}{{ venue.url }}">{{ venue.Name }}</a>{% else %}{{ event.Venue }}{%endif %}</td>{% endif %}
<td>{% if event.Cancelled == "1"  %}Cancelled{% endif %}</td>
</tr>
{% assign artist_web = false %}
{% endif %} <!-- in the future -->
{% endfor %}  
</table>
</div>