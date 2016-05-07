class profiles::configurations::sinrumbofijo::mariadb {

  $mariadb_package_version = '10.1.13-1.el7.centos'
  $mariadb_repo_version = '10.1'

  class { 'profiles::applications::mariadb':
    package_version  => $mariadb_package_version,
    repo_version     => $mariadb_repo_version,
  }

  mysql::db { 'sinrumbofijo':
    user     => 'sinrumbofijo',
    password => 'sinrumbofijo',
    host     => 'localhost',
    grant    => 'ALL',
  }

}
