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
		"global-fmt": [
			"./vendor/irishdistillers/global-fmt/src/check"
			"./vendor/irishdistillers/global-fmt/src/install"
		],
        ....
	}
}
```

## Useful Commands

`./vendor/bin/phpunit`

`./vendor/bin/phpstan analyse`

`./vendor/bin/phpcs .`
