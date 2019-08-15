# Eloquent S3 with Laravel Demo
This is a demo application showing how to use Eloquents S3 platform within a Laravel application.

## TLDR;
In order to get up and running quickly, simply replace the config for `s3` in `config/filesystems.php` with the following:
```
's3' => [
    'driver' => 's3',
    'key' => env('S3_ACCESS_KEY_ID'),
    'secret' => env('S3_SECRET_ACCESS_KEY'),
    'region' => 'eu-west-1',
    'bucket' => env('S3_BUCKET'),
    'endpoint' => env('S3_ENDPOINT'),
    'use_path_style_endpoint' => true,
],   
```
> NOTE: The region is redundant for our platform, however it is a required value for the AWS S3 driver. 
 
Following this, ensure you have created the relevant env variables and assigned them the appropriate values
based on the information provided by eloquent for your s3 instance.
 
## Running the demo
In order to run the demo, execute the following steps:

```
# clone the demo project
git clone https://github.com/Eloquent-Technologies/eloquest-laravel-s3-demo.git && cd eloquest-laravel-s3-demo

# install dependencies
composer install
npm install

# build assets
npm run dev

# copy the example env and generate an application key
php artisan key:generate

# run a local minio server within docker, taking note of the `AccessKey` and `SecretKey` in the output
docker run -it -p 9000:9000 minio/minio:RELEASE.2019-08-14T20-37-41Z server /data
```
The above `docker run` command will output an `AccessKey` and a `SecretKey`.

Using the values output from the above, set the following env variables in your `.env` file
```
FILESYSTEM_DRIVER=s3
S3_ENDPOINT=http://localhost:9000
S3_ACCESS_KEY_ID={Your_Access_Key}
S3_SECRET_ACCESS_KEY={Your_Secret_Key}
S3_BUCKET=app
```

Finally, server your application using `php artisan serve` and navigate to `http://localhost:8000` to view the 
demo application where you will be able to upload, download and delete files from your local minio instance.

## The demo code
All the code for this demo has been put straight into the `web.php` routes file for simplicity. In here you will
find the logic required to upload, download and delete files.

> NOTE: This is simply a demo implementation. In your applications you should carry out additional validation
> checks against the files being uploaded and also ensure that you are storing files using unique names.

In addition to this, the demo apps frontend view can be found in `resources/views/demo.blade.php` where you can
see the HTML for the upload form as well as the code to loop around the files currently stored on your local minio 
server. 
