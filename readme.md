Starred Projects:

Architecture:
- Symfony 4

Database Outline:
- starred_projects
  - project
    - ``` id ```
    - ``` created_at datetime ``` - Date project entry was created in system
    - ``` modified_at datetime ``` - Date project entry was modified in system (not used currently)
    - ``` repository_id int(11) ``` - Repository Id from Github API
    - ``` name varchar(50) ``` - Name from Github API
    - ``` url varchar(200) ``` - Public Url from Github API
    - ``` repository_creation_date datetime ``` - Repository Creation Date from Github API
    - ``` repository_late_push_date datetime ``` - Repository Last Push Date from Github API
    - ``` description varchar(1000) ``` - Description from Github API
    - ``` stars int(11) ``` - Stargazers count from Github API

Usage:
- There is a command to update the listings of starred projects. It is: ``` bin/console repositories:fetch ``` 
- This will delete all existing projects and grab a fresh copy. This is runnable by the command line as well as clicking the `Update List` button in the UI.

To start:

``` vagrant reload --provision ```
