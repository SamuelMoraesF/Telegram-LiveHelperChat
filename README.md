# Telegram LiveHelperChat
[LiveHelperChat](http://livehelperchat.com/) notifications over [Telegram](http://telegram.org/)

# Setup

Access the folder `extension/` at the root of LiveHelperChat and clone this repo:

`git clone https://github.com/SamuelMoraesF/Telegram-LiveHelperChat.git telegram`

Now, change the settings:

`nano telegram/settings/settings.ini.php`

Create a [telegram bot](https://core.telegram.org/bots) and put your token in the `telegramBot` variable.

Insert receivers into the `receivers` array as the following example:

`array("chatid" => "​​XXXXXXXX", "operator" => "test@example.org")`

* `chatid`: (required) Id of user/group
* `operator`: (optional) Email address(in LiveHelperChat) of the operator that will log into the chat
