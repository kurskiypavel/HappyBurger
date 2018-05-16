# HappyBurger

This work is an updating dynamic website to let users to leave a product reviews. More details about implemented features read [here](#implemented-functionality).

![](https://i.imgflip.com/2aewh5.gif)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

* Download and install MAMP or MAMP PRO to run the local server on your machine

[MAMP or MAMP PRO](https://www.mamp.info/en/)

* Set these properties to the local server

```
Server Name: localhost
Admin: root
Password: root
Database Name: happyburger
```

* Clone this repo on your local server

* Import SQL DB from dump file HappyBurger_dump.sql

* Run web-server and MySQL using MAMP

* Congrats! Good Job! Now you're all set and good to go.

* Open homepage in the browser

* Use these registered users to login and try to play around

Alejandro Sanabria
```
Login: alejandro sanabria
Password: alejandro-sanabria
```
Chris Fidao
```
Login: chris-fidao
Password: chris-fidao
```
Dries Vints
```
Login: dries vints
Password: dries-vints
```

## Implemented Functionality

### User Profile Management

Registration is available for new users. After registration is completed, User will be authenticated automatically. For existing users, authorization and profile data change opportunities are available:
* avatar
* birthdate
* first name/username - automatically updates for existing session on submit
* phone number
* gender
* notification rules

### Product Catalog Rendering

Displays a list of products with image, description, and price.

### Product Information Rendering

Display product image, description, price, average rating based on user feedback of the product. Display a list of product reviews.

### Product Reviews

Registered and authorized User can leave a feedback about the product on product page. To create a review, the User must specify the review text and the product rating on a scale from 0 to 100 (the default value is 50). 

The star icon fills depending on the rating given by user. For reviews with a rating of more than 50 star will be filled full. For reviews with a rating greater than or equal to 30 but less than or equal to 50 star will be filled half full. For everything else, the star will not be filled at all.

For each review in the list of reviews are displaying: the author's avatar, the author's name, the review text, the rating of the product, how long time ago the review was left, and the star icon.
An authorized user can delete his own reviews on the product page.

### Search bar autocomplete

Displays product names in dropdown list of the search bar on navigation panel that matched to user's input in the search bar.


# Project Files

## PHP

### Partials

````
config.php - holds sql connection string 
head_sources.php - holds links to css files and frameworks
header.php - page header
bottom_sources.php - holds links to JS files and frameworks
````

### Pages

````
index.php - home page
products.php - product catalog page
product.php - product page
login.php - authentication (sign in) page
register.php - sign up page
user.php - user account management page
````

### Callbacks

```
logout.php - session destroy and logout callback
ajax-results.php -  callback to get product name suggestions for autocomplete
```

## CSS

```
style.css - holds all custom styles
```
 
## JavaScript

```
main.js - contains all custom javascript logic
```

## Project Folders

```
/js - all javascript files
/css - all css files
/images - all images
/images/products - product images
/images/users - user avatar images
/callbacks - callback php files
```

## Built With

### Style

* [Materialize CSS](https://materializecss.com)
* [Moment.js](http://momentjs.com)

### Front End

[jQuery v.3.3.1](https://code.jquery.com/jquery-3.3.1.min.js)

### Back End

PHP 7

### Database

MySQL v.5.6.35

## Authors

**Paul Kurski** - [kurskiypavel](https://github.com/kurskiypavel)
