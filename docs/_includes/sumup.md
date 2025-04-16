
## Pay What You Feel - Ways to Pay

{% if page.eventbrite %}
#### Buy a ticket

Buying a ticket via [Eventbrite]({{ page.eventbrite }}) will guarantee you a place at the event.

<a href="{{ page.eventbrite }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Buy Ticket at Eventbrite</a>

{% endif %}

#### On the door

We take cash and card payments on the door

#### Online via SumUp

If you want to make an [online donation towards this event]({{ include.link }}) you can do so via SumUp.<br>
We get 97.5% of what you donate.

**Reference for this event:** {{ include.title}}

Get to our [donation page via this link]({{ include.link }}) or this QRCode 

![{{ include.title}}]({{ site.url }}{% if site.baseurl %}{{ site.baseurl }}{% endif %}/assets/images/sumup/{{ include.qrcode }}){:class="img-responsive qr-code"}