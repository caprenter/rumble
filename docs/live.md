---
title: Live Music
layout: listing
cover: splashes/BMTlogo_band.jpg #No leading slash
#image-credit: The Razerbills
navigation: true
---

If you have an upcoming event in the Bingley area we can list it here. 

Mention us on social media, or use the **#bingleymusictown** hash tag, or send us a link to your event. 

We'll do the rest.

{% capture upcoming-events %}{% include upcoming-events.md %}{% endcapture %}
{{ upcoming-events | markdownify }}

