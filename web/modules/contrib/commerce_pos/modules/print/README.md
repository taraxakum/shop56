The print submodule provides printing library which is further
used by other submodules.

This module depends on the `jQuery.print` plugin which should reside in your
site's `/libraries` directory.

We can install `jQuery.print` using composer or by downloading manually.

### Composer method
1. Open composer.json file of your site.
2. Add `"DoersGuild/jQuery.print": "master"` to the `"require"`.
```
"require": {
    .
    .
    "DoersGuild/jQuery.print": "master"
 }
```
3. Add `"libraries/{$name}": ["type:drupal-library"]`
to the `"installer-paths"`.
```
"installer-paths": {
    .
    .
    "libraries/{$name}": ["type:drupal-library"]
}
```
4. Add `DoersGuild/jQuery.print` as a new `package` to `"repositories"`.
```
"repositories": {
    .
    .
    {
        "type": "package",
        "package": {
            "name": "DoersGuild/jQuery.print",
            "version": "master",
            "type": "drupal-library",
            "source": {
                "url": "https://github.com/DoersGuild/jQuery.print.git",
                "type": "git",
                "reference": "origin/master"
            }
        }
    }
}
```
5. Run `composer update DoersGuild/jQuery.print`.

### Manual method
1. Create `libraries` folder if it doesn't exists in the docroot of website.
2. `cd` into libraries folder and run
`git clone https://github.com/DoersGuild/jQuery.print.git`.
