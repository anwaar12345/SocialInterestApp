To run application follow below steps:
1) clone repo
2) navigate to the repo
3) run composer install
4) php artisan migrate:fresh --seed
5) npm run build to compile assets
6) to view apis import SocialInterestApp.postman_collection.json
7) create free mailtrap account connect your demo inbox insert values of mailtrap keys in following env variables 
      MAIL_USERNAME=
      MAIL_PASSWORD=
8) you must set up the mailtrap for recieving email to verify account else you will not be able to login
9) this project contains followings apis and  front end
     1.  http://localhost/SocialInterestApp/public/local/api/v1/login
     2. http://localhost/SocialInterestApp/public/local/api/v1/account/logout
     3. http://localhost/SocialInterestApp/public/local/api/v1/account(register)
     4. http://localhost/SocialInterestApp/public/local/api/v1/interests
     5. http://localhost/SocialInterestApp/public/local/api/v1/email/verify/8?expires=1683977895&hash=8006d610a09705edb85f2726017b4d38f0bc1603&signature=da97f1d3854b6768d2850484d72040aa74ff24802457efa25e3dc72f344917d0
     6. http://localhost/SocialInterestApp/public/local/api/v1/profile

all above apis has been consumed on front end with vanilla js 
   you can see Javascript code in resources/js/app.js and it is compiled by vite 
first create database with name of "social_interest"
front end code can be seen in web.php