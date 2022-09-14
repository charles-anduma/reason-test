# Reason Digital PDT test

## About this test
Hello - Welcome to our Technical Task!

There is no 'right' or 'wrong' answer to this task; we use this it determine your familiarity with some of the tech we use, and how you go about architecting and writing code. As such we’d like you to write code to standard you’d be happy with, but not to feel under pressure to make it ‘perfect.’

For Junior roles we expect you to be able to attempt everything in the ‘Things we are Looking for' section. For Mid and Senior roles we expect to see you also add at least some of the 'Things that Would be Nice'

There is no time limit as such, but we'd appreciate it if you could respond within the **next three days**. If this will not be possible then please let us know when we can expect a response.

### Requirements
Create a Laravel based API in PHP that does the following:

- Has endpoints for getting the weather from the [https://www.weatherapi.com/](https://www.weatherapi.com/) API – with parameters to select a location     
- Secure the endpoint using username / password authentication (need login endpoints)     
- Use JWT tokens for authentication     
- Upload to a code repository and send us a link

### Things we are looking for
- We are looking for how you architect the code and how you choose to write it.
- We are looking for clean, readable code.
- We are looking for code comments that show your thinking.
- We are looking for best practice following SOLID and DRY principles.

### Things that would be nice
- You can deploy it to a free PHP host and send Postman information.
- You can add HAL links to the API.
- PHP Unit tests for the endpoints.
- Demonstration of advanced knowledge of Laravel.

As stated in the introduction - there isn’t one single ‘right’ solution that we are looking for. This task is set up to assess your skills and to give us an insight into your working process.

Please submit code that you would be proud to share and think accurately represents your method and coding quality.

We will chat over your solution at interview. As well as the output of the exercise we are also interested in your reflections on it - so please don’t let perfect be the enemy of done!

Please let us know if anything is unclear, or if you have any further questions by responding directly to the email this was attached to

## Local set up
For local development we use [DDEV](https://ddev.readthedocs.io/en/stable/). The instructions below are for getting setup. If you want to use something else that's fine.

### Creating the environment
The first step is to run `ddev start` which will create the environment.

Laravel uses `.env` files to store its configuration. Copy the `.env.example` to `.env`. The example has everything you need to get up and running with a database.

Next you'll need to set an application key for Laravel. To do this run `ddev ssh` to gain access to the web container. Then run `php artisan key:generate` to generate the key. This will be written to your `.env` file.

NOTE: You can run any command outside of the container using the `ddev exec` command followed by the command you want to run.

### Running tests
The test suite can be found in the `/tests` directory. Currently, there are two working tests and several broken ones.

To run the test suite `ddev ssh` and then run `vendor/bin/phpunit`.

See the @todos for the tests that need to be fixed.

NOTE: If you have database structures you need in the test database you can add `--env=testing` on any command to run them against the test database. This works for running migrations.