# Getting started

This guide gets the IMET theme running on a local WordPress site and confirms that a source edit reaches the frontend.
Run commands from the theme directory unless a step says otherwise.

## Prerequisites

- **Git**
- **Composer 2**
- **PHP 8.2+**
- **Node and npm** matching [`.nvmrc`](../.nvmrc) (use `nvm` or another version manager)
- **Docker**, running, for `wp-env` and the PHP tests

## 1. Get the theme

```bash
git clone https://github.com/Anupkankale/imet-theme.git
cd imet-theme
nvm install && nvm use
```

## 2. Install dependencies

```bash
composer install
```

Composer's install hook also runs `npm i`, so you don't need to run npm afterwards. If you used `--no-scripts`, run
`npm install` yourself.

## 3. Start WordPress and activate the theme

The committed `.wp-env.json` mounts the theme on PHP 8.2. The PHP tests run in a separate environment from
`.wp-env.tests.json`.

```bash
npm run wp-env start
npm run wp-env run cli -- wp theme activate imet-theme
npm run build:dev
```

Open [the local site](http://localhost:5890) and [WordPress admin](http://localhost:5890/wp-admin/) (`admin` /
`password` on a fresh install). Under Appearance, confirm **ImetBlocktheme** is active, then open the Site Editor and
check that the templates load.

The FAQ structured data and the migration command live in the companion plugin
[`imet-core`](https://github.com/Anupkankale/imet-core). Install and activate it on the same site when you work on those
features.

## 4. Make a visible edit

```bash
npm run start:assets
```

In `src/css/frontend/styles.scss`, temporarily add `body { outline: 3px solid red; }`. Wait for the rebuild, refresh the
frontend, then remove the rule and stop the watcher with Ctrl+C.

Next: [Local development](local-development.md) for watchers, checks and the production build, the
[design system](design-system.md) for tokens, and the [development guide](../DEVELOPMENT.md) for adding PHP classes.
