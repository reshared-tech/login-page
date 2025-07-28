# login-page
A test page with login function

## Project initialization
### Code repository construction
- Create a github repository (completed)
- Set branch protection rules (main is for protecting branches)

## Requirement Analysis and Design
### Functional requirements confirmation
- Core Functions:
    - Login/Registration/Password recovery
    - Multi-factor authentication (SMS/email verification code)
    - Third-party Login (OAuth2.0)
- Security Requirements:
    - Password strength policy
    - Anti-brute force cracking (verification codes and interface rate limiting)
    - CSRF protection
- Experience Optimization:
    - Page animation effect
    - SEO configuration
- Log collection：
    - Page statistics tracking points
    - Page anomaly log upload
    - Interface and resource response time statistics and alarm
- Technology selection：
    - Backend: PHP 8.4
    - Front-end: Vue3 + Typescript + Tailwind
    - Database: Mysql 8.0
    - Cache: Redis
- Others：
    - Unit Testing
    - Automated release

## Confirmed demand points
- Log in and register with email/username + password
- sql injection protection

## Development steps
- 1. Build a basic MVC framework
- 2. Data table design
- 3. Front-end page construction
- 4. Debug the login and registration functions
- 5. Optimize the front-end style and add responsive support
- 6. Unit testing