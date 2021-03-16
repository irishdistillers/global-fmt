# Templates Checker

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
		"irishdistillers/templateschecker": "^SOME_VERSION",
	},
    ....
	"scripts": {
		....
		"templateschecker": [
			"./bin/templateschecker scan --dir_from=wordpress --dir_to=`pwd` --show=different,ok,missing"
		]
        ....
	}
}
```

## Report

Here is how a report looks like

```bash
> ./bin/templateschecker scan --dir_from=wordpress --dir_to=`pwd` --show=different,ok,missing


--------------------------------------------------------------------------------
[ OK ] /Projects/royal-salute.com/.editorconfig
► /Projects/vendors/templateschecker/templates/wordpress/.editorconfig

--------------------------------------------------------------------------------
[ OK ] /Projects/royal-salute.com/phpcs.xml
► /Projects/vendors/templateschecker/templates/wordpress/phpcs.xml

--------------------------------------------------------------------------------
[ OK ] /Projects/royal-salute.com/phpstan.neon
► /Projects/vendors/templateschecker/templates/wordpress/phpstan.neon

--------------------------------------------------------------------------------
[ OK ] /Projects/royal-salute.com/phpunit.xml
► /Projects/vendors/templateschecker/templates/wordpress/phpunit.xml

--------------------------------------------------------------------------------
[ OK ] /Projects/royal-salute.com/postcss.config.js
► /Projects/vendors/templateschecker/templates/wordpress/postcss.config.js

--------------------------------------------------------------------------------
[ DIFFERENT ] /Projects/royal-salute.com/README.md
► /Projects/vendors/templateschecker/templates/wordpress/README.md

--------------------------------------------------------------------------------
[ MISSING ] /Projects/royal-salute.com/test/test.php
► /Projects/vendors/templateschecker/templates/wordpress/test/test.php

--------------------------------------------------------------------------------
[ OK ] /Projects/royal-salute.com/wp-cli.yml
► /Projects/vendors/templateschecker/templates/wordpress/wp-cli.yml



========================================
 RESULT

[ MISSING ] 1
[ DIFFERENT ] 1
[ OK ] 6


Script ./bin/templateschecker scan --dir_from=wordpress --dir_to=`pwd` --show=different,ok,missing handling the code-sniff event returned with error code 1
```

The report is telling us that our current folder has 1 file which differ from the template files.
You should update your repo as soon possible.

## Useful Commands

`./vendor/bin/phpunit`

`./vendor/bin/phpstan analyse`

`./vendor/bin/phpcs .`
