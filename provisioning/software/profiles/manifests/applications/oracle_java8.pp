class profiles::applications::oracle_java8 {

  class { 'jdk_oracle':
    version => '8'
  }

}
