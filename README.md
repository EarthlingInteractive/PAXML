[![Build Status](https://travis-ci.org/EarthlingInteractive/PAXML.svg?branch=master)](https://travis-ci.org/EarthlingInteractive/PAXML)

# PAXML: PHP Array [representation of] XML

This is a tiny library for emitting XML.  Or XHTML.

Its intended use is to replace HTML/PHP template code with something
easier to read and write and manipulate.

e.g. instead of

```php
<p>Hi my name is <?php echo htmlspecialchars($name); ?></p>
```

you would construct a PAXML value like:

```php
$value = ['p', 'Hi my name is ', $name];
```

and then output it using 

```php
EarthIT_PAXML::emit($value);
```

If you need a Nife_Blob, make one like so:

```php
$blob = new EarthIT_PAXML_PAXMLBlob($value);
```

## PAXML Values

Scalars represent text.

Arrays represent elements.

The 0th element of an array gives the tag name.

Subsequent numerically-keyed elements of an array give sub-tags.

String-keyed elements of an array give attribute values.

## Examples

```php
['p', 'style'=>'color: green', 'I like ', ['span', 'style'=>'color: red', 'food'], '.']
```

Will be emitted as:

```xml
<p style="color: green">I like <span style="color: red">food</span>.</p>
```
