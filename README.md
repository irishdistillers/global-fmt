# global-fmt
Adds the necessary files to your GCMS project for the code to be "prettier" #cleanCode


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
		"global-fmt-check": "php ./vendor/irishdistillers/global-fmt/application.php check",
		"global-fmt-copy": "php ./vendor/irishdistillers/global-fmt/application.php copy"
        ....
	}
}
```

## Useful Commands

`./vendor/bin/phpunit`

`./vendor/bin/phpstan analyse`

`./vendor/bin/phpcs .`
