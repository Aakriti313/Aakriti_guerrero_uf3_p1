1. Use current project films as base project. 
2. Add a form 
    a. in welcome view mode POST to call createFilm route
        Modified script resources/views/films/welcome.blade.php 
3. Include a new route 
    a. as type post 
    b. with name createFilm 
    c. group route by prefix filmin
    d. Include a middleware ValidateUrl to be called before route
        Modified script routes/web.php
4. Create middleware 
    a. with name ValidateUrl
        Create script app/Http/Middleware/ValidateUrl.php with command: php artisan make:middleware ValidateUrl
    b. if url is not correct 
        i. go to welcome page showing proper error
            Modified script app/Http/Middleware/ValidateUrl.php
    c. Acivate middleware en kernel
            Modified script app/Http/Middleware/Kernel.php
5. Add funcions in FilmController 
    a. with name createFilm 
        i. check if film name exists calling isFilm funcƟon
        ii. if it does not exist, 
            1. add it and show all films calling listFilms funcƟon
        iii. if it exists, 
            1. go to welcome page showing proper error 
    b. with name isFilm 
        i. film name as input parameter 
        ii. check if name file is already in data 
        iii. return Boolean, true if exist, false if it does not exist 
    Modified script app/Http/Controllers/FilmController