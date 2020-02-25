
## About

API what grab rss feeds


## Running the API

It's very simple to get the API up and running. First, create the database (and database
user if necessary) and add them to the `.env` file.

```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_password
```

Then install, migrate, seed, all that jazz:

1. `composer install`
2. `php artisan migrate`
3. `php artisan db:seed`
4. `php artisan serve`

The API will be running on `localhost:8000`.

## Use the API

# Work with rss Posts
GET `/api/posts` return all posts from all feeds
GET `/api/posts/{ID}` return post with {ID}
GET `/api/posts/{ID}/all` return all posts from feed with {ID}
POST `/api/posts` with json like 
`{
    "title": "",
    "description": "",
    "link": "",
    "guid": "",
    "feeds_id": "",
	"created_at": "0000-00-00 00:00:00",
	"updated_at": "0000-00-00 00:00:00"
}`
create post
PUT `/api/posts/{ID}` with json like 
`{
    "title": "",
    "description": "",
    "link": "",
    "guid": "",
    "feeds_id": "",
	"created_at": "0000-00-00 00:00:00",
	"updated_at": "0000-00-00 00:00:00"
}`
update post with {ID}
DELETE `/api/posts/{ID}` delete post with {ID}

# Work with rss Feeds
GET `/api/feeds` return all feeds
GET `/api/feeds/{ID}` return feed with {ID}
POST `/api/feeds` with json like 
`{
    "name": "",
    "description": "",
    "url": "",
    "url_rss": "",
    "pub_time": "0000-00-00 00:00:00",
	"created_at": "0000-00-00 00:00:00",
	"updated_at": "0000-00-00 00:00:00"
}`
create feed
PUT `/api/feeds/{ID}` with json like 
`{
    "name": "",
    "description": "",
    "url": "",
    "url_rss": "",
    "pub_time": "0000-00-00 00:00:00",
	"created_at": "0000-00-00 00:00:00",
	"updated_at": "0000-00-00 00:00:00"
}`
update feed with {ID}
DELETE `/api/feeds/{ID}` delete feed with {ID}

## Cron job

If you added to crontab `* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1` System will every hour get new posts from all feeds.
Or you can run it manualy `php artisan posts:get`
