<!--
authors:
    - its (@itsgoingd)
tags:
    - clockwork
    - underground.works
    - update
perex: "Talking about **the latest Clockwork 5.2 release**, starting **a newsletter**, leaving Twitter, **website and sponsorship** updates."
-->

# A little update

Ten years ago, I've published my **first little open-source project** called Clockwork. More than **50 thousand people** use Clockwork every week now. I'm not a person, who would care about the numbers at all. But if that means, there are 50 thousand people whose job is at least **a little bit easier**, that makes me a little happy. 

When I first started making stuff on computers, it was **a very pure form** of making. There were no likes to chase, no money to make, only the satisfaction of turning a couple of lines of code into a working thing.   

Underground.works is a testament to that. It's **2024** now, and we are still writing **open-source** - to bring joy or to make someone's life just a little bit easier - and most importantly, we're **still having fun**.

### Website

The underground.works website got **a little makeover**. It now tries to explain a little bit what the project is about and has some new stuff, like the lastest blog post, or the newsletter (more about that below). 

It now also uses all the cool tech like **Tailwind** and works well on phones and whatnot. I've also removed Google Analytics, because who cares, it's not like we have managers to report our visitor stats to.   

### Newsletter

I remember, when I got **my first iPhone**, the thing I was most excited about was installing **a Twitter app**. In fact, it has been one of my favorite places on the internet for years. But all good things have to come to an end.

Whatever X is, it's not something I can stand behind anymore. And when you don’t want to be part of something, you **do it yourself**.

If you are interested in our **open-source** work, you can now subscribe to [**a newsletter**](https://underground.works/#newsletter). Once in a while, I will open up my email app and write you **a short email about what's happening**. Plain-text emails, no ads, no tracking, no selling, no Mailchimps. And of course you can unsubscribe at any time.

We also have a [**Discord**](https://discord.com/invite/NUuCGE4). Feel free to join, whether you want to collaborate, need some help or just want to **talk about stuff**. Together with this blog, these will be the only places, where we will share updates from now on.

### Clockwork 5.2

A new minor Clockwork release is **available today**. This release contains almost **a year worth of fixes**, but also a couple of improvements, I would like to highlight here.

Clockwork exposes a lot of **sensitive information** about your app, useful in development, but **dangerous in production**. That's why Clockwork is by default enabled only when your app is in debug mode. Unfortunately, some apps end up **in production with debug mode** enabled. Which is pretty bad on it's own, but the addition of Clockwork makes it even worse.

That's why from now on, as an additional measure, Clockwork will by default be **available only on local domains** - localhost, .local, .test, .wip and 127.0.0.1 - unless explicitly enabled. You can still explicitly enable Clockwork by setting `CLOCKWORK_ENABLE` to true.

We've added a **new storage option - Redis**. This is useful especially in cloud scenarios with no persistent file storage or SQL database available. To see how to use the Redis storage, please refer to the [documentation](https://underground.works/clockwork/#docs-metadata-storage). This implementation is based on a contribution by [christopherh0rn](https://github.com/christopherh0rn), thanks!

When collecting tests, we now also support **the latest PHPUnit 10** release and **the popular Pest 2** testing framework based on it. To see how to setup collecting tests in PHPUnit 10, please refer to the [documentation](https://underground.works/clockwork/#docs-collected-data). This implementation is based on a contribution by [kdevan](https://github.com/kdevan), thanks!

Lots of fixes and other improvements are also included, for a **full list**, see the [changelog](https://underground.works/clockwork/#changelog).

### Sponsorship

One more little thing. Fortunately I'm in a good enough position, to keep **doing this for fun**. But for the people who would like to show **a bit more support**, I've also been accepting donations via the [**GitHub Sponsors**](https://github.com/sponsors/itsgoingd) program. 

It takes **an especially generous person** to donate without expecting any reward. That's why I'd like to do a little extra thing for the people who support me. Once a year, I'd like to send you a little **physical** thank you card. And maybe some stickers or something. I'll figure it out. If you'd like to receive one, send me a postal address to `info@underground.works`. 

Thank you for reading, and hopefully see you soon with more news about the upcoming projects.

🐉
