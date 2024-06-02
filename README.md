**SWIFTCART** is a simple website coded in php with all the basic functionalities of an ecommerce portal.

**How to run this?**

-Install XAMPP

-Go to directory / open folder where XAMPP is installed. an example would be D:\xampp\htdocs

-Go to htdocs folder and paste the ecommerce folder in it.

-Start the apache server and my sql server from xampp application window.

-Open PhpmyAdmin in your browser by clicking Admin option in front of Apache in XAMPP window.

-Create a new database "ecommerce" or any other name and import the ecommerce.sql file from main folder.

-You can now use localhost to run the website on your browser. an example would be "http://localhost/ecommerce/pages/home.php"

**Possible errors**

-There could be errors regarding the path and the redirection configuration, make sure to change paths if such a problem occurs.

-Make sure to start the xampp apache and mysql before accessing through localhost.

-Do not forget to import ecommerce.sql into the phpmyadmin database, we do this to recreate the tables of the databse on which the site runs by fetching products and storing other various information.

**Additional important info**

-It has currently only one seller username:admin and password:(first five natural numbers)

-There can be more sellers but the functionality to register as a seller has not been implemented.

-There is no online payment gateway functionality.

-The site is not designed to be responsive and works best on PC.

