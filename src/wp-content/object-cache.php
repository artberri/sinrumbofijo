<?php
/**
 * object cache
 * caches objects to disk for better performance under load
 * 
 * @note: If experiencing any erratic behavior with object cache, uncommenting the return line below will effectively disable the cache
 */ 
//return;
if (!defined('ABSPATH') || (defined('WP_INSTALLING') && WP_INSTALLING)
  || false === (@include_once(WP_CONTENT_DIR . '/plugins/gator-cache/lib/GatorCache.php'))
  || false === ($config = GatorCache::getConfig($path = ABSPATH . 'gc-config.ini.php', true))
  || !$config->get('oc_enabled') || ('' === ($dir = $config->get('oc_cache_dir'))) || empty($dir)) {
    return;
}
GatorCache::loadObjectCacheFns();
//GatorCache::getObjectCache()->flush();exit;
