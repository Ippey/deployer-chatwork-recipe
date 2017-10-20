# deployer-chatwork-recipe
This repository contains chatwork recipes to integrate with deployer.

## Installing
```
composer require ippey/deployer-chatwork-recipe --dev
```

Include recipes in deploy.php file.

```php
require 'recipe/chatwork.php';
```

## Configuration

- `chatwork_api_token` – chatwork api token, **required** 
- `chatwork_room_id` – chatwork room ID, **required** 
- `chatwork_title` – the title of application, default `{{application}}`
- `chatwork_text` – notification message template, markdown supported
  ```
  _{{user}}_ deploying `{{branch}}` to *{{target}}*
  ```
- `chatwork_success_text` – success template, default:
  ```
  Deploy to *{{target}}* successful
  ```

## Tasks

- `chatwork:notify` – send message to chatwork
- `chatwork:notify:success` – send success message to chatwork

## Usage

If you want to notify only about beginning of deployment add this line only:

```php
before('deploy', 'chatwork:notify');
```

If you want to notify about successful end of deployment add this too:

```php
after('success', 'chatwork:notify:success');
```

## License
Licensed under the MIT license.