class profiles::applications::nginx {

  file { '/etc/nginx/conf.shared':
    ensure  => directory,
    owner   => 'root',
    group   => 'root',
    require => File['/etc/nginx'],
  } ->

  file { '/etc/nginx/conf.shared/wordpress.conf':
    ensure  => file,
    owner   => 'root',
    group   => 'root',
    source  => 'puppet:///modules/profiles/nginx/wordpress.conf',
  } ->

  file { '/etc/nginx/conf.shared/restrictions.conf':
    ensure  => file,
    owner   => 'root',
    group   => 'root',
    source  => 'puppet:///modules/profiles/nginx/restrictions.conf',
  }

  class { '::nginx':
    service_ensure => running,
  }

}
