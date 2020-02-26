
## About

API what grab rss feeds


## Running the API

It's very simple to get the API up and running. First, create the database (and database
user if necessary) and add them to the `.env` file.

```
APP_ENV=local
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_password
```

Then install, migrate, seed, all that jazz:

1. `composer install`
2. `php artisan migrate`
3. `php artisan serve`

The API will be running on `localhost:8000`.

## Use the API

### Work with rss Posts
1. GET `/api/posts` return all posts from all feeds  
2. GET `/api/posts/{ID}` return post with {ID}  
3. GET `/api/posts/{ID}/all` return all posts from feed with {ID}  
4. POST `/api/posts` with json like  
`{
    "title": "",
    "description": "",  
    "link": "",
    "guid": "",
    "feeds_id": ""
}` create post  
5. PUT `/api/posts/{ID}` with json like 
`{
    "title": "",
    "description": "",
    "link": "",
    "guid": "",
    "feeds_id": ""
}` update post with {ID}  
6. DELETE `/api/posts/{ID}` delete post with {ID}  

### Work with rss Feeds
1. GET `/api/feeds` return all feeds  
2. GET `/api/feeds/{ID}` return feed with {ID}  
3. POST `/api/feeds` with json like 
`{
    "name": "",
    "description": "",
    "url": "",
    "url_rss": "",
    "pub_time": "0000-00-00 00:00:00"
}` create feed  
4. PUT `/api/feeds/{ID}` with json like 
`{
    "name": "",
    "description": "",
    "url": "",
    "url_rss": "",
    "pub_time": "0000-00-00 00:00:00",
}` update feed with {ID}  
5. DELETE `/api/feeds/{ID}` delete feed with {ID}  

## Cron job

If you added to crontab `* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1` System will every hour get new posts from all feeds.  
Or you can run it manualy `php artisan posts:get`

## Rss what used for tests
`https://habr.com/ru/rss/best/daily/?fl=ru`
`https://medium.com/feed/@kamerk22`


## TODO
1. ~~Make especial RequestType for request and separate Validation from controller~~ 2020.02.26 Doing 
2. ~~Validate all Values coming from user or feed~~ 2020.02.26 Doing 
3. Enable authorisation
4. Write unit tests