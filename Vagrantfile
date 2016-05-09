# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.define "sinrumbofijo.local" do |tm|
    tm.vm.box = "bento/centos-7.1"
    tm.vm.hostname = "sinrumbofijo.local"

    tm.vm.network "private_network", ip: "10.10.10.10"

    tm.vm.synced_folder ".", "/vagrant", disabled: true
    tm.vm.synced_folder ".", "/vagrant/sinrumbofijo",
      type: "nfs",
      nfs_udp: false,
      mount_options: ['rw', 'tcp', 'nolock', 'noacl', 'async', 'vers=3', 'fsc' ,'actimeo=2']

    tm.vm.provider "virtualbox" do |vb|
      #   # Display the VirtualBox GUI when booting the machine
      #   vb.gui = true
      #
      #   # Customize the amount of memory on the VM:
      vb.memory = "1024"
      vb.cpus = 1
      vb.customize ["modifyvm", :id, "--name", "sinrumbofijo.local"]
      vb.customize ["modifyvm", :id, "--usb", "off"]
      vb.customize ["modifyvm", :id, "--usbehci", "off"]
    end
  end

  config.vm.provision "shell" do |sh|
    sh.keep_color = true
    sh.privileged = false
    sh.path = 'provisioning/setup.sh'
  end

end
