---
title: Gallery
layout: page 
cover: splashes/BMT_RecordStoreDay23.jpg #No leading slash
image-credit: "Photo: Bingley Camera Club"
navigation: true
---

We're grateful to [Bingley Camera Club<i class="fa fa-external-link" aria-hidden="true"></i>](https://www.bingleycameraclub.org.uk/){:target="_blank" rel="noopener noreferrer"} for taking pictures of Rumble Up the Ryshworth.<br>A selection of the images they have captured are shown here. 


<!-- Gallery -->
<div class="container gallery">
{% assign image_files = site.static_files | where: "image", true | reverse %}
{% for image in image_files %}
{% if forloop.first %}<div class="row">{% endif %}
{% assign indexmod3 = forloop.index | modulo: 3 %}
{% if indexmod3 == 1 %}<div class="row">{% endif %}
{% assign altcaptitle = image.basename | replace: "_"," " | append: " - Photos by Bingley Camera Club" %}
<a href="{{site.baseurl}}{{image.path}}" data-toggle="lightbox" data-gallery="example-gallery" data-caption="{{ altcaptitle }}" class="col-sm-4"><img src="{{site.baseurl}}{{image.path | replace: 'gallery','thumbnails'}}" alt="{{ altcaptitle }}" title="{{ altcaptitle }}" class="img-fluid" /></a>
{% if forloop.last %}</div>{% elsif indexmod3 == 0 %}</div>{% endif %}
{% endfor %}
</div>
<!-- Gallery -->