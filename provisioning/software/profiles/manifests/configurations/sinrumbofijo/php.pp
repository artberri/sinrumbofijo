class profiles::configurations::sinrumbofijo::php {

  $extensions = {
    'pdo'         => {},
    'mysqlnd'     => {},
    'xml'         => {},
    'gd'          => {},
    'mbstring'    => {},
    'pecl-xdebug' => {},
  }

  $settings = {
    'PHP/memory_limit'        => '64M',
    'PHP/post_max_size'       => '16M',
    'PHP/upload_max_filesize' => '16M',
    'Date/date.timezone'      => 'Europe/Madrid',
  }

  class { 'profiles::applications::php':
    extensions => $extensions,
    settings   => $settings,
  }

}
