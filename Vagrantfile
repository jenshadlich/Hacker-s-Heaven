# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    if Vagrant.has_plugin?("vagrant-cachier")
        config.cache.scope = :box
    end
    if Vagrant.has_plugin?("vagrant-hostmanager")
        config.hostmanager.enabled = true
    end

    config.ssh.forward_agent = true
    config.ssh.insert_key = false
    config.vm.box = "ubuntu/trusty64"

    config.vm.network :forwarded_port, guest: 8080, host: 8080, auto_correct: true # http
    #config.vm.network :forwarded_port, guest: 3306, host: 3306, auto_correct: true # mysql

    config.vm.hostname = "hackers-heaven"
    config.vm.network :private_network, ip: "192.168.42.12"

    config.vm.provider 'virtualbox' do |v|
        v.customize ['modifyvm', :id, '--name', 'hackers-heaven']
        v.customize ['modifyvm', :id, '--cpus', '2']
        v.customize ['modifyvm', :id, '--memory', 2048]
    end

    config.vm.synced_folder "apache2/", "/home/vagrant/hackers-heaven/apache2"
    config.vm.synced_folder "mysql/", "/home/vagrant/hackers-heaven/mysql"
    config.vm.synced_folder "src/", "/home/vagrant/hackers-heaven/src"

    config.vm.provision 'shell', path: 'provision.sh'

end