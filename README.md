# urlSplit

Splits / Extracts the current url or a given one into its partials.


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
    $urlString = 'https://username:password@www.subdomain.example.com:1234/folder/subfolder/index.html?search=products&sort=false#top';
    $url       = new UrlSplit($urlString);
    
    print_r($url);
    // Output
    /* Object (
     *     [protocol]      string(5)  => 'https'
     *     [authorization] string(17) => 'username:password'
     *     [username]      string(8)  => 'username'
     *     [password]      string(8)  => 'password'
     *     [domain]        string(25) => 'www.subdomain.example.com'
     *     [port]          string(4)  => '1234'
     *     [domainList]    array(4)   => ([0] string(3) => 'www'
     *                                    [1] string(9) => 'subdomain'
     *                                    [2] string(7) => 'example'
     *                                    [3] string(3) => 'com')
     *     [domainLevels]  array(4)   => ([0] string(3) => 'com'
     *                                    [1] string(7) => 'example'
     *                                    [2] string(9) => 'subdomain'
     *                                    [3] string(3) => 'www')
     *     [request]       string(59) => '/folder/subfolder/index.html?search=products&sort=false#top'
     *     [path]          string(28) => '/folder/subfolder/index.html'
     *     [pathList]      array(4)   => ([0] string(1)  => '/'
     *                                    [1] string(7)  => 'folder/'
     *                                    [2] string(10) => 'subfolder/'
     *                                    [3] string(10) => 'index.html')
     *     [file]          string(10) => 'index.html'
     *     [fileName]      string(5)  => 'index'
     *     [fileExtension] string(4)  => 'html'
     *     [directory]     string(18) => '/folder/subfolder/'
     *     [directoryList] array(3)   => ([0] string(1)  => '/'
     *                                    [1] string(7)  => 'folder/'
     *                                    [2] string(10) => 'subfolder/')
     *     [query]         string(26) => 'search=products&sort=false'
     *     [queryList]     array(2)   => ([0] string(15) => 'search=products'
     *                                    [1] string(10) => 'sort=false')
     *     [queryObject]   array(2)   => ([search] string(8) => 'products'
     *                                    [sort]   string(5) => 'false')
     *     [fragment]      string(3)  => 'top'
     *     [getQueryValue  function(string $param)
     * )
     */
```
