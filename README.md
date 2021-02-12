# global-templateschecker

## Why ? 

Manage a set of files (templates) used in multiple repositories from a single place.

This project helps if you have multiple sites that use the same files (that can be locally changed).

## Installation

Adds the folllowing to your project composer.json

```json
{
	...
	"repositories": [
		....
		{
			"type": "composer",
			"url": "https://satis.idlcloud.com/"
		},
		....
	],
	"require": {
		"irishdistillers/global-templateschecker": "^SOME_VERSION",
	},
    ....
	"scripts": {
		....
		"global-templateschecker": [
			"./bin/global-templateschecker scan --dir_from=wordpress --dir_to=`pwd` --show=different,ok,missing"
		]
        ....
	}
}
```

## Ignore a file 

You can ignore system file like .DS_Store (or any other annoying files).
To ignore a file simply add it to the {TEMPLATE_DIR}/.gitgnore 

## Report

Here is how a report looks like 

```bash

> ./bin/global-templateschecker scan --dir_from=wordpress --dir_to=`pwd` --show=different,ok,missing


[ OK ] /Volumes/shakushaku/Projects/vendors/global-templateschecker/templates/wordpress/.editorconfig
[ OK ] /Volumes/shakushaku/Projects/vendors/global-templateschecker/templates/wordpress/phpcs.xml
[ OK ] /Volumes/shakushaku/Projects/vendors/global-templateschecker/templates/wordpress/phpstan.neon
[ OK ] /Volumes/shakushaku/Projects/vendors/global-templateschecker/templates/wordpress/phpunit.xml
[ OK ] /Volumes/shakushaku/Projects/vendors/global-templateschecker/templates/wordpress/postcss.config.js
[ DIFFERENT ] /Volumes/shakushaku/Projects/vendors/global-templateschecker/templates/wordpress/README.md
[ OK ] /Volumes/shakushaku/Projects/vendors/global-templateschecker/templates/wordpress/wp-cli.yml


-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
 RESULT 

[ MISSING ] 0
[ DIFFERENT ] 1
[ OK ] 6
Script ./bin/global-templateschecker scan --dir_from=wordpress --dir_to=`pwd` --show=different,ok,missing handling the code-sniff event returned with error code 1
```

The report is telling us that our current folder has 1 file which differ from the template files. 
You should update your repo as soon possible. 

## Useful Commands

`./vendor/bin/phpunit`

`./vendor/bin/phpstan analyse`

`./vendor/bin/phpcs .`
