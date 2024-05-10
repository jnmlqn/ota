
# OTA

Intro:
This is the coding challenge for the application as a Software Engineer at OTA

Requirements:
1. Docker - Install Docker, follow instructions here: https://www.docker.com/
2. DDEV - Install DDEV, follow instructios here: https://ddev.com/

## HOW TO RUN
1. Go to the root folder of the repository
2. Run ddev start
3. Run ddev ssh
4. Run cp .env.example .env
5. Run composer install
6. Run npm install
7. Run php artisan migrate
8. Run php artisan db:seed
8. Run exit
9. Run npm run dev
10. Go to https://ota.ddev.site

## CREDENTIALS
1. moderator@test.com/moderator123
2. employer@test.com/employer123
3. seeker@test.com/seeker123

## NOTE
1. Email will only be logged in laravel.log as a real email provider requires DNS updates
2. If email is not received, you can run ddev ssh in the repository, then run php artisan queue:listen --queue=EmailNotificationQueue