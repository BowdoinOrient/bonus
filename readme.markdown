# The Bowdoin Orient
## B.O.N.U.S. 2.0

The Orient website has been online since sometime in the late 1990s, with earliest extant content dating back to September 2000. It previously underwent major revisions in 2001, 2004, and 2009. In 2004, it switched from static HTML to a PHP/MySQL web app. The 2009 revision was purely cosmetic; now, for the first time in 8 years, it is being rewritten from scratch.

## Setup
The only supported development environment is OSX >=10.8. To get started:

* Install [Homebrew](http://mxcl.github.io/homebrew/)
* Install MySQL from Homebrew: `brew install mysql`
* Install Git from Homebrew: `brew install git`
* `cd` to the directory you want the Bonus folder to live in (it doesn't matter where, but I use  `~/code/`)
* [Fork this repository.](https://github.com/BowdoinOrient/bonus/fork)
* Clone your fork: `git clone git@github.com:your_user_name/bonus.git`
* `cd bonus`
* `./setup.sh`
* Choose whether or not to overwrite your httpd/php confs. If you don't, be aware you may need to manually enable PHP short tags, etc.
* Type your password once or twice
* Aquire an SQL dump (either by `mysqldump`ing medved or by pulling the compressed backup from S3) and populate your local database
* Email [@bjacobel](mailto:bjacobel@gmail.com) so he can talk you over development procedures
* Start writing code