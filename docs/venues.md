---
title: Venues
layout: listing
cover: splashes/BMTlogo_FiveRiseRecords.jpg #No leading slash
image-credit: "Photo: Neil Horsley, Bingley Camera Club"
navigation: true
---

This is a list of places in our district where live music takes place.

Check out our [live music events listing]({% link live.md %}).

<div class="container logos venues">
{% for venue in site.venues %}

<div class="row"> 
<div class="column-8" markdown="1">
<h3><a href="{{ venue.url }}">{{ venue.Name }}</a></h3>
{% if venue.Member =='yes' %}
<div class="member-badge">
<p>Rumble Up the Ryshworth Member</p>
</div>
{% endif %}
<p class="venue-address">{{ venue.Address }}{% if venue.Postcode %}, {{ venue.Postcode }}{% endif %}</p>
<p class="venue-description">{{ venue.Description }}</p>

<div class="org-contact" markdown="1">
{% if venue.email %}* **Email:** [{{ venue.email }}](mailto:{{ venue.email }}){% endif %}
{% if venue.Web %}* **Web:** [{{ venue.Web }} <i class="fa fa-external-link" aria-hidden="true"></i>]({{ venue.Web }}){:target="_blank" rel="noopener noreferrer"}{% endif %}
</div>
</div>
<div class="column-4 venue-image">
{% include upcoming-events-table.md WhichVenue=venue.Name %}
</div>

</div>


{% endfor %}
</div>


