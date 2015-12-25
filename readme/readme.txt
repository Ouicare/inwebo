In-Webo Web Services API PHP Development Kit V2.0.1

Copyright (c) 2014

This content is released under the MIT License.
See LICENSE.TXT file or go to http://www.opensource.org/licenses/mit-license.php.

Description
--------------------------
This package, provided by inWebo Technologies, includes a set of PHP sample code to integrate inWebo Authentication and Provisioning APIs in any PHP-based Web site.

Getting Started
--------------------------
Before you start writing code, you need to have an inWebo administrator account. You can get one at: https://www.myinwebo.com/signup 
When logged in to inWebo Administration Console, go to tab "Secure Sites". From this screen, you will be able to get:
- your inWebo Service ID
- WEB SERVICES API ACCESS certificate file

These 2 items are mandatory. Once your have them:

- Copy the content of the "src" directory in a directory on your web server
- Copy the certificate file in the "src/API" directory of the package
- Go the "src/resources" directory of the package :
  - rename settings-SAMPLE.php file in settings.php
  - edit the settings.php file
  - enter your Service ID
  - enter the certificate file name
  - enter the certificate passphrase
  - you may activate or deactivate debug traces