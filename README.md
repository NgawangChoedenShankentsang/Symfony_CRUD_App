# Project Title

Symfony CRUD Application

## Description
This Symfony-based application is a dynamic and user-friendly web platform designed for efficient data management. It integrates a range of features that cater to various needs, making it a versatile tool for handling data operations.

### Key Features:
    1. CRUD Operations
    2. Authentication and Authorization 
    3. MySQL Database Integration
    4. Advanced Data Handling
    5. Data Visualization
## Getting Started

### Dependencies

- Symfony: 6.1.*
- php: >= 8.1


### Installing
INFO ---> if your using local serer like XAMP and MAMP, clone the repo under htdoc folder <---
```bash
# Clone the repo
git clone https://github.com/NgawangChoedenShankentsang/Symfony_CRUD_App.git

# move to the folder
cd Symfony_CRUD_App

```

Change the env file to ".env"
</br>
Change the database URL inside ".env"
```bash
DATABASE_URL="mysql://root:root@127.0.0.1:8889/crud2?serverVersion=8&charset=utf8mb4"
```
Install the dependencies
```bash
# Install dependencies
composer install
```
DB Migration
```bash
# Run migrations
php bin/console doctrine:migrations:migrate
```
Clear the cache
```bash
# clear the cache
php bin/console cache:clear
```

## Contributing
If you would like to contribute to this project, please follow these guidelines:
#### 1. Fork the Repository
Start by forking the repository to your own GitHub account.
#### 2. Clone your Fork
```bash
git clone https://github.com/NgawangChoedenShankentsang/Symfony_CRUD_App.git

```
#### 3. Create a New Branch
Create a new branch for your changes. This helps to keep the work organized and separate from the main branch.

```bash
git checkout -b feature/your-new-feature

```
#### 4. Make Your Changes
#### 5. Commit Your Changes

```bash
git commit -m "Add a detailed description of your changes"
```
#### 6. Sync with Upstream
Before pushing your changes, sync with the upstream repository to ensure that your branch is up to date with the latest changes in the main project.
```bash
git fetch upstream
git rebase upstream/main

```

#### 7. Push to Your Fork
```bash
git push origin feature/my-new-feature

```

#### 8. Create the Pull Request
Go to the original repository on GitHub, and you'll see a prompt to create a pull request from your new branch. Click on the 'Compare & pull request' button and fill in the details.
#### 9. Describe Your Changes
In the pull request, provide a clear title and a detailed description of what your changes are and why they are needed. Reference any relevant issues.
#### 10. Submit the Pull Request
After reviewing your changes and ensuring they are correct, submit the pull request.
#### 11. Respond to Feedback
Once your pull request is reviewed, be responsive to feedback. If changes are requested, make them in your branch and push them again. Your pull request will automatically update.
#### 12. Stay Current 
If other changes are merged into the main branch while your pull request is open, make sure to rebase and update your branch to keep it mergeable.




## Version History
- 0.5 
    - Various bug fixes and optimization
- 0.4 
    - integration with chart.js
- 0.3
    - Added Sorting, Filter and Pagination
- 0.2 
    - Authentication and Authorization 
- 0.1 
    - Initial Release


## Authors
Ngawang Choeden Shankentsang
[link](https://github.com/NgawangChoedenShankentsang)

## License 
This Project is licensed under the MIT License
