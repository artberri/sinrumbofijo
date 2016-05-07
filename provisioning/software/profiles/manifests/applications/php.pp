class profiles::applications::php (
  $extensions,
  $settings,
) {

  class { '::php::repo::redhat':
    yum_repo => 'webtatic'
  }

  exec { 'yum check-update':
    path        => $::path,
    refreshonly => true,
    require     => Class['::php::repo::redhat']
  }

  $package_prefix = 'php70w-'

  class { '::php':
    manage_repos   => false,
    package_prefix => $package_prefix,
    extensions     => $extensions,
    fpm            => false,
    settings       => $settings,
    require        => Exec['yum check-update'],
  } ->

  class { 'php::fpm':
    settings => $settings,
    pools    => {
      'www' => {
        listen       => '/var/run/php-fpm/php-fpm.sock',
        user         => 'nginx',
        group        => 'nginx',
        listen_owner => 'nginx',
        listen_group => 'nginx',
      }
    }
  }

}
