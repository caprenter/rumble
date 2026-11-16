{% assign events = site.data.events | sort: "Date"  %}

## Pay What You Feel - Ways to Pay

We want Rumble to be affordable for everyone. 


{% if page.eventbrite %}
#### Buy a ticket

Buying a ticket via [Eventbrite]({{ page.eventbrite }}) will guarantee you a place at the event.

<a href="{{ page.eventbrite }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Buy Ticket at Eventbrite</a>

{% endif %}

{% for event in events %}
{% if event.Date contains page.event-date  %}
{% if event.Description contains "Rumble"  %}
{% assign tickets = event.Tickets %}

#### Buy a ticket
If you would like to obtain advanced tickets then you can buy a tickets via the [Bingley Arts Centre Ticket Platform]({{ event.Tickets }}).

Tickets are offered under a tiered pricing structure so that you can pay what you can afford.

Pick a price that works for you or alternatively you can still pay on the door. Whichever ticket you choose, you get exactly the same gig experience.

* Accessible Tickets - our cheapest pre-paid option.
* Standard Ticket - Our regular ticket price.
* Pay It Forward Supporter Ticket - If you feel you can pay a little more, you’ll really be supporting us in our ambition to keep bringing original grass roots live music to Bingley Music Town.

<a href="{{ event.Tickets }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Buy Tickets from bingley Arts Centre</a>

{% endif %}
{% endif %}
{% endfor %}

#### On the door

We take cash and card payments on the door

<!-- #### Online via SumUp

If you want to make an [online donation towards this event]({{ include.link }}) you can do so via SumUp.<br>
We get 97.5% of what you donate.

**Reference for this event:** {{ include.title}}

Get to our [donation page via this link]({{ include.link }}) or this QRCode 

![{{ include.title}}]({{ site.url }}{% if site.baseurl %}{{ site.baseurl }}{% endif %}/assets/images/sumup/{{ include.qrcode }}){:class="img-responsive qr-code"} -->