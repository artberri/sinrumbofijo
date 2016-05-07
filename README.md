```
cd /vagrant/sinrumbofijo
bundle exec librarian-puppet install
sudo puppet apply --modulepath=/vagrant/sinrumbofijo/modules -e "include roles::websites::sinrumbofijo"
```
