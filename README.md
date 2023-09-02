# Maillink 0.8.21

Creates a `mailto:` link without a visible mail address in the source text.

<p align="center"><img src="maillink-screenshot.png" alt="Screenshot"></p>

## How to install an extension

[Download ZIP file](https://github.com/pftnhr/yellow-maillink/archive/refs/heads/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to create a `mailto:` link

Create a `[mailto]` shortcut.

## Examples

`mailto:` link with custom link text

    [mailto "Custom link text"]

and with a different e-mail address than entered in `yellow-system.ini`

    [mailto "Custom link text" my.other.mail@domain.tld]

## Settings

The following settings can be configured in file system/extensions/yellow-system.ini:

    MailAddress = default e-mail address
    MailLinktext = default link text

If `MailAddress` is neither filled in here nor in the [mailto] shortcut, the email of the webmaster (yellow-system.ini, line 5) will be taken.

## Developer

Robert Pfotenhauer. [Get help](https://datenstrom.se/yellow/help/).
