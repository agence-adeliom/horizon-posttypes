# Horizon PostTypes

Horizon PostTypes is a powerful library designed to integrate seamlessly with Horizon Tools, allowing you to create, manage, and reuse custom post types across multiple WordPress sites with ease.

## Key Features

- **Automatic Post Type Management**: Easily list and import post types into your project using the `import:posttype` command.
- **Simplified Post Type Creation**: Quickly define new post types by adding dedicated PHP classes.

## Installation Instructions

To install Horizon PostTypes in your project, follow these steps:

### 1. Configure the Composer Repository

Add the Horizon PostTypes repository configuration to the `"repositories"` section of your `composer.json` file:

```json
{
  "type": "vcs",
  "url": "git@github.com:agence-adeliom/horizon-posttypes.git"
}
```

### 2. Install the Package

```bash
composer require agence-adeliom/horizon-posttypes
```

## How to Use

- **Import Existing Post Types**: Use the `import:posttype` command to view and import available post types into your project.

## Example Setup

Here’s a quick guide to creating a new post type:

### 1. Define a Post Type Class
- Path: `src/PostTypes/MyCustomPostType.php`
- Example content:

```php
<?php

namespace Adeliom\HorizonPostTypes\PostTypes;

class MyCustomPostType
{
    // Define your post type logic here
}
```

### 2. Add the Post Type to the Service
- Open the file `src/Services/HorizonPostTypesService.php`
- Add your class to the `getAvailablePostTypes()` method so it appears in the import command:

```php
public static function getAvailablePostTypes(): array
{
    return [
        CustomerReview::class => [],
        FAQ::class => [],
        LandingPage::class => [],
        MyCustomPostType::class => [], // Add your post type here
    ];
}
```
