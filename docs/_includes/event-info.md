{% assign artists = page.title | split: " + " %}

{% assign artist = site.data.artists | where:"Name", artists[0] | first %} 
{% include artists.md %}

{% assign artist = site.data.artists | where:"Name", artists[1] | first %}
{% include artists.md %}

{% capture sumupTitle %}Rumble #{{ page.rumble-number }} {{ page.date | date: "%b %Y" }} {{ page.title }}{% endcapture %}

{% capture sumupCode %}qrcode_sumup_{{ page.date | date: "%b%Y" | downcase }}.png{% endcapture %}

{% include sumup.md title=sumupTitle link=page.sumupLink qrcode=sumupCode %}