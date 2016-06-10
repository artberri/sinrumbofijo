# Blog SinRumboFijo.com Code

[![Build Status](https://snap-ci.com/artberri/sinrumbofijo/branch/master/build_image)](https://snap-ci.com/artberri/sinrumbofijo/branch/master)

## How To Setup Dev Environment

```
vagrant up
vagrant ssh
cd /vagrant/sinrumbofijo
bundle exec librarian-puppet install
sudo puppet apply --modulepath=/vagrant/sinrumbofijo/modules -e "include roles::websites::sinrumbofijo"
```

## License

Blog SinRumboFijo.com Code
Copyright (C) 2016 Alberto Varela

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

