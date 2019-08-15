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


# run a local minio server within docker
docker run -it -p 9000:9000 minio/minio:RELEASE.2019-08-14T20-37-41Z server /data


```
