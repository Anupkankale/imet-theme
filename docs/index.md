# ImetBlocktheme

Developer documentation for the IMET block theme: setup, local development, the design system, assets and deployment.
Start with [Getting Started](getting-started.md).

| I want to…                         | Read                                      |
| ---------------------------------- | ----------------------------------------- |
| Get the theme running locally      | [Getting Started](getting-started.md)     |
| Edit source, run checks, and build | [Local development](local-development.md) |
| Use or change design tokens        | [Design system](design-system.md)         |
| Add a PHP class or feature by hand | [Development guide](../DEVELOPMENT.md)    |
| Deploy to the server               | [Deployment](DEPLOYMENT.md)               |

## Further reading

- [Asset builds](asset-building-process.md), [live reload](hmr.md), and [Tailwind](tailwind.md) cover build configuration.
- [Contributing](../CONTRIBUTING.md) and [maintainer notes](internal/README.md) cover working on this repository.

## Shared dependencies

The theme is built on rtCamp's open-source tooling: PHP contracts from
[wp-primitives](https://github.com/rtCamp/wp-primitives/blob/main/docs/index.md) and the scaffold tooling from
[wp-tooling](https://github.com/rtCamp/wp-tooling/blob/main/README.md).

## Command reference

| Task                     | Command                                      |
| ------------------------ | -------------------------------------------- |
| Watch and build assets   | `npm start` / `npm run build:prod`           |
| Generate a feature (CLI) | `npx wp-tooling add wp/<kind> ... --dry-run` |
| Run JS tests             | `npm run test:js`                            |
| Run PHP tests            | `npm run test:php`                           |
| Run PHP checks           | `composer phpcs && composer phpstan`         |
| Lint everything          | `npm run lint:all`                           |
