# Blocks plugin for WinterCMS
Allows you to edit blocks stored in database on the front-end pages.

### Features
* backend editor
* front-end editor
* the ability to add your custom CSS classes
* Blocks preloader (cache)

### Language support
* English
* Russian

### Supported versions
Please check: https://www.php.net/supported-versions.php
* PHP 8.0
* PHP 8.1
* PHP 8.2

### Installation
```bash
composer require dimsog/wn-blocks-plugin
```

### How to use
pages/home.htm
```html
title = "Demonstration"
url = "/"
layout = "default"

[block]

==

{% component 'block' code='block1' %}

{% component 'block' code='block2' class='foo-bar' %}
```

### Using with Blocks Preloader component
All blocks are loaded with a single SQL query
```html
title = "Demonstration"
url = "/"
layout = "default"

[blocksPreloader]
id = "10, 11, 12"
code = "block1, block2"

[block]

==

{% component 'block' code='block1' %}
```