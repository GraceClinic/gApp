# gApp
Grace Training Application

#Setup
* Install PHP 5.6+
* [Install Zend Framework 1.12.x](http://framework.zend.com/downloads/latest)
* Add a [hosts](https://en.wikipedia.org/wiki/Hosts_(file)#Location_in_the_file_system) file entry for 
  * 127.0.0.1 gco.api
* Host the "public" folder on a web server such as an Apache virtual host.
```
## gApp Virtual Host
<VirtualHost *:80>
	ServerName www.gapp.com
	DocumentRoot "C:/webserver/webroot/gapp/public"
	SetEnv APPLICATION_ENV development
	<Directory "C:/webserver/webroot/gapp/public">
		DirectoryIndex index.php
		Options Indexes MultiViews FollowSymLinks
		AllowOverride All
		Order Allow,Deny
    	Allow from all
	</Directory>
</VirtualHost>
## webroot Virtual Host
<VirtualHost *:80>
	ServerName webroot.local
	DocumentRoot "C:/webserver/webroot"
	SetEnv APPLICATION_ENV development
	<Directory "C:/webserver/webroot">
		DirectoryIndex index.php
		Options Indexes MultiViews FollowSymLinks
		AllowOverride None
		Order allow,deny
    		Allow from all
	</Directory>
</VirtualHost>
```
* Within the local web server deployment directory, create application.log file within "\data\logs\" directory

#GitHub Proper Usage
GitHub is a powerful and effective change control tool; however, that is only true when all team members use it properly.

##Cloning Repository
1. Create a fork of the GraceClinic/gApp repository
  * Goto repository location:  https://github.com/GraceClinic/gApp
    * Select "Fork" and create to your local account
	* Validate your new fork within your GitHub account
1.  Create a new PHPstorm project connecting to your GitHub fork
  * Select "VCS | Checkout from Version Control | GitHub"
  * Enter your GitHub gApp repository fork URL
    * example:  https://github.com/GraceClinic/gApp.git
  * Click "Clone"
  * Set up your External Libraries connection for PHP
    * right-click External Libraries from left control pane, select "Configure PHP include paths"
    * select your PHP interpreter (should be 5.6) and point to your include paths for Zend
  * If your local deployment directory is different than your PHPstorm project directory, configure Deployment location
    * Select "Tools | Deployment | Configuration"
    * Configure per your local deployment location (Mappings tab must show "\" in Deployment path field if it is the same location identified in "Local Path")
    * Deploy files
  * Select "VCS | Git | Rebase my GitHub fork"
    * This will create a connection to the GitHub original gApp repository.  You will now see it listed under your "Remote Branches" as "upstream/master" along with your forked version of this repository listed as "origin/master".
1.  Configure your local system for development per above Setup

##Preparing for Pull Request
1.  Commit changes to your "origin" (your forked repository)
  * You can create branches as you like in your forked repository.
  * The managers of the gApp repository will be able to review your "origin/master", they cannot view your local changes.  Commit frequently to give them ability to review as needed.
1.  Rebase your GitHub fork
  * First make sure that you have committed all changes to your "origin/master".
  * Next, select "VCS | Git | Rebase my GitHub fork".
  * Correct any merge conflicts
    * Your "origin/master" is now behind and on a branch of its own.  You can see this by comparing your recent merged files to the "origin/master" or looking at the branch time line at bottom of PHPstorm (Changes:Log).  The timeline will show that your "origin/master" diverges from your local repository and "upstream/master".  
<p align="center">
<img src="https://github.com/GraceClinic/GCOv2API/wiki/assets/pics/OriginMaster-Behind.PNG" alt="" title="Origin Master Behind after Fork Rebase">
</p>
    * Select "VCS | Update Project".  This will allow you to service any merge conflicts with "origin/master" and bring it up to speed.  Here resolution is easy, you accept all of your local changes because you have already worked the true merge conflicts during the rebase fork operation.
  * Select "VCS | Git | Push" to send all of your newly merged files to "origin/master"
1.  Create "Pull Request" to merge your changes into "upstream/master".
  * Go to your GitHub forked repository and create "New pull request".
    * Make sure you are comparing your master branch with the GraceClinic/GCOv2API/master branch.  It should show "Able to merge" if you properly worked your merge conflicts when you rebased the fork.  Do not make a pull request if it does not show this.
    * Click "Create pull request".
    
##Reacting to Merged Pull Request
1. Successful completion of Pull Request
1. The repository manager will merge all pull requests as appropriate and send the team a notification.
1. In preparation for updating your fork with the new content, commit any changes to your "origin/master" whenever you receive notice of a new merge.
1. Execute "VCS | Git | Rebase my GitHub fork".  Work any conflicts within your forked repository.  This will keep you aligned with the latest development code base.
1. Select "VCS | Git | Push" to send the merge request commit to your "origin/master".  
  * If you were the one initiating the original pull request, and you have not made any new changes to your local code base, in your "Changes:Log" at the bottom of PHPstorm, you will see something magical:  HEAD, master, origin/master, and upstream/master all at the same point in the branch timeline.  Take a picture to remember that moment.
<p align="center">
<img src="https://github.com/GraceClinic/GCOv2API/wiki/assets/pics/All-repos-align.PNG" alt="" title="Origin Master Behind after Fork Rebase">
</p>
