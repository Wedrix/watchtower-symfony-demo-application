Installation
========================

1. Install the [Symfony CLI](https://symfony.com/doc/current/setup.html)
2. Navigate to an appropriate directory on your filesystem
3. Clone this repository:

        git clone https://github.com/Wedrix/watchtower-symfony-demo-application.git

4. Navigate to the repository directory:

        cd watchtower-symfony-demo-application

5. Install the packages:

        composer install

6. Start the symfony server:

        symfony server:start -d

7. Install an appropriate GraphQL client, for example, [ChromeiQL](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij)
8. Access the GraphQL api from the configured endpoint, for example, <http://127.0.0.1:8000/graphql.json>
