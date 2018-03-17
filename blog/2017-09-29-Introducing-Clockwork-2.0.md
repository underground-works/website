<!--
authors:
  - its (@itsgoingd)
tags:
  - clockwork
  - release
perex: "I'm happy to announce, after 4 years and 14 releases, **a new major version of Clockwork is now available**. I've tried to make this feel like a truly major release, with exciting new features and some long overdue improvements and fixes. Let's check it out."
-->

# Introducing Clockwork 2.0

I'm happy to announce, after 4 years and 14 releases, **a new major version of Clockwork is now available**. I've tried to make this feel like a truly major release, with exciting new features and some long overdue improvements and fixes. Let's check it out.

With the recent release of **Laravel 5.5**, Clockwork comes **fully compatible and supports the package auto-discovery**. This means the installation is now as easy as running:

```
$ composer require itsgoingd/clockwork
```

The Chrome extension got a bit of a **UI refresh** including a new tab bar, collapsable requests list, headers and request data is now sorted by name and logged objects now show class names for the first few levels.

![Clockwork UI refresh](/images/blog/2017-09-29-Introducing-Clockwork-2.0/ui-refresh.png)

When you open Clockwork, **the last executed request will now be automatically shown**. Did your app just crash and you want to inspect executed queries? Simply open Clockwork and the current request will be there for you. Do you need more older requests? Scroll down the requests list and click on **"load more requests"**.

The long awaited **dark theme is finally here**, it will be automatically used when you set your DevTools to use the dark theme.

![Clockwork dark theme](/images/blog/2017-09-29-Introducing-Clockwork-2.0/dark-theme.png)

**A Clockwork Firefox add-on is now officially available!** The Firefox version has all the features of the Chrome version, including the refreshed UI, new tabs, dark theme and all other new features. You can download the add-on via the [Firefox Add-ons page](https://addons.mozilla.org/en-US/firefox/addon/clockwork-dev-tools/).

![Clockwork Firefox Add-on](/images/blog/2017-09-29-Introducing-Clockwork-2.0/firefox.png)

Clockwork 2.0 comes with two brand new tabs. **The *cache* tab** shows some basic stats like hits, misses, writes, but also all cache queries including the data. This makes debugging cache usage in your Laravel apps a breeze!

![Clockwork cache tab](/images/blog/2017-09-29-Introducing-Clockwork-2.0/cache-tab.png)

**The *events* tab** contains all custom events fired in your Laravel application. Debugging event-based applications might get pretty confusing. What events were fired? Where? What was the payload? What listeners were executed? The new *events* tab answers all these questions.

![Clockwork events tab](/images/blog/2017-09-29-Introducing-Clockwork-2.0/events-tab.png)

The core idea of Clockwork was always bringing php dev tools to the browser. Not everyone wants to install a browser extension though. Maybe you are not working on your own computer, or maybe you use a different browser. **Clockwork 2.0 now comes with a web UI available right in your application**, simply visit `http://your.app/__clockwork` and you can use the Clockwork app with all the features of the browser version.

![Clockwork web UI](/images/blog/2017-09-29-Introducing-Clockwork-2.0/web-ui.png)

This solution brings the best of both worlds, you can use the Clockwork app anywhere, without installing extensions, yet we still don't inject anything to your application output. This comes with some additional benefits, the web UI will show all requests executed by the application. Developing an API for a mobile application? Now you can inspect all the API requests.

Clockwork stores the requests metadata in a flat json files. A few versions back, **an SQL storage option was added**, though this was never well documented. I've planned to switch to a Sqlite storage by default, but after some benchmarking I've decided to **keep the flat files storage as default**. You can change this in the configuration.

Storing metadata in an SQL database opens up a new possibilities, for example, in an API for a mobile app we used this data to provide requests log and stats on the administration dashboard. SQL storage now also adds support for the PostgreSQL database, along with existing Sqlite and MySQL support.

One of the long overdue improvements in Clockwork 2.0 is the auto-cleanup of the collected metadata. Up until now, the collected metadata was never automatically cleaned, which could easily lead to hundreds of megabytes of data over the course of a few weeks of usage. Now all **metadata older than 1 week will automatically be cleaned**, you can change this limit in the configuration.

The new major version also contains some amazing community contributions. A **PSR-7 data source** makes Clockwork easily integrate with any application or framework implementing PSR-7. **Slim 3 integration** is now also available and Doctrine data source was refactored to be able to be used with Doctrine DBAL without the EntityManager. Thanks to [Samuel Perrichon](https://github.com/sperrichon) for these contributions!

Being a new major version, this release comes with some breaking changes. I finally **dropped PHP 5.3 support**, with 5.4 being the new minimal required version. I've also **dropped CodeIgniter support**, as I never used this framework myself, it was hard to keep the code quality to my standards. Slim 2 integration was moved to `Clockwork\Support\Slim\Legacy` to make room for the new Slim 3 middleware.

If any of these changes affect you, feel free to keep using the latest 1.x version, which will be supported by the browser extensions indefinitely. Otherwise, upgrading should be as easy as changing the version requirement in your `composer.json`.

While this release took quite some time to wrap up, I'm pretty happy with the result, you can read the [full changelog here](https://underground.works/clockwork/changelog). Please let me know how do you like the new release and what should I work on next, feel free to use the contact email - info@underground.works - or the [GitHub issue tracker](https://github.com/itsgoingd/clockwork/issues).
