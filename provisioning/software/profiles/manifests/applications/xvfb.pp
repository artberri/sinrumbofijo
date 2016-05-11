class profiles::applications::xvfb (
  $display = 99,
  $width   = 1280,
  $height  = 1024,
  $color   = '16+32',
) {

  class { 'display::xvfb':
    display => $display,
    width   => $width,
    height  => $height,
    color   => $color,
  }

  ensure_resource ('Package', [
      'gdk-pixbuf2',
      'gdk-pixbuf2-devel',
      'xorg-x11-fonts-75dpi',
      'libX11-devel',
      'libXext-devel',
      'libXinerama-devel',
      'libXi-devel',
      'libXrender-devel',
      'libXrandr-devel',
      'libXt',
  ], {
    ensure => present,
    before => Class[ 'display::xvfb'],
  } )

}
