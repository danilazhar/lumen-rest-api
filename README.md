# Getting Started with lumen-rest-api
This rest-api project was created using Lumen. This is the rest-api for sending a red packet to the multiple receiver with equal amount or random amount.\
Lumen is micro-framework by [Laravel](https://lumen.laravel.com/)

Please run `composer install` after project was cloned.\
Please rename the `.env.example` file to `.env`


## Available Scripts

In the project directory, you can run:

`php artisan migrate` to migrate the database.\
`php artisan db:seed --class=UserTableSeeder` to seed user data to user table.

## API End-point

[GET] `api/packet` to get the list of packets created.

[POST] `api/packet` to create a packet with parameters. \
Parameters are as below : \
`sender_email`, `amount`, `quantity`, `random`

[POST] `api/packet/getTransaction` to get the packet transaction to receiver.
Parameter : `packet_id`
