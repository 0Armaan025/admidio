# Admidio: Your Ultimate Open-Source User Management Solution

Admidio empowers organizations and groups by providing a versatile and open-source user management system for their websites. With its flexible role model, Admidio allows you to precisely mirror your organization's structure and permissions. You can easily create and customize individual member profiles by adding or removing profile fields. 

In addition to these core features, Admidio boasts a rich array of modules, including member lists, an event manager, messaging capabilities, photo albums, and a document and file repository.

![Admidio Logo](https://www.admidio.org/images/mainpage_flying_icons.png)

[![GitHub issues](https://img.shields.io/github/issues/Admidio/admidio)](https://github.com/Admidio/admidio/issues)
[![GitHub forks](https://img.shields.io/github/forks/Admidio/admidio)](https://github.com/Admidio/admidio/network)
[![GitHub stars](https://img.shields.io/github/stars/Admidio/admidio)](https://github.com/Admidio/admidio/stargazers)
![GitHub top language](https://img.shields.io/github/languages/top/admidio/admidio)
[![GitHub license](https://img.shields.io/github/license/Admidio/admidio)](https://github.com/Admidio/admidio/blob/master/LICENSE.txt)

**Supported Languages**: :gb: :de: :denmark: :netherlands: :poland: :estonia: :ukraine: :fr: :bulgaria: :finland: :greece: :sweden: :es: :brazil: :portugal: :it: :indonesia: :hungary: :norway: :cn:

## Explore Admidio

- **Features** - Tailor roles and groups to match your organization's structure, customize user profiles, and much more.
- **Installation** - Get Admidio up and running on your web server with ease. It requires PHP 7.2 or higher and a MySQL or PostgreSQL database.
- **Update** - Follow the update instructions to keep your Admidio installation current.
- **Docker** - Experience Admidio in a Docker environment with our Dockerfile and prebuilt images.
- **Contributing** - Join the Admidio community and contribute through the forum, documentation, translations, or even coding.
- **Changelog** - Stay informed about the latest bug fixes and enhancements in each version.
- **Donation** - If you love Admidio, consider supporting the project with a donation.
- **Copyright and License** - Admidio is released under the GNU General Public License 2.
- **Credits** - Admidio is built on the shoulders of great projects, and we're grateful to their creators.

## Features

- **Flexible Roles and Groups**: Craft roles and groups that align seamlessly with your organization's structure.
- **Customizable User Profiles**: Personalize user profiles by adding or removing profile fields.
- **Relationship Management**: Establish connections between members, such as spouse or parent-child relationships.
- **Membership Lists**: Create individual membership lists for your roles.
- **Event Management**: Easily publish events online and allow members to participate.
- **Media Gallery**: Create and manage photo albums and enable users to send e-cards.
- **Effective Communication**: Send HTML emails to users, roles, and groups.
- **Data Export and Import**: Export lists to CSV, Excel, or PDF, and import users from CSV.
- **And Much More**: Explore additional features and functionalities.

## Installation

To install Admidio on your web server, ensure you have PHP 7.2 or higher and either a MySQL (version 5.0 or higher) or PostgreSQL (version 9.0 or higher) database available. Follow our [online installation instructions](https://www.admidio.org/dokuwiki/doku.php?id=en:2.0:installation) for a successful setup.

## Update

Keep your Admidio installation up to date by following our [online update instructions](https://www.admidio.org/dokuwiki/doku.php?id=en:2.0:update). Here's a brief update overview:

1. Delete the folder "adm_program" and the "index.php" of the previous version.
2. Copy the folder "adm_program" and the "index.php" from the new version.
3. Update the "adm_plugins" folder with the newly delivered plugins.
4. Access the "index.php" in your Admidio folder to initiate the update.
5. Adjust the theme in the "adm_theme" folder if necessary.

If you're updating from version 2.x or 3.x to version 4.x, please review our [special update instructions](https://www.admidio.org/dokuwiki/doku.php?id=en:2.0:update_to_version_4).

## Docker

Admidio is also available for Docker environments. You can create and use your own Docker image using our Dockerfile. Alternatively, you can use our prebuilt images from Dockerhub. Start an Admidio Docker container with the following command:

```bash
docker run --detach -it --name Admidio \
  --memory="1024m" --cpu-quota="80000" --cpuset-cpus="0-1" \
  -p 8080:8080 \
  --restart="unless-stopped" \
  -v Admidio-files:/var/www/admidio/adm_my_files \
  -v Admidio-themes:/var/www/admidio/adm_themes \
  -v Admidio-plugins:/var/www/admidio/adm_plugins \
  admidio/admidio:latest
```

For detailed instructions on using Admidio in a Docker environment, see [README-Docker.md](https://github.com/Admidio/admidio/blob/master/README-Docker.md).

## Contributing

There are numerous ways to contribute to Admidio:

- **Forum Support**: Share your knowledge and help fellow users in the [forum](https://forum.admidio.org).
- **Documentation**: Contribute to our [documentation](https://www.admidio.org/dokuwiki/doku.php?id=en:2.0:index) and improve user resources.
- **Translations**: Translate Admidio into other languages or update existing translations. You can also translate our [documentation](https://www.admidio.org/dokuwiki/doku.php?id=en:2.0:index) into English.
- **Development**: If you have PHP programming skills and knowledge of HTML, CSS, and JavaScript, you can help improve Admidio. Find our software on GitHub and learn about contributing in our [wiki](https://www.admidio.org/dokuwiki/doku.php?id=en:entwickler:fehlerkorrekturen_in_mehreren_versionen).

If you identify with any of the above roles, we invite you to join our team and contribute to making Admidio one of the best free membership software solutions.

## Changelog

Stay updated with the latest improvements and bug fixes by visiting our [changelog](https://www.admidio.org/changelog.php).

## Donation

If you appreciate Admidio, consider making a [donation](https://www.admidio.org/donate.php).
Thanks for contributing!
