# laravelFirstSite
## A programming-exercise

>1. Setup Laravel to work with Docker so the site can be published locally using its containers.
>2. A simple Login-System using Laravel Sanctum shall be implemented.
>3. Also, two Dummy-Users should be seeded in the database.
>4. After the login, implement a CSV-Upload to write its data to a seperate database table (Company-Name, First-Name, Last-Name, E-Mail, Phone-Number).

Notes:
I will be using the same MySQL container if that works and will try to stick to the MVC pattern.

Finished creating the Login-System as a POST only REST-API. [I did use this tutorial to do so.](https://www.laravelia.com/post/how-to-create-api-with-sanctum-authentication-in-laravel-10)

Now I want to make a simple HTML Form for the frontend to use these endpoints, but first let's see how to make the site "password-protected".

I tried installing Tailwind CSS using [this tutorial](https://tailkit.com/blog/how-to-add-tailwind-css-to-your-laravel-project) and npm, but it was not displaying right with gigantic vector graphics. In the end I just used a CDN to get it working.

Next I needed to implement [protected routes but I don't know if I can get it to work with the REST-API.](https://daily-dev-tips.com/posts/protecting-our-laravel-api-with-sanctum/)

[Here is a YT video for Laravel Sanctum SPA API Authentication](https://www.youtube.com/watch?v=8Uwn5M6WTe0)

The official Laravel Sanctum Docs have instruction for SPA Authentication but it is hard to follow.

## Instructions to start the app:
1. cd into the laravelFirstSite directory
2. run "./vendor/bin/sail up"
3. Attach shell to the sail container in VSCode
   and run "php artisan migrate && php artisan db:seed"
