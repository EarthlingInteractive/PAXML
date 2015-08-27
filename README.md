[![Build Status](https://travis-ci.org/EarthlingInteractive/PAXML.svg?branch=master)](https://travis-ci.org/EarthlingInteractive/PAXML)

## PAXML: PHP Array [representation of] XML

This is a tiny library for emitting XML.  Or XHTML.

Its intended use is to replace HTML/PHP template code with something
easier to read and write and manipulate.

e.g. instead of

```php
<p>Hi my name is <?php echo htmlspecialchars($name); ?></p>
```

you would construct a PAXML value like:

```php
['p', 'Hi my name is ', $name]
```

and then output it using 

```php
$emitter->emit($value, "", "\t", function($text) { echo $text; });
```

If you need a Nife_Blob, make one like so:

```php
$blob = new EarthIT_PAXML_PAXMLBlob($value);
```
