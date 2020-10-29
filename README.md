# NovaGram
[![GitHub license](https://img.shields.io/github/license/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/blob/master/LICENSE) [![GitHub stars](https://img.shields.io/github/stars/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/stargazers) [![Version](https://poser.pugx.org/skrtdev/novagram/version)](https://github.com/skrtdev/NovaGram/releases) [![Latest Unstable Version](https://poser.pugx.org/skrtdev/novagram/v/unstable)](https://github.com/skrtdev/NovaGram/tree/beta) [![Total Downloads](https://poser.pugx.org/skrtdev/novagram/downloads)](https://packagist.org/packages/skrtdev/novagram)


<center>
An elegant, Object-Oriented, reliable PHP Telegram Bot Interface<br>
<a href="https://docs.novagram.ga">Full Documentation</a> •
<a href="https://t.me/joinchat/JdBNOEqGheC33G476FiB2g">Public support group</a>
</center>

### Example
An example code of a simple bot that just forwards back what you send.  
Works with both getUpdates and Webhooks
```php
use skrtdev\NovaGram\Bot;

$Bot = new Bot("YOUR_TOKEN");

$Bot->onUpdate(function (Update $update) use ($Bot) {

    if(isset($update->message)){ // update is a message
        $message = $update->message;
        $chat = $message->chat;

        if(isset($message->from)){ // message has a sender
            $user = $message->from;

            $message->forward(); // forward() with no parameters will forward the Message back to the sender
        }
    }
});
```

## Features

- **Full**: All the Methods and Types implemented in Bot Api 4.9  
- **Extendable**: With [Prototypes](https://docs.novagram.ga/prototypes.html), you can add your custom functionalities  
- **Easy**: Exactly like original Bot Api, with Objects too  
- **Ready**: You can start creating your amazing bot right now, thanks to many Built-in features, such as [Conversations](https://docs.novagram.ga/database.html), [Entities Parser](/) and [getDC](https://docs.novagram.ga/docs.html#getUsernameDC)  
- **Secure**: When using Webhooks, there is a Built-in Telegram IP Check, that works with Cloudflare too!  

### Why another PHP library?

I decided to build my own php library for telegram bot api because all the libraries i found on the web [made too difficult even to do a simple thing](docs/compare.md), such as a sendMessage.  
NovaGram is built in order to bring a lightweight alternative to make bots, made simple even for beginners, but powerful for who already knows how to implement it.


### Installation via [Composer](https://getcomposer.org)

Install NovaGram via Composer  
```
composer require skrtdev/novagram dev-beta
```

After Installation, include NovaGram with:
```php
require __DIR__ . '/vendor/autoload.php';
```

If you wanna test features under development [check out beta branch](https://github.com/skrtdev/NovaGram/tree/beta)  

More info in the [Documentation](https://docs.novagram.ga)  
Public support group at [https://t.me/joinchat/JdBNOEqGheC33G476FiB2g](https://t.me/joinchat/JdBNOEqGheC33G476FiB2g)
