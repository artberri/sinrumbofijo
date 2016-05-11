class roles::websites::sinrumbofijo () {

  class { 'profiles::applications::oracle_java8': } ->

  # class { 'profiles::applications::xvfb': } ->

  class { 'profiles::applications::firefox': } ->

  class { 'profiles::configurations::sinrumbofijo::mariadb': } ->

  class { 'profiles::configurations::sinrumbofijo::php': } ->

  class { 'profiles::configurations::sinrumbofijo::nginx':
    deploy_user       => 'vagrant',
    deploy_group      => 'vagrant',
    website_hostname  => ['sinrumbofijo.local'],
    website_origin    => '/vagrant/sinrumbofijo/src',
  }

}
