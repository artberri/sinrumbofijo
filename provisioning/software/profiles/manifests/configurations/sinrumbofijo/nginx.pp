class profiles::configurations::sinrumbofijo::nginx (
    $deploy_user,
    $deploy_group,
    $website_hostname,
    $website_origin,
  ) {

  $base_directory = '/var/www'
  $website_directory = "${base_directory}/${website_hostname}"

  ensure_resource('File', $base_directory, {
    ensure => directory,
    owner  => $deploy_user,
    group  => $deploy_group,
  })

  ensure_resource('File', $website_directory, {
    ensure  => link,
    target  => $website_origin,
    owner   => $deploy_user,
    group   => $deploy_group,
    require => File[$base_directory],
    before  => Class['profiles::applications::nginx'],
  })

  class { 'profiles::applications::nginx': }

  nginx::resource::vhost { 'sinrumbofijo-vhost':
    ensure                => present,
    index_files           => ['index.php'],
    www_root              => $website_directory,
    server_name           => $website_hostname,
    access_log            => '/var/log/nginx/sinrumbofijo_access.log',
    error_log             => '/var/log/nginx/sinrumbofijo_error.log',
    client_max_body_size  => '16M',
    use_default_location  => false,
    include_files         => [
      'conf.shared/wordpress.conf',
      'conf.shared/restrictions.conf',
    ],
  }

  nginx::resource::upstream { 'php':
    members => [
      'unix:/var/run/php-fpm/php-fpm.sock',
    ],
  }

}
