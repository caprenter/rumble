---
title: Previous Events
sub-title: Veni, Vidi, Rumbled
layout: page
cover: splashes/past-events.jpg #No leading slash
#image-credit: The Razerbills
navigation: true
---

{% include previous-events.md %}

<!-- {% assign pages = site.pages | sort:"date" | reverse %}
{% for page in pages %}
{% if page.dir == "/events/" %}
{% if page.title != "All Gigs" %}
## [{{page.title}}]({{ site.url }}{% if site.baseurl %}{{ site.baseurl }}{% endif %})
{{ page.date | date: "%A %d %B %Y" }}
{% endif %}
{% endif %}
{% endfor %} -->
