Yii1 REST API with JWT Authentication

A simple REST API built with Yii 1.x framework that demonstrates JWT-based authentication, allowing secure access to protected endpoints. This project is ideal for learning API authentication and showcasing a backend project on GitHub.

Features:
User login with email and password
JWT token generation on login
Protected API endpoints that require JWT token in Authorization header
Simple MySQL / SQLite database integration
Sample Users table with id, name, email, password_hash, status, and created_at

Database Setup:
Create a database (MySQL or SQLite)

Run the schema SQL:
# For MySQL
mysql -u root -p your_database < api/protected/data/schema.mysql.sql
# For SQLite (optional)
sqlite3 testdrive.db < api/protected/data/schema.sqlite.sql


Update api/protected/config/database.php with your DB credentials.
Do not commit sensitive credentials. Use db.php.example as a template.

Installation:
Clone the repository:
git clone https://github.com/Sanjay-Rahul-S/yii1-jwt-auth-api.git
cd yii1-jwt-auth-api/api
Install dependencies via Composer (if required):
composer install
Start a local PHP server (or use Apache/Nginx):
php -S localhost:8080

Usage
Login
curl -X POST \
  -d "email=admin@example.com" \
  -d "password=Sanjay@123" \
  "http://localhost:8080/index.php/apiAuth/login"

Response:

{
  "ok": true,
  "user_id": 1,
  "email": "admin@example.com",
  "token": "YOUR_JWT_TOKEN_HERE"
}

The token is generated using JWT and must be included in subsequent requests to access protected endpoints.

Access Protected API
curl -X GET \
  -H "Authorization: Bearer YOUR_JWT_TOKEN_HERE" \
  "http://localhost:8080/index.php/apiData/protected"

Response:

{
  "ok": true,
  "message": "This is protected data",
  "user": {
    "id": 1,
    "email": "admin@example.com"
  }
}

Requests without a valid token will return an unauthorized error.

Project Structure
api/
├─ index.php                # Entry point
├─ protected/
│  ├─ controllers/          # API controllers
│  ├─ components/           # UserIdentity, ApiController
│  ├─ models/               # User, AuthToken
│  ├─ config/               # DB & Yii configs
│  └─ views/                # Optional web views
├─ css/                     # Styling files
├─ themes/                  # Yii default theme
└─ data/                    # Database schema and sample data

Technologies Used:
PHP 7.x
Yii 1.x Framework
JWT (JSON Web Token) Authentication
MySQL / SQLite
