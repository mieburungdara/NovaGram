# CHANGELOG

## v2.0 - Deprecations

- Classes
    - `TelegramBot`
    - `Telegram\Bot`
    - `NovaGram\Bot`
    - `Telegram\*` Types
- Bot Class
    - Settings
        - `disable_webhook` parameter (`Bot::NONE`)
        - `getUpdates` mode (`Bot::CLI`)
        - `webhook` mode (`Bot::WEBHOOK`)
    - Methods
        - `setErrorHandler` -> `addErrorHandler`
- If PHP8 only:
    - remove `$args` array in favor of PHP8 `named arguments`
    
