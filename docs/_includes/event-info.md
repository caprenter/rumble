<!-- {% assign events = site.data.events | sort: "Date"  %}
{% for event in events %}
{% if event.Date contains page.event-date  %}
{{event.Description}}
{% endif %}
{% endfor %} -->

{% assign artists = page.title | split: " + " %}

{% assign artist = site.data.artists | where:"Name", artists[0] | first %} 
{% include artists.md %}

{% if artists[1] %}
{% assign artist = site.data.artists | where:"Name", artists[1] | first %}
{% if artist %}
{% include artists.md %}
{% endif %}
{% endif %}

{% if artists[2] %}
{% assign artist = site.data.artists | where:"Name", artists[2] | first %}
{% if artist %}
{% include artists.md %}
{% endif %}
{% endif %}

{% capture sumupTitle %}Rumble #{{ page.rumble-number }} {{ page.event-date | date: "%b %Y" }} {{ page.title }}{% endcapture %}

{% capture sumupCode %}qrcode_sumup_{{ page.event-date | date: "%b%Y" | downcase }}.png{% endcapture %}

{% include sumup.md title=sumupTitle link=page.sumupLink qrcode=sumupCode %}