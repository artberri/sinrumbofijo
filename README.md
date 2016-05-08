# Blog SinRumboFijo.com Code

[![Build Status](https://snap-ci.com/artberri/sinrumbofijo/branch/master/build_image)](https://snap-ci.com/artberri/sinrumbofijo/branch/master)

## Dev Environment

```
vagrant up
vagrant ssh
cd /vagrant/sinrumbofijo
bundle exec librarian-puppet install
sudo puppet apply --modulepath=/vagrant/sinrumbofijo/modules -e "include roles::websites::sinrumbofijo"
```
