# Showcase

A Laravel package which adds the ability to create "showcases", or view boxes which contain cards "trophies" of items. It also includes an admin panel to manage displays and trophies, which can only be accessed by a logged-in Auth user. Intended for use by Laravel 5.4+

> Still being developed!

## [Projects](https://github.com/BrokerExchange/Showcase/projects):

  - [ ] [Roadmap](https://github.com/BrokerExchange/Showcase/projects/1)


## Installation

### Install the package

```
composer require brokerexchange/showcase
```

To include the assets, you have two options:

  1. `@import "vendor/brokerexchange/showcase/resources/assets/build/public";` in your main stylesheet, which will include the styles as part of your app's compiled styles.
    
  2. `php artisan vendor:publish --tag=showcase-assets` and link to `/vendor/showcase/public.css` in the `<head>`.

If you want to publish all the assets:
```
php artisan vendor:publish --tag=showcase
```

> TODO: Finish this section and fix things so you don't have to use public/vendor

### Install the package development environment

```
git clone [the-url]
composer install
npm install
```

#### Test Project
To create a test project:
`bash build-test-project.sh`

> This can also be used to rebuild the test project if you messed something up.

If you want to use a different DB, change the credentials at the top of `build-test-project.sh` to match your desired credentials.

#### Update
To update the test project with package changes:
`bash update-test-project.sh`

This will also dump composer's autoload and clear the Laravel cache and compiled views.

Flags you can use:
  - `--migrations`: run database migrations
  - `--rundev`: run the package `npm run dev` before updating the test project

#### Authentication
The test project generates Auth during the build. A default user is created with the test project:

> email: homestead@test.email <br>
> password: secret

You will need this to access the Showcase admin panels, as they are secured behind the Auth middleware by default. This can be changed from the config file.

#### Assets
To build the package JS and SCSS assets during development, just use the `--rundev` flag when running the update script. It will take care of compiling your assets and moving them to the proper locations in the test project.

You will still need to add a link for the showcase stylesheets to the test project `head`, as outlined in the package install instructions.

---

## Use

Showcase is designed to be as simple to use as possible.

### Displays
Using displays on your frontend is easy. First, get a display and pass it into the view:

```
$display = \Showcase\Showcase::display('Sample Box'); // display($id) works as well!
...
return view('view.name', compact('display'));
```

To use it in the view, simply use the `@showcaseDisplay()` directive:

```
@showcaseDisplay($display)
```

The display's template will be rendered automatically.

### Trophies

If you look in the default display component views, you'll notice that they each call `showcaseTrophy($trophy, $display)`. This directive renders a trophy component view, which renders a trophy's component view (or the display's default trophy component view, if `force_trophy_default` is set to `true`).

Both display and trophy component views can be customized.

> Note: Currently, there is no "sort" functionality, but you can still sort trophies within a display by detaching/attaching trophies from a display, which will put a particular trophy last in the sorting order. This is for alpha functionality only, and proper sorting will be in place for 1.0

---

## End User Customization

### Display Components
After you've installed the package, you can use `php artisan vendor:publish --tag=showcase` to publish the package resources.

#### Modify Existing Views
Once the resources are published, you can find them in the `resources/views/vendor/showcase` directory. You can modify any of the package views, including the admin panels.

#### Add Custom Display Component
If you want to add a custom component, just create a new file in `resources/views/vendor/showcase/public/components`. Then, when creating or editing a display, type in the name of your custom component (sans the blade extension) and your display will use it!

#### Custom CSS
Just target the Showcase selectors with your CSS to customize the styling. To make the custom styling show up on the admin panels, make sure you add a link tag for your CSS to the `_stylesheets` include in `resources/views/vendor/showcase/app/includes`.

### Configuration
There are some configuration options exposed for you in the config file `showcase.php`.

#### Table Prefix
By default, all showcase tables are prefixed with `showcase_`. You may change this to whatever you desire.

#### Middleware
By default, all admin routes for Showcase are passed through `web` and `auth`. You may change this array in config to add or remove middleware as you want.
