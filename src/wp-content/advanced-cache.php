<?php
if (!defined('ABSPATH') || is_admin() || (defined('WP_INSTALLING') && WP_INSTALLING)
  || false === (@include_once(WP_CONTENT_DIR . '/plugins/gator-cache/lib/GatorCache.php'))//for some reason this needs parens
  || (($isMulti = is_multisite()) && (false === ($blogMap = GatorCache::getBlogMap()) || false === ($blogId = $blogMap->getBlogId())))
  || false === ($config = GatorCache::getConfig($path = ABSPATH . ($isMulti ? 'gc-config-' . $blogId . '.ini.php' : 'gc-config.ini.php'), true))
  || !$config->get('enabled')) {
    return;
}
if (!defined('GC_CHK_USER')) {
    for ($ct = count($cookies = array_reverse(array_keys($_COOKIE))), $xx=0; $xx<$ct; $xx++) {
        if (0 === strpos($cookies[$xx], 'wordpress_logged_in')) {
            if ($config->get('skip_user')) {
                //skip_user prevents any more user checks if exclusions are empty
                define('GC_CHK_USER', true);
            }
            return;
        }
        if (0 === strpos($cookies[$xx], 'comment_author')) {
            return;
        }
    }
}
//check for JetPack Mobile Theme
if ($config->get('jp_mobile') && false !== (@include_once(WP_CONTENT_DIR . '/plugins/jetpack/class.jetpack-user-agent.php'))) {
    for ($xx = 0; $xx < 1; $xx++) {
        if (isset($_COOKIE['akm_mobile'])) {
            if ('true' !== $_COOKIE['akm_mobile']) {
                break;
            }
        } elseif (!jetpack_is_mobile()) {
            break;
        }
        if (!$config->get('jp_mobile_cache')) {
            return;
            break;
        }
        $config->set('group', $config->get('group') . '-jpmobile');//use the mobile cache
    }
}
// check for Php Mobile Detect
if ((false !== ($mobileGroups = $config->get('mobile'))) && !empty($mobileGroups)) {
    //$mobileGroups = explode(':', $mobileGroups);
    $detect = GatorCache::getMobileDetect();
    $group = $config->get('group');
    if ($detect->isMobile()) {
        if (strstr($mobileGroups, 'tablet') && $detect->isTablet()) {
            $group .= '-TABLET';
        }
        elseif (strstr($mobileGroups, 'phone')) {
            $group .= '-PHONE';
        }
        else {
            $group .= '-MOBILE';
        }
        // by os
        if (strstr($mobileGroups, 'ios') && $detect->isiOS()) {
            $group .= '-IOS';
        }
        elseif (strstr($mobileGroups, 'android') && $detect->isAndroidOS) {
            $group .= '-ANDROID';
        }
        $config->set('group', $group);//use the mobile cache group
    }
}
$request = GatorCache::getRequest();
if ('GET' !== $request->getMethod() || $request->hasQueryString() || '.php' === substr($request->getRequestUri(), -4)
  || ($request->isSecure() && $config->get('skip_ssl'))
  || false === ($host = $config->get($request->isSecure() && $config->has('secure_host') ? 'secure_host' : 'host'))
  || $host !== $request->getHost()
  || ($config->get('dir_slash') && '/' !== substr($request->getPathInfo(), -1))) {
    return;
}
//get the cache
if (null !== ($result = GatorCache::getCache($opts = $config->toArray())->get($basePath = $request->getPathInfo(), $request->isSecure() ? 'ssl@' . $opts['group'] : $opts['group']))) {
    //this would required the gmt offset
    /*if ($opts['last_modified'] && false !== ($fileTime = GatorCache::getCache($opts)->getCache()->getFileTime())) {
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $fileTime). ' GMT');
    }*/
    if (!empty($opts['pingback'])) {
        header('X-Pingback: ' . $opts['pingback']);
    }
    if ($isFeed = strstr($basePath, '/feed/') && isset($opts['rss2_type'])) {
        if ('/feed/' === $basePath) {
            $contentType = isset($opts['default_feed']) && isset($opts[$key =  $opts['default_feed'] . '_type']) ? $opts[$key] : $opts['rss2_type'];
        } else {
            $tmp = explode('/', $basePath);
            $contentType =  empty($tmp[2]) || !isset($opts[$key =  $tmp[2] . '_type']) ? $opts['rss2_type'] : $opts[$key];
        }
        header($contentType);
    } 
    elseif (isset($opts['content_type']) && !strstr($basePath, '.xml')) {
        header($opts['content_type']);
    }
    die($result . ($opts['debug'] && !$isFeed ? "\n<!-- Served by Advanced Cache " . $host . " -->\n" : ''));
}
