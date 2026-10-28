# Deployment: GitHub → Hostinger

Two repositories deploy to the same WordPress site, each with its own copy of the same workflow:

| Repository | Deploys to |
| --- | --- |
| `Anupkankale/imet-theme` | `wp-content/themes/imet-theme/` |
| `Anupkankale/imet-core` | `wp-content/plugins/imet-core/` |

Do every step below **once per repository** (the secrets have the same names; the values are the same too if both repos
deploy to the same server). If both change in one release, **deploy the theme first, then the plugin**.

```text
feature/* ──PR──▶ develop ──PR──▶ main
                     │              │
                     ▼              ▼
                 staging       production (needs your approval,
              (automatic)       and only when PRODUCTION_ENABLED=true)
```

What a deploy does: build in GitHub (no secrets there) → upload to `<name>.incoming` over SSH → swap it in (`<name>.previous` keeps
the last version) → purge cache → check the site returns 200 with no "critical error" → if that check fails, the previous version is
put back automatically. It only ever touches its own folder, never `wp-content` as a whole and never `uploads/`.

> Never paste a private key into a chat, an issue or a file in the repo. The private key only ever lives on your laptop and in the
> GitHub secret.

## a. Hostinger: turn on SSH

1. hPanel → **Websites** → your site → **Advanced → SSH Access** → enable SSH.
2. Note the **host** (an IP or `ssh.…` name), the **port** (usually `65002`; use whatever that page shows) and the
   **username** (looks like `u123456789`).

## b. Laptop: create a dedicated deploy key

```bash
ssh-keygen -t ed25519 -C "github-deploy-imet" -f ~/.ssh/imet_deploy -N ""
```

This makes `~/.ssh/imet_deploy` (private: keep it secret) and `~/.ssh/imet_deploy.pub` (public). `-N ""` means no passphrase, which a
CI job needs; that is why the key is dedicated to this one purpose and can be revoked on its own.

Add the **public** key: `cat ~/.ssh/imet_deploy.pub`, copy the line, then hPanel → **SSH Access → SSH keys** (add key) and paste it.

## c. Test the login and collect the values

```bash
ssh -i ~/.ssh/imet_deploy -p 65002 u123456789@YOUR_HOST       # should log in with no password prompt
pwd                                                            # your home folder, e.g. /home/u123456789
ls ~/domains                                                   # your sites
cd ~/domains/YOUR_DOMAIN/public_html && pwd                    # this is WP_PATH
wp --info                                                      # WP-CLI works
wp plugin is-active litespeed-cache && echo active             # decides which cache purge runs
which rsync                                                    # the deploy needs rsync on the server
exit
```

Then get the host key (this is `SSH_KNOWN_HOSTS`; it lets the workflow verify it is talking to your server):

```bash
ssh-keyscan -p 65002 YOUR_HOST
```

Compare the fingerprint with `ssh-keygen -lf <(ssh-keyscan -p 65002 YOUR_HOST 2>/dev/null)` against what you saw on the first
login, then copy the whole output as the secret.

## d. Where staging lives

Hostinger's staging site is a **separate WordPress install** with its own folder and URL, so its `WP_PATH` is different from live.
Check both:

```bash
ls ~/domains                      # look for the staging folder (often a subdomain such as staging.yourdomain.com)
```

and hPanel → your site → **Staging** for its URL. Use the staging folder's `public_html` as the **staging** `WP_PATH` and the
staging URL as the **staging** `SITE_URL`. Production later uses the live site's `public_html` and URL.

## e. GitHub setup (per repository)

1. **Branches:** create `develop` from `main` (`git switch -c develop main && git push -u origin develop`).
2. **Settings → Environments:** create **staging** and **production**.
3. In **each** environment add these **secrets** (same names, different values):

   | Secret | Value |
   | --- | --- |
   | `SSH_HOST` | host from step a |
   | `SSH_PORT` | `65002` (or what hPanel shows) |
   | `SSH_USER` | `u123456789` |
   | `SSH_KEY` | the full contents of `~/.ssh/imet_deploy` (including the BEGIN/END lines) |
   | `SSH_KNOWN_HOSTS` | output of `ssh-keyscan` from step c |
   | `WP_PATH` | that environment's `public_html` path (step c/d) |

   and one **variable** per environment: `SITE_URL`, e.g. `https://staging.yourdomain.com` (no trailing slash needed).
4. **production → Required reviewers:** add yourself. Also restrict it to the `main` branch (Deployment branches).
5. **Settings → Secrets and variables → Actions → Variables (repository):** leave `PRODUCTION_ENABLED` **unset** for now. While it is
   not exactly `true`, production deploys are skipped entirely (no approval prompt, no SSH). Set it to `true` on cutover day.
6. **Settings → Branches:** add protection rules for `develop` and `main`: require a pull request, require the status checks from
   **Test and Measure** (theme) / **CI** (plugin) to pass, no force pushes.

## f. First deploy

1. Merge a pull request into `develop`. Watch **Actions → Deploy**. It builds, uploads and runs the smoke test against `SITE_URL`.
2. Log in to the staging wp-admin once: **Appearance → Themes → activate IMET theme**, and **Plugins → activate IMET Core**.
   (Deploys never activate anything.)
3. When staging looks right, open a pull request `develop → main`. Production stays skipped until `PRODUCTION_ENABLED=true`.
4. Cutover day: set `PRODUCTION_ENABLED` to `true`, merge to `main`, approve the deployment, then activate the theme and plugin on
   the live site.

## g. Rollback

**Automatic:** if the smoke test fails, the previous version is swapped back and the job fails.

**Manual:** tag every release (`git tag v1.2.0 && git push origin v1.2.0`). To go back: **Actions → Deploy → Run workflow**, choose the
environment, and put the older tag (or a commit SHA) in **ref**. It rebuilds that version and deploys it the same way. The server
also keeps one `<name>.previous` folder for a quick manual restore over SSH:

```bash
cd ~/domains/YOUR_DOMAIN/public_html/wp-content/themes
mv imet-theme imet-theme.broken && mv imet-theme.previous imet-theme
```

## h. Rules

- **Do not use Hostinger's staging "Push to live" with Files or Full sync** once Git deploys start. It copies the staging files over
  live and overwrites what GitHub deployed. Use GitHub for code, and check exactly what a staging push would overwrite before using it for anything else.
- **Never edit theme or plugin files on the server** (or in wp-admin's file editor). The next deploy deletes them. Change the repo.
- **Deploy the theme before the plugin** when both change.
- Do not commit `vendor/`, `node_modules/` or `assets/build/`; the workflow builds them.
- Keep the deploy key dedicated to this. If it ever leaks, remove it in hPanel → SSH keys, create a new one and update `SSH_KEY`.
