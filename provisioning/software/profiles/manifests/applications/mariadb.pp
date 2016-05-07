class profiles::applications::mariadb (
  $package_version,
  $repo_version,
  $override_options        = {},
) {

  $mysql_group             = 'mysql'
  $root_group              = 'root'
  $client_package_name     = 'MariaDB-client'
  $server_package_name     = 'MariaDB-server'
  $server_service_name     = 'mariadb'
  $manage_config_file      = true

  $socket                  = '/var/lib/mysql/mysql.sock'
  $log_error               = '/var/log/mariadb/mariadb.log'

  $config_file             = '/etc/my.cnf.d/server.cnf'

  $default_options = {
    'client'          => {
      'port'          => '3306',
      'socket'        => $socket,
    },
    'mysqld_safe'        => {
      'nice'             => '0',
      'log-error'        => $log_error,
      'socket'           => $socket,
    },
    'mysqld'                  => {
      'basedir'               => '/usr',
      'bind-address'          => $::fqdn,
      'datadir'               => '/var/lib/mysql',
      'expire_logs_days'      => '10',
      'key_buffer_size'       => '16M',
      'log-error'             => $log_error,
      'max_allowed_packet'    => '16M',
      'max_binlog_size'       => '100M',
      'max_connections'       => '151',
      'myisam_recover'        => 'BACKUP',
      'pid-file'              => '/var/run/mariadb/mariadb.pid',
      'port'                  => '3306',
      'query_cache_limit'     => '1M',
      'query_cache_size'      => '16M',
      'skip-external-locking' => true,
      'socket'                => $socket,
      'ssl'                   => false,
      'ssl-ca'                => '/etc/mysql/cacert.pem',
      'ssl-cert'              => '/etc/mysql/server-cert.pem',
      'ssl-key'               => '/etc/mysql/server-key.pem',
      'thread_cache_size'     => '8',
      'thread_stack'          => '256K',
      'tmpdir'                => '/tmp',
      'user'                  => 'mysql',
    },
    'mysqldump'             => {
      'max_allowed_packet'  => '16M',
      'quick'               => true,
      'quote-names'         => true,
    },
    'isamchk'      => {
      'key_buffer_size' => '16M',
    },
  }

  $options = merge($default_options, $override_options)

  ensure_resource('Group', $mysql_group, {
    ensure => present
  })

  file { '/var/log/mariadb':
    ensure  => 'directory',
    owner   => 'root',
    group   => $mysql_group,
    mode    => '0775',
    require => Group[$mysql_group]
  } ->

  file { '/var/run/mariadb':
    ensure => 'directory',
    owner  => 'root',
    group  => $mysql_group,
    mode   => '0775',
  } ->

  class { 'mariadbrepo':
    version => $repo_version,
  } ->

  exec { 'update-packages':
    command => 'yum check-update',
    path    => $::path,
    returns => [0, 100]
  } ->

  class { 'mysql::server':
    config_file             => $config_file,
    manage_config_file      => $manage_config_file,
    override_options        => $options,
    package_ensure          => $package_version,
    package_name            => $server_package_name,
    remove_default_accounts => true,
    root_group              => $root_group,
    root_password           => 'root',
    service_enabled         => true,
    service_manage          => true,
    service_name            => $server_service_name,
  } ->

  class { 'mysql::client':
    package_name   => $client_package_name,
    package_ensure => $package_version
  }

}
