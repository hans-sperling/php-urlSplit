# urlSplit

Splits / Extracts a given url into its partials.


## Parts of an regular web url
                                                            | request ----------------------------------------------- |
                                                            | path ------------------- |                              |
            | authorization | | domain -------------- |     | directory ---- || file - | | query ---------------- |   |
            |               | |                       |     |                ||        | |                        |   |
    https://username:password@www.subdomain.example.com:1234/folder/subfolder/index.html?search=products&sort=false#top
    |       |        |        |   |         |       |   |   |       |         |     |    |      |        |    |     |
    |       username |        |   |         |       |   |   folder  folder    |     |    |      value    |    value |
    protocol         password |   |         |       |   port                  |     |    parameter       parameter  |
                              |   |         |       1st-level-domain          |     file-extension                  fragment
                              |   |         2nd-level-domain                  filename
                              |   3rd-level-domain
                              4th-level-domain


## Methods

### getQueryValue(param);
- Argument(s): `string` **param** - Parameter in the url query
- Return: `string|null` The value of the given parameter or null if the parameter doesn't exist


## Usage and Example

```php
    $urlString      = 'https://username:password@www.subdomain.example.com:1234/folder/subfolder/index.html?search=products&sort=false#top',
    $url            = $urlSplit(urlString),
    $urlQueryParam1 = $url->getQueryValue('search'),
    $urlQueryParam2 = $url->getQueryValue('sort'),
    $urlQueryParam3 = $url->getQueryValue('undefined');
```
