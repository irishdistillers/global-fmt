# passportscotch.com

[![Dashboard passportscotch.com](https://img.shields.io/badge/dashboard-passportscotch.com-yellow.svg)](https://dashboard.pantheon.io/sites/149096e3-68e5-4bda-bf51-a924f2f60d66#dev/code)
[![Dev Site passportscotch.com](https://img.shields.io/badge/site-passportscotch.com-blue.svg)](http://dev-passportscotch.com.pantheonsite.io/)

# Before you do anything; prerequisites

## prerequisite 1: PHP >= 7.2

Check your php cli version with `php -v` if it's less than 7.2 you need to upgrade it:

If you're on a Mac, [Homebrew](https://brew.sh/)
PHP >= 7.2, if you're on a mac you'll need to run:
```
brew update
brew install php
```
Then close your terminal, and restart it and check with `php -v` again.

If it doesn't say you've updated but your sure it has. Check it here:
```
/usr/local/bin/php -v
```
If that references a newer version, refer here: https://tommcfarlin.com/running-multiple-versions-of-php-with-homebrew/

## prerequisite 2: toolset

You will need the following installed:
1. [composer](https://getcomposer.org/doc/00-intro.md)
2. [yarn](https://classic.yarnpkg.com/en/docs/install/#mac-stable)
3. [terminus](https://irishdistillers.atlassian.net/wiki/spaces/IR/pages/1098809345/Running+GlobalCMS+sites+locally)
4. [Localdev](https://pantheon.io/docs/localdev) tool from Pantheon.

## prerequisite 3: Credentials

### Configure BitBucket access via public / private key

1. Open terminal and copy your public key to the clipboard `pbcopy < ~/.ssh/id_rsa.pub`
2. In Bitbucket click your initials on the bottom left, and go to Your Profile -> Personal Settings -> SSH keys
3. Click `Add key`, give it a name like "Bens laptop", paste in the key, and click `Add`

### Configure BitBucket access via keys and secret (yes you need to do this too)

1. Log in to https://bitbucket.org/, click on your profile icon in the bottom left corner, and open your personal workspace (ie: https://bitbucket.org/hermannkaser/).
2. Open Settings -> OAuth Consumers -> Add a consumer
3. Enter a name (eg: composer), a dummy callback url (eg: https://example.com/callback), tick "This is a private consumer", and allow the Repositories "Read" permission.
4. Save and note the `Key` and `Secret`.
5. Run the following commands with the relevant `Key` and `Secret`
```
composer config -g bitbucket-oauth.bitbucket.org [key] [secret]
```

### AWS access

This is on a per project basis. Contact the project owner to get a key and secret to use. Notes on where to use these  in *Getting Started* below.

### license keys

License keys need to be stored in the `.env` file. Contact the project owner to get these. Notes on where to use these  in *Getting Started* below.


# Get started

1. Launch `Localdev` and pull & start the site
2. `cd ~/Localdev/passport-scotch`
3. `git remote add origin git@bitbucket.org:pernod-ricard-brandcos/passportscotch.com.git` to switch to the Bitbucket repo
4. If you get a `fatal: remote origin already exists.`, run `git remote rm origin` and try step 3 again.
5. `git fetch`
6. `git reset --hard origin/master` to get the Bitbucket repository
7. Create a `.env` file, based on the sample `.env.sampl` with the proper license keys
8. `composer global require naderman/composer-aws` to install the AWS composer package
9. `composer global update` to update your local package (especially GuzzleHttp which has to be 7.x)
10. Add S3 credentials to `~/.aws/credentials` (see format below)
11. `composer build-assets` to install everything PHP-related (it also runs yarn install)
12. `yarn dev` to build the global-theme
13. In `Localdev` -> do a Pull of the database & files **not** the code
14. If you get a "500 Internal Server Error" signed by Nginx, do a Localdev -> Force rebuild

Example of the `~/.aws/credentials` file:
```
[default]
aws_access_key_id = YOUR_KEY
aws_secret_access_key = YOUR_SECRET
```

# Before commiting

1. (optional) Run auto-formatting scripts to fix most formatting issues
   ```
   composer code-format
   ```
2. Run the sniff tasks and fix the errors
	```
	composer code-sniff
	```
3. Run unit test
	```
	composer unit-test
	```
4. Run Linting
	```
	composer lint
	```

# Our Story page images

The Our Story page requires SVG images to be animated. These images that can be exported from the studio's PSDs require some classes and data fields to be added before they can be animated.

SVG Images:

`animate` class has to be added to every element that needs animating

`data-animate-order="${number}"` needs to be added to every element that needs animating. This is the order in which it’s going to be animated. Change the number for each element.

SVG Titles:

`data-width="100%"`, `data-top="100px"` and `data-text-margin-top="140px"` needs to be added to the SVG tag. `data-width` pertains to the width of the container element, i.e. how much of the block the title should cover. `data-top` pertains how far up/down the title should be placed - this needs to be tested. `data-text-margin-top` pertains to how far down the block text (description) should be from the the SVG title. These three fields will need to be tested manually by the developer.

`animate` class has to be added to every element that needs animating

`data-animate-order="${number}"` needs to be added to every element that needs animating. This is the order in which it’s going to be animated. Change the number for each element.