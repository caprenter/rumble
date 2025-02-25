{% assign artists = page.title | split: " + " %}

{% assign artist = site.data.artists | where:"Name", artists[0] | first %} 
{% include artists.md %}

{% if artists[1] %}
{% assign artist = site.data.artists | where:"Name", artists[1] | first %}
{% if artist %}
{% include artists.md %}
{% endif %}
{% endif %}

{% capture sumupTitle %}Rumble #{{ page.rumble-number }} {{ page.date | date: "%b %Y" }} {{ page.title }}{% endcapture %}

{% capture sumupCode %}qrcode_sumup_{{ page.date | date: "%b%Y" | downcase }}.png{% endcapture %}

{% include sumup.md title=sumupTitle link=page.sumupLink qrcode=sumupCode %}