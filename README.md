# 471_oilHaulingDB
# Setup (Vagrant):
1. download and install vagrant https://www.vagrantup.com
2. navigate to the folder where you've stored this repo. type "vagrant box add hashicorp/precise64". This will go through the process of adding the vagrant box configuration required to run this application locally
3. launch the vm by typing "vagrant up"
4. your server is now running and ready to use on port 4567.
5. Ensure that virtualization is enabled on you BIOS and virtualbox is installed in order to run the VM.

#Setup (Local Server):
1. Download and install apache server, configure to serve pages from localhost
2. copy the php files from this repository to the server directory (often /var/www)
3. download and install MySQL
4. run the database script located in this repo. This will set up all tables and initialize them with the values as described in the instruction manual
5. The application should now be ready to use by typing 'localhost' into your browswer.
