# README #
This README documents the steps needed to create a local environment with Pattern Lab + Wordpress install running side-by-side. 

## PURPOSE ##
To serve as a starterkit for new Wordpress projects by providing the developer with a starterkit for Pattern Lab, and a starter child theme. 

## PREREQUISITES ##
* [Node](https://nodejs.org/en/)
* [npm](https://www.npmjs.com/)
* [Gulp](http://gulpjs.com/). It is recommended to upgrade to Gulp 4. See [Prerequisites for installing Gulp Edition of Pattern Lab](https://github.com/pattern-lab/edition-node-gulp) for more information. 

## PROJECT STRUCTURE ##
* `/patternlab/` - Contains Pattern Lab.
* `/site/` - Contains Wordpress.
* `/src/` - Contains shared assets such as sass and js files. 
* `gulpfile.js` - Runs tasks that interact with patternlab, site, and src.
* `package.json` - Installs dependencies to get started. 

Pattern Lab and Wordpress are installed in subdirectories from the root of the project. 

The third directory, `/src/` is where developers will work inside to build the project's patternlab and wordpress child theme.

In the root of the project is `gulpfile.js`. This file will run tasks that will compile sass and js and prepare them to be distributed into Pattern Lab and Wordpress.

## UPDATE PACKAGE.JSON ##
Before doing anything else, navigate to the package.json file included in the project, and change the value of "name" to whatever you want your theme folder to be called. If you don't complete this before running the initial "gulp init" task, you may encounter some errors.

## INSTALL PATTERN LAB ##
Pattern Lab is a static site generator. [There are many different ways to build a Pattern Lab site](https://github.com/pattern-lab/). 

The core of Pattern Lab is available in [PHP or Node](http://patternlab.io/download.html) - it us up to developers and their teams to choose which language they want to use to generate the static site. 

This tutorial focuses on how to install the [Gulp edition of Pattern Lab](https://github.com/pattern-lab/edition-node-gulp), which is written in Node. 

The Gulp edition uses Gulp tasks inside the Pattern Lab directory to generate the site when its source files change.

In the future, we hope to automate the download and configuration of Pattern Lab. 

### Step 1: Prepare your machine for Gulp 4 ###
It's highly recommended that you install gulp globally. 

Also, it's recommended you upgrade to Gulp 4, which may require a new global install of the Gulp command line interface. Learn more by referring to the [Prerequisites for installing Gulp Edition of Pattern Lab](https://github.com/pattern-lab/edition-node-gulp). Here is an excellent guide on [how to upgrade to Gulp 4](https://www.liquidlight.co.uk/blog/article/how-do-i-update-to-gulp-4/). 

### Step 2: Get Gulp Edition of Pattern Lab ###
There are two options for getting Pattern Lab
1. Download the repo from the github page, without cloning the repository
2. Include the repo from the github page as a submodule in your project

#### OPTION 1: DOWNLOAD PATTERN LAB ####
Go to the https://github.com/pattern-lab/edition-node-gulp to download the Repo or [click this link to download the master branch in a .zip file](https://github.com/pattern-lab/edition-node-gulp/archive/master.zip). 

#### OPTION 2: CLONE PATTERN LAB AS A GIT SUBMODULE ####
You may also include it as a git submodule. In the root of your repo for your new project, enter `git submodule add https://github.com/pattern-lab/edition-node-gulp.git`. This creates a new directory in the root of your project called `edition-node-gulp` that contains the Pattern Lab folders. 

Rename `edition-node-gulp` to `patternlab` by using the `git mv` command. For example, `git mv edition-node-gulp patternlab` renames the git submodule `edition-node-gulp` to simply `patternlab`. 

### Step 3: Install Pattern Lab ###
In the command line, change to the directory that contains Pattern Lab. Example: From the root of the project, run `cd patternlab`. 

Run `npm install` to install Pattern Lab. 

## INSTALL WORDPRESS ##
This tutorial assumes Wordpress will be installed in the `/site/` subdirectory from the root of the project. It is recommended to install Wordpress in a subdirectory to keep the project root neat and tidy. 

Please note that this is not a requirement. If you wish to install Wordpress in the root of the project rather than a subdirectory, the `gulpfile.js` file will need to be modified to update the path variables defined at the top of the file. 

There are two options to install Wordpress in a subdirectory: 
1. Place the Wordpress files in the subdirectory, `/site/` and run the installer so the domain resolves at `www.domain.com/site`. 
2. Place the Wordpress files in the root of the project and run the installer so the domain resolves at `www.domain.com`. The Codex demonstrates this method in the article, [Giving Wordpress Its Own Directory](https://codex.wordpress.org/Giving_WordPress_Its_Own_Directory).

This tutorial assumes Option 1. If this doesn't work for your workflow, you can follow the steps from the codex article referenced in Option 2. 

Once Wordpress is installed in the subdirectory, follow these steps:

1. Login to Wordpress, go to __Settings__ > __General__, and modify the field `Site Address (URL)` from "http://www.yourdomain.com/site" to "http://www.yourdomain.com". **Do not hit save yet**. 
2. Navigate to the `/site/` directory, **duplicate** `index.php` and `.htaccess` files so they read `index-copy.php` and `.htaccess-copy`. 
3. Move the duplicated files into the root of the project. 
4. Edit `index-copy.php` by modifying:
```require( dirname( __FILE__ ) . '/wp-blog-header.php' );```
to be
```require( dirname( __FILE__ ) . '/site/wp-blog-header.php' );```
5. Save `index-copy.php`. 
6. While in the root of the project, __rename__ `index-copy.php` and `.htaccess-copy` to `index.php` and `.htaccess`.
7. Go back to the open Wordpress screen and click save. 
8. Go to __Settings__ > __Permalinks__ and re-save. 

### References ###
* [Giving Wordpress Its Own Directory](https://codex.wordpress.org/Giving_WordPress_Its_Own_Directory)
* [How and Why Install WordPress Core in a Subdirectory](https://deliciousbrains.com/how-why-install-wordpress-core-subdirectory/) - for wp cli users

## DOWNLOAD EM-BASE THEME INTO WORDPRESS THEMES ##
After Wordpress is installed, [download the em-base parent theme](https://bitbucket.org/emagine-dev/em-base) and place it into the Wordpress themes directory


## INTEGRATE PATTERNLAB AND WORDPRESS WITH OUR SRC DIRECTORY ##
Now that Pattern Lab and Wordpress are installed in their own directories, the next steps are to:

1. Modify `gulpfile.js` in the root:

	```
	browserSync.init({
		proxy: "domain.dev", // Rename this to your desired domain name
		port: 3333
	});
	```	
2. Run `npm install` from the root of the project to install global project dependences
3. Run `gulp init`. This command executes the following:
	1. Downloads all vendor plugins such as picturefill, colorbox, slick carousel, etc. 
	2. Distributes vendor plugins into Pattern Lab and Wordpress, grouped into header scripts and footer scripts. 
	3. Executes the default `gulp` command for you which compiles sass and js, distribute those assets into Patternlab and Wordpress, builds the Pattern Lab site, and spins up two servers: one for Pattern Lab, and one for your site.

You are now ready to use Pattern Lab and Wordpress, while managing the shared assets in one location and having it push to both environments. 

Note that there are two Gulp files. One is inside the root of the project, and one comes with Pattern Lab node gulp edition. 

It is important to not modify the gulpfile inside the Pattern Lab directory because these assets are ignored in the repository. 

Instead, developers, can run any command from any gulpfile in any directory using the `--gulp` flag when executing a gulp command. 
Example: From the command line in the root of the project, run `"gulp --gulpfile /patternlab/gulpfile.js patternlab:build` to run a task defined in the Pattern Lab gulpfile. 

Any of the default commands can be run as long as the `--gulpfile` flag is present, followed by the path of the gulpfile you wish to call a task from.