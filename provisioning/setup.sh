#!/bin/bash
export PATH=$PATH:/usr/local/bin

sudo echo 'Etc/UTC' > /etc/timezone

echo "[Provisioning Script] Adding the PuppetLabs Source.."
sudo yum -y install http://yum.puppetlabs.com/el/7/products/x86_64/puppetlabs-release-7-11.noarch.rpm

echo "[Provisioning Script] Installing Puppet.."
sudo yum -y install puppet-3.8.7-1.el7

echo "[Provisioning Script] Stopping the Puppet Service.."
sudo service puppet stop

echo "[Provisioning Script] Installing librarian-puppet"
sudo yum -y install git gcc ruby-devel rubygems
sudo gem install bundler
cd /vagrant/sinrumbofijo
bundle install --path vendor/bundle

echo "[Provisioning Script] Installing puppet modules"
bundle exec librarian-puppet install

echo "[Provisioning Script] - Running puppet"
sudo puppet apply --modulepath=/vagrant/sinrumbofijo/modules -e "include roles::websites::sinrumbofijo"