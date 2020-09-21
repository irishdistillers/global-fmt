# global-fmt
Check that all the files in /templates are in /destination.
Track if files in /destination have changed.

This project helps if you have multiple sites that use the same files (that can be locally changed).
This project helps to flag the files that need to be kept in sync with centralised repository.

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
		"irishdistillers/global-fmt": "^SOME_VERSION",
	},
    ....
	"scripts": {
		....
		"global-fmt": [
			"DIR=$(pwd); php ./vendor/irishdistillers/global-fmt/application.php scan --dir_from=default --dir_to=$DIR --show=different,ok,missing"
		]
        ....
	}
}
```

## Report

The report looks like the following

```
[ DIFFERENT ] /templates/phpunit.xml
[ OK ] /templates/phpstan.neon
[ OK ] /templates/.editorconfig
[ MISSING ] /templates/phpcs.xml
```

## Useful Commands

`./vendor/bin/phpunit`

`./vendor/bin/phpstan analyse`

`./vendor/bin/phpcs .`
