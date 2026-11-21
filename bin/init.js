#! /usr/bin/env node

/* eslint no-console: 0 */

/**
 * Theme setup; thin wrapper that delegates to the shared init engine in
 * the @rtcamp/wp-tooling package, passing this theme's bin/scaffold.config.js.
 *
 * Requires `npm install`. Invoke with `npm run init`.
 */

/**
 * External dependencies
 */
const path = require('path');

/**
 * Internal dependencies
 */
const config = require('./scaffold.config');

const argv = process.argv.slice(2);

if (argv.includes('--help') || argv.includes('-h')) {
	console.log(
		`Usage: npm run init -- [options]   (or: node bin/init.js [options])

Set up or manage this theme via the shared @rtcamp/wp-tooling init engine.
Status and help are read-only.

Options:
  --name="Theme Name"       Theme name (required with --yes during setup).
  --version=X.Y.Z           Initial version (default 1.0.0).
  --yes                     Non-interactive; setup requires --name.
  --keep-examples           Keep every example set.
  --remove-examples[=a,b]   Remove all (no value) or the listed example keys.
  --features=a,b            Set the exact enabled feature set (e.g. hmr,tailwind).
  --enable=a / --disable=b  Toggle a single feature.
  --list [--json]           Show example set / feature status, then exit.
  --reinit / --clean        Re-run / reset helpers.
  --help, -h                Show this help.`
	);
	process.exit(0);
}

let run;
try {
	({ run } = require('@rtcamp/wp-tooling/init'));
} catch (err) {
	console.error('\nCould not load the init engine from @rtcamp/wp-tooling.');
	console.error('Ensure dependencies are installed (`npm install`).\n');
	console.error(err.message);
	process.exit(1);
}

run(config, { root: path.resolve(__dirname, '..') })
	.then(() => {
		// The engine reports cancellation/validation failure via exitCode.
		// Status queries must not write instructions or append to JSON output.
		if (process.exitCode || argv.includes('--list')) {
			process.exit(process.exitCode || 0);
		}

		process.exit(process.exitCode || 0);
	})
	.catch((err) => {
		console.error(err);
		process.exit(1);
	});
