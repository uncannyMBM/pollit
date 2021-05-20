## Poll it is a poll free poll application
##### you can easily share with friends, family, colleagues at work, and the world. No sign up required.

### How to install the project?
After downloading the project form this repository go to the project directory and open cmd prompt or terminal and run

<pre>composer update</pre>
Run the above command to download all dependencies.

#### Configure project environment
To configure the project environment just copy .env.example file and paste it and rename it with .env

#### Generate app key
To run the project you need to generate the app key. Go to the cmd prompt or terminal and run 
<pre>php artisan key:generate</pre>

#### Configure database
Go to .env file and change below lines

DB_DATABASE=your_database_name
<br>
DB_USERNAME=your_database_username
<br>
DB_PASSWORD=your_database_password (Leave blank if you don't have any)

#### Migrate the project Schema
Now go to the cmd prompt or terminal and run 
<pre>php artisan migrate</pre>

#### How to run the project?
After configuring the project successfully. Go to the cmd prompt or terminal from your project directory and run 
<pre>php artisan serve</pre>
Now go to the browser and visit http://127.0.0.1:8000