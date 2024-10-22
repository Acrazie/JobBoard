<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/EpitechMscProPromo2027/T-WEB-501-LIL_8">
    <img src="/Assets/Epitech Logo.png" alt="Logo" height="auto" width="auto">
  </a>

  <h1 align="center">JobBoard 🎉</h1>

  <h2 align="center">
    Welcome to our Epitech project: 'JobBoard'
  </h2>
</div>


<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
        <li><a href="#api">API</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
  </ol>
</details>


<!-- ABOUT THE PROJECT -->
## About The Project


As part of our first Epitech project, we need to complete a project using self-chosen technologies over the course of 2 weeks. The project will be carried out in a group of 2-3.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- Built With -->
### Built With

Here the list any major frameworks/libraries used to bootstrap our project.

* [![MySQL][MySQL]][MySQL-url]
* [![Tailwind CSS][TailwindCSS]][TailwindCSS-url]
* [![ESLint][ESLint]][ESLint-url]
* [![PHP][PHP]][PHP-url]
* [![HTML5][HTML5]][HTML5-url]
* [![JS][JS]][JS-url]
* [![FIGMA][FIGMA]][FIGMA-url]
  
<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- API -->
## API

For this project, we used 4 differents API :

- **Advertisements**
- **Company**
- **Jobsforusers**
- **Users**

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- GETTING STARTED -->
## Getting Started

To get a local copy of JobBoard up and running, follow these steps.

### Prerequisites

Ensure you have the following installed on your local machine:

* [MySQL](https:/dev.mysql.com/downloads/mysql/)
* [PHPMYADMIN](https://www.phpmyadmin.net/)
* [XAMPP](https://www.apachefriends.org/fr/index.html)

Make sure your system is update & upgrade, if not update it:
* UPDATE
`sudo apt-get update`
* UPGRADE
`sudo apt-get upgrade`

### Installation

1. **Clone the repository stocked on Github**

  Check this doc if you don't know to do it : <a href='https://docs.github.com/en/repositories/creating-and-managing-      repositories/cloning-a-repository'>**Doc**</a>

  . In the terminal on your IDE:
  ```sh
  cd /var/www/html
  ```
  Then:
  
  ```sh
  git clone `git@github.com:EpitechMscProPromo2027/T-WEB-501-LIL_8.git JobBoard`{ ! Rename it !}
  ```
    
  . Navigate to the project directory:
  ```sh
  cd JobBoard
  ```
    
2. **Set up the MySQL database**

  . Open your MySQL client and copy the SQL Script to create the database, it will create a BDD named bddRMM.

  . Now on your browser, type localhost in the search bar, then locate the dataset.php file the in the php, click on it, it should populate the BDD, and you should see message confirmation.

3. **Configure db.php connections variables**

   . Locate the db.php file, and edit it with your current mysql ids and password:

6. **Run the project**
   You're ready to go ! Just start the project by opening the /Front directory:
   - The link should looks like this :

   ```sh
   http://localhost/JobBoard/Front/
   ```
<p align="right">(<a href="#readme-top">back to top</a>)</p>

- Mayeul Desbazeille

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[PHP]: https://shields.io/badge/-PHP-3776AB?style=flat&logo=php
[PHP-url]: https://www.php.net/
[Next-url]: https://nextjs.org/
[NextAuth]: https://img.shields.io/npm/v/next-auth?color=green&label=next-auth
[NextAuth-url]: https://next-auth.js.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Express.js]: https://img.shields.io/badge/Express%20js-000000?style=for-the-badge&logo=express&logoColor=white
[Express.js-url]: https://expressjs.com/
[MySQL]: https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com/
[TailwindCSS]: https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white
[TailwindCSS-url]: https://tailwindcss.com/
[Bcrypt]: https://img.shields.io/badge/bcrypt-888888?style=for-the-badge&logo=bcrypt&logoColor=white
[Bcrypt-url]: https://www.npmjs.com/package/bcrypt
[Dotenv]: https://img.shields.io/badge/dotenv-563D7C?style=for-the-badge&logo=dotenv&logoColor=white
[Dotenv-url]: https://www.npmjs.com/package/dotenv
[NodeFetch]: https://img.shields.io/badge/node--fetch-000000?style=for-the-badge&logo=node-fetch&logoColor=white
[NodeFetch-url]: https://www.npmjs.com/package/node-fetch
[TypeScript]: https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white
[TypeScript-url]: https://www.typescriptlang.org/
[ESLint]: https://img.shields.io/badge/ESLint-4B32C3?style=for-the-badge&logo=eslint&logoColor=white
[ESLint-url]: https://eslint.org/
[HTML5]:https://camo.githubusercontent.com/d4d9d935f85b68223a3514c6a889ea3ed6a77afb5f560c05baa1a1b168077830/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f68746d6c352d2532334533344632362e7376673f7374796c653d666f722d7468652d6261646765266c6f676f3d68746d6c35266c6f676f436f6c6f723d7768697465
[HTML5-url]: https://developer.mozilla.org/fr/docs/Web/HTML
[JS]: https://shields.io/badge/JavaScript-F7DF1E?logo=JavaScript&logoColor=white&style=for-the-badge
[JS-url]: https://developer.mozilla.org/fr/docs/Web/JavaScript
[FIGMA]: https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white
[FIGMA-url]: https://www.figma.com/design/hUBK6WocFgI49uzydA5Gy0/JobBoard?node-id=13-17&t=v4xye2lrBygASuTo-1





