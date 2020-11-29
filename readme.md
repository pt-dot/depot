# DEPOT - DOT Engineering Portal

[![Netlify Status](https://api.netlify.com/api/v1/badges/05f56fe4-91fa-401d-9f9e-b67b49cd5add/deploy-status)](https://app.netlify.com/sites/depot-dev/deploys)

DEPOT is built with an amazing static site from [Jigsaw](https://jigsaw.tighten.co/).


## Installation

### Technical Requirements

- PHP >= 7.1
- Composer
- Node.js
- NPM

Check detail at [Jigsaw System Requirement](https://jigsaw.tighten.co/docs/installation/)

### Running Locally

1. Clone DEPOT Repository

```bash
git clone https://github.com/pt-dot/depot.git
```

2. Navigate to DEPOT's directory then run composer for installation

```bash
composer install
```

3. Run locally with command:

```bash
./vendor/bin/jigsaw serve
```

4. Navigate your browser using address `http://localhost:8000`

---

## Adding Content

You can write your content using a [variety of file types](http://jigsaw.tighten.co/docs/content-other-file-types/). By default, this starter template expects your content to be located in the `source/docs` folder. If you change this, be sure to update the URL references in `navigation.php`.

The first section of each content page contains a YAML header that specifies how it should be rendered. The `title` attribute is used to dynamically generate HTML `title` and OpenGraph tags for each page. The `extends` attribute defines which parent Blade layout this content file will render with (e.g. `_layouts.documentation` will render with `source/_layouts/documentation.blade.php`), and the `section` attribute defines the Blade "section" that expects this content to be placed into it.

```yaml
---
title: Navigation
description: Building a navigation menu for your site
extends: _layouts.documentation
section: content
---
```

[Read more about Jigsaw layouts.](https://jigsaw.tighten.co/docs/content-blade/)

---

### Adding Assets

Any assets that need to be compiled (such as JavaScript, Less, or Sass files) can be added to the `source/_assets/` directory, and Laravel Mix will process them when running `npm run local` or `npm run production`. The processed assets will be stored in `/source/assets/build/` (note there is no underscore on this second `assets` directory).

Then, when Jigsaw builds your site, the entire `/source/assets/` directory containing your built files (and any other directories containing static assets, such as images or fonts, that you choose to store there) will be copied to the destination build folders (`build_local`, on your local machine).

Files that don't require processing (such as images and fonts) can be added directly to `/source/assets/`.

[Read more about compiling assets in Jigsaw using Laravel Mix.](http://jigsaw.tighten.co/docs/compiling-assets/)

---

## Building Your Site

Now that you’ve edited your configuration variables and know how to customize your styles and content, let’s build the site.

```bash
# build static files with Jigsaw
./vendor/bin/jigsaw build

# compile assets with Laravel Mix
# options: dev, staging, production
npm run dev
```
---

## Deploying Site

Currently this site is hosted using [Netlify](https://www.netlify.com/) and you may access it at [Depot](https://depot-dev.netlify.com/). This repo is deployed using Github Actions and to deployed it automatically, setup `NETLIFY_AUTH_TOKEN` and `NETLIFY_SITE_ID` to repo settings. Just make sure you have Netlify is already setup with `master` branch deployed configuration.

> If you want to host with your version site to another Netlify host, fork this repo and setup your Netlify configuration

## Contribution

All DOT's Ranger may contribute to fix, ask question, or propose a handbook into DEPOT Platform.

1. Ask a Question: Open Github issue and explain your question
2. Fix or propose content: Fork repo, make Pull Request and explain your fix
3. Management will review your PR or issue.
4. For non DOT's Ranger, you can submit PR to fix minor issue such as typo or UI glitch, etc.

