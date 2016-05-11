class profiles::applications::firefox($version = 'latest') {

  package { 'firefox':
    ensure => $version
  }

}
