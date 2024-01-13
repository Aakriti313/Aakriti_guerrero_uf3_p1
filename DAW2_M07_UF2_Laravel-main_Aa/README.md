Analysis
1. Routes
    1.1. What are they and their purpose?
        Son endpoints que sirvern para enviar una peticion que recive nuestra app.
    1.2. Where are they defined?
        routes/web.php: devolver paginas web i en routes/api.php: devolver valores.
    1.3. How many are there?
        4
    1.4. How do they group?
        Bajo un prefijo: es decir que antes de poner la ruta ha de tener antes el prefijo.
    1.5. Which prefix do they use?
        Filmuot
    1.6. Which parameters do they use?
        El año y el genero. (? = opcional).
2. Middleware
    2.1. What are they and their purpose?
        Validar peticiones de los datos de entrada a la peticion.
    2.2. Where are they defined?
        app/Http/Milddleware
    2.3. How many are there?
        10
    2.4. Which parameters do they use?
        year
    2.5. When are they invoked?
        Se invocan antes de las acceder al web.php , pero pueden invocarse después. 
3. Data
    3.1. Where are they defined?
        storage/app/public/films.json
    3.2. How are they read?
        En FilmController, con la funcion readFilms. Transforma el json en un array.
4. Controller
    4.1. What are they and their purpose?
        Recibir peticiones redirigirla a la peticion configurada y devolver datos a la vista.
    4.2. Where are they defined?
        app/http/FilmController.php
    4.3. How many are there?
        2. Por defecto y el de films.
5. View
    5.1. What are they and their purpose?
        Plantillas para generear html y su propoito es recibir info y enviarselo al cliente como html.
    5.2. Where are they defined?
        resources/views/films/list.blade.php
    5.3. How many are there?
        2. Welcome es la de por defecto y la otra es la que lista las peliculas.

Implementation
1. add fields country(string) and duration(int) to current data and adapt all components required to list them.
    Modified scripts storage/app/public/films.json and resources/views/films/list.blade.php
2. split current route 'films/{year?}/{genre?}' in two new routes filmsByYear and filmsByGenre, every one only receives its corresponding parameter
    Modified script routes/web.php
3. adapt current function listFilms in FilmController to have listFilmsByYear and listFilmsByGenre for previous defined routes.
    Modified script app/Http/FilmController.php
4. create a new route 'sortFilms' to list all films sorted by year descending, from newest to oldest.
    Modified scripts routes/web.php, app/http/FilmController.php and resources/views/films/welcome.blade.php
5. create a new route 'countFilms' to return total number of films on a new view counter
    Modified scripts routes/web.php, resources/views/films/welcome.blade.php and app/Http/NewController.php
