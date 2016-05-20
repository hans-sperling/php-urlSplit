<?php
class UrlSplit {
    private $cacheEnabled = false;
    private $reset        = array(
        'protocol'      => null,
        'authorization' => null,
        'username'      => null,
        'password'      => null,
        'domain'        => null,
        'port'          => null,
        'domainList'    => null,
        'domainLevels'  => null,
        'request'       => null,
        'path'          => null,
        'pathList'      => null,
        'file'          => null,
        'fileName'      => null,
        'fileExtension' => null,
        'directory'     => null,
        'directoryList' => null,
        'query'         => null,
        'queryList'     => null,
        'queryObject'   => null,
        'fragment'      => null,
    );
    private $cache        = array();
    private $url          = '';

    public $protocol      = null;
    public $authorization = null;
    public $username      = null;
    public $password      = null;
    public $domain        = null;
    public $port          = null;
    public $domainList    = null;
    public $domainLevels  = null;
    public $request       = null;
    public $path          = null;
    public $pathList      = null;
    public $file          = null;
    public $fileName      = null;
    public $fileExtension = null;
    public $directory     = null;
    public $directoryList = null;
    public $query         = null;
    public $queryList     = null;
    public $queryObject   = null;
    public $fragment      = null;


    public function __construct($url = null) {
        $this->cache = (object)$this->reset;

        // If no url is given the current page request will be taken.
        $this->url = $url ? $url : $this->getUrl();

        $this->resetCache();
        $this->enableCaching();

        $this->protocol      = $this->getProtocol();
        $this->authorization = $this->getAuthorization();
        $this->username      = $this->getUsername();
        $this->password      = $this->getPassword();
        //$this->domain        = $this->getDomain();
        //$this->port          = $this->getPort();
        //$this->domainList    = $this->getDomainList();
        //$this->domainLevels  = $this->getDomainLevels();
        //$this->request       = $this->getRequest();
        //$this->path          = $this->getPath();
        //$this->pathList      = $this->getPathList();
        //$this->file          = $this->getFile();
        //$this->fileName      = $this->getFileName();
        //$this->fileExtension = $this->getFileExtension();
        //$this->directory     = $this->getDirectory();
        //$this->directoryList = $this->getDirectoryList();
        //$this->query         = $this->getQuery();
        //$this->queryList     = $this->getQueryList();
        //$this->queryObject   = $this->getQueryObject();
        //$this->fragment      = $this->getFragment();
        //$this->getQueryValue = getQueryValue;

        $this->disableCaching();
        $this->resetCache();
    }


    /**
     * Returns the protocol of the given url.
     *
     * @private
     * @return string
     */
    private function getProtocol() {
        $cached = $this->cache->protocol;

        if ($this->cacheEnabled && $cached !== null) {
            return $cached;
        }

        $splitDomain = explode('://', $this->url);
        $protocol    = ($splitDomain[1] ? $splitDomain[0] : '');

        return $this->cache->protocol = $protocol;
    }


    /**
     * Returns the authorization of the given url.
     * A normal syntax of an authorization is {username}:{password}@example.com or only {username}@example.com
     *
     * @private
     * @returns string
     */
    private function getAuthorization() {
        $cached = $this->cache->authorization;
        $url    = $this->url;

        if ($this->cacheEnabled && $cached !== null) {
            return $cached;
        }

        $protocol = $this->getProtocol();

        if ($protocol) {
            $url = str_replace($protocol . '://', '', $this->url);
        }

        $domainSplit   = explode('@', $url);
        $authorization = $domainSplit[1] ? $domainSplit[0] : '';

        return $this->cache->authorization = $authorization;
    }


    /**
     * Returns the username from the authorization part of the given url.
     *
     * @private
     * @returns string
     */
    function getUsername() {
        $cached = $this->cache->username;

        if ($this->cacheEnabled && $cached !== null) {
            return $cached;
        }

        $authorization      = $this->getAuthorization();
        $authorizationSplit = explode(':', $authorization);
        $username           = $authorizationSplit[0];

        return $this->cache->username = $username;
    }


    /**
     * Returns the password from the authorization part of the given url.
     *
     * @private
     * @returns string
     */
    function getPassword() {
        $cached = $this->cache->password;

        if ($this->cacheEnabled && $cached !== null) {
            return $cached;
        }

        $authorization      = $this->getAuthorization();
        $authorizationSplit = explode(':', $authorization);
        $password           = ($authorizationSplit[1] ? $authorizationSplit[1] : '');

        return $this->cache->password = $password;
    }


//    /**
//     * Returns the complete domain of the given url.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getDomain() {
//        $cached = $this->cache->domain,
//            protocol, authorization,
//            domain;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        protocol      = getProtocol();
//        authorization = $this->getAuthorization();
//
//        if (protocol) {
//            url = url.replace(protocol + '://', '');
//        }
//
//        if (authorization) {
//            url = url.replace(authorization + '@', '');
//        }
//
//        // Remove request and port if exists
//        domain = url.split('/')[0].split(':')[0];
//
//        return $this->cache->domain = domain;
//    }
//
//
//    /**
//     * Returns the domain parts of the given url as array.
//     *
//     * @private
//     * @returns {Array}
//     */
//    function getDomainList() {
//        $cached = $this->cache->domainList,
//            domain,
//            domainList;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        domain     = getDomain();
//        domainList = domain.split('.');
//
//        // noinspection JSValidateTypes
//        return $this->cache->domainList = domainList;
//    }
//
//
//    /**
//     * Returns the domain parts of the given url as array in order of their level.
//     *
//     * @private
//     * @returns {Array}
//     */
//    function getDomainLevels() {
//        $cached = $this->cache->domainLevels,
//            domainList,
//            domainLevels;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        domainList   = getDomainList();
//        domainLevels = domainList.slice().reverse();
//
//        // noinspection JSValidateTypes
//        return $this->cache->domainLevels = domainLevels;
//    }
//
//
//    /**
//     * Returns the port of the given url.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getPort() {
//        $cached = $this->cache->port,
//            protocol, authorization, urlReplace, urlSplit,
//            port;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        protocol      = getProtocol();
//        authorization = $this->getAuthorization();
//        urlReplace    = url.replace(protocol + '://', '').replace(authorization + '@', '');
//        urlSplit      = urlReplace.split('/')[0].split(':');
//        port          = (urlSplit[1] !== undefined ? urlSplit[1] : '');
//
//        return $this->cache->port = port;
//    }
//
//
//    /**
//     * Returns the request of the given url.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getRequest() {
//        $cached = $this->cache->request,
//            protocol, authorization, domain, port, replace,
//            request;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        protocol      = getProtocol();
//        authorization = $this->getAuthorization();
//        domain        = getDomain();
//        port          = getPort();
//        replace       = url.replace(protocol + '://', '');
//        replace       = replace.replace(authorization + '@', '');
//        replace       = replace.replace(domain, '');
//        request       = replace.replace(':' + port, '');
//
//        // noinspection JSValidateTypes
//        return $this->cache->request = request;
//    }
//
//
//    /**
//     * Returns the path from the request part of the given url.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getPath() {
//        $cached = $this->cache->path,
//            request,
//            path;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        request = getRequest();
//        path    = request.split('?')[0];
//
//        return $this->cache->path = path;
//    }
//
//
//    /**
//     * Returns the path parts from the request part of the given url as array.
//     *
//     * @private
//     * @returns {Array}
//     */
//    function getPathList() {
//        $cached = $this->cache->pathList,
//            path, amount, i,
//            pathList;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        path     = getPath();
//        pathList = path.split('/');
//        amount   = pathList.length;
//
//        for (i = 0; i < amount; i++) {
//            pathList[i] = pathList[i];
//
//            if (i < amount - 1) {
//                pathList[i] = pathList[i] + '/';
//            }
//            else {
//                if (pathList[i] === '') {
//                    pathList.splice(-1);
//                }
//                else {
//                    pathList[i] = pathList[i];
//                }
//            }
//        }
//
//        // noinspection JSValidateTypes
//        return $this->cache->pathList = pathList;
//    }
//
//
//    /**
//     * Returns the file from the request part of the given url.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getFile() {
//        $cached = $this->cache->file,
//            pathList, lastItem, itemSplitDash, itemSplitDot,
//            file;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        pathList = getPathList();
//        lastItem = pathList[(pathList.length - 1)];
//
//        if (lastItem) {
//            itemSplitDash = lastItem ? lastItem.split('/') : '';
//
//            if (itemSplitDash.length > 1) {
//                file = '';
//            }
//            else {
//                itemSplitDot = lastItem.split('.');
//                file         = itemSplitDot[1] ? lastItem : itemSplitDot[0];
//            }
//        }
//        else {
//            file = '';
//        }
//
//        return $this->cache->file = file;
//    }
//
//
//    /**
//     * Returns the filename from the request part of the given url.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getFileName() {
//        $cached = $this->cache->fileName,
//            file, fileSplit,
//            fileName;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        file      = getFile();
//        fileSplit = file.split('.');
//
//        if (fileSplit.length > 1) {
//            fileName = fileSplit.slice(0, -1).join('.');
//        }
//        else {
//            fileName = fileSplit[0];
//        }
//
//        return $this->cache->fileName = fileName;
//    }
//
//
//    /**
//     * Returns the file extension from the request part of the given url.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getFileExtension() {
//        $cached = $this->cache->fileExtension,
//        file, fileName, fileReplaced,
//        fileExtension;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        file          = getFile();
//        fileName      = getFileName();
//        fileReplaced  = file.replace(fileName , '');
//        fileExtension = (fileReplaced[0] == '.' ? fileReplaced.replace('.', '') : fileReplaced);
//
//        // noinspection JSValidateTypes
//        return $this->cache->fileExtension = fileExtension;
//    }
//
//
//    /**
//     * Returns the directory parts from the request part of the given url as array.
//     *
//     * The directory parts are the path parts excluding the file.
//     *
//     * @private
//     * @returns {Array}
//     */
//    function getDirectoryList() {
//        $cached = $this->cache->directoryList,
//            pathList, file,
//            directoryList;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        pathList = getPathList();
//        file     = getFile();
//
//        if (file) {
//            directoryList = pathList.slice(0, -1);
//        }
//        else {
//            directoryList = pathList;
//        }
//
//        return $this->cache->directoryList = directoryList;
//    }
//
//
//    /**
//     * Returns the directory from the request part of the given url.
//     *
//     * The directory is the path excluding the requested file.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getDirectory() {
//        $cached = $this->cache->directory,
//            directoryList,
//            directory;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        directoryList = getDirectoryList();
//        directory     = directoryList.join('');
//
//        // noinspection JSValidateTypes
//        return $this->cache->directory = directory;
//    }
//
//
//    /**
//     * Returns the query from the request part of the given url.
//     *
//     * The query is also known as the search part of a request.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getQuery() {
//        $cached = $this->cache->query,
//            request, requestSplit,
//            query;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        request      = getRequest();
//        requestSplit = request.split('?');
//        query        = (requestSplit[1] !== undefined ? requestSplit[1].split('#')[0] : '');
//
//        return $this->cache->query = query;
//    }
//
//
//    /**
//     * Returns the query parts from the request part of the given url as array.
//     *
//     * @private
//     * @returns {Array}
//     */
//    function getQueryList() {
//        $cached = $this->cache->queryList,
//            query,
//            queryList;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        query     = getQuery();
//        queryList = query.split('&');
//
//        // noinspection JSValidateTypes
//        return $this->cache->queryList = queryList;
//    }
//
//
//    /**
//     * Returns all parameters from the request part of the given url as object list.
//     *
//     * @private
//     * @returns {Object}
//     */
//    function getQueryObject() {
//        $cached = $this->cache->queryObject,
//            queryList, amount, i, item,
//            queryObject;
//
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        queryList   = getQueryList();
//        amount      = queryList.length;
//        queryObject = {};
//
//        for (i = 0; i < amount; i++) {
//            item = queryList[i].split('=');
//
//            if (item[0] !== undefined && item[1] !== undefined) {
//                queryObject[item[0]] = item[1];
//            }
//        }
//
//        // noinspection JSValidateTypes
//        return $this->cache->queryObject = queryObject;
//    }
//
//
//    /**
//     * Returns the value of the given parameter in the given url.
//     *
//     * @private
//     * @param   {string} param
//     * @returns {string|null}
//     */
//    function getQueryValue(param) {
//        var parameterObject = getQueryObject(),
//            value           = null,
//            item;
//
//        for (item in parameterObject) {
//            if (parameterObject.hasOwnProperty(item) && item == param) {
//                value = parameterObject[item];
//            }
//        }
//
//        return value;
//    }
//
//
//    /**
//     * Returns the fragment from the request part of the given url.
//     *
//     * The fragment is also known as anchor.
//     *
//     * @private
//     * @returns {string}
//     */
//    function getFragment() {
//        $cached = $this->cache->fragment,
//            request, requestSplit,
//            fragment;
//
//        if ($this->cacheEnabled && $cached !== null) {
//            return $cached;
//        }
//
//        request      = getRequest();
//        requestSplit = request.split('#');
//        fragment     = (requestSplit[1] !== undefined ? requestSplit[1] : '');
//
//        return $this->cache->fragment = fragment;
//    }


    /**
     * Resets the cache data.
     *
     * @private
     */
    function resetCache() {
        $this->cache = (object)$this->reset;
    }


    /**
     * Enables the caching.
     *
     * @private
     */
    function enableCaching() {
        $this->cacheEnabled = true;
    }


    /**
     * Disables the caching.
     *
     * @private
     */
    function disableCaching() {
        $this->cacheEnabled = false;
    }


    /**
     * Returns the url of the current page request.
     *
     * @private
     * @returns string
     */
    private function getUrl() {
        return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}

