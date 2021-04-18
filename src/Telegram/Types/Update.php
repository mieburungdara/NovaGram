<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents an incoming update.At most one of the optional parameters can be present in any given update.
*/
class Update extends \Telegram\Update{

    use simpleProto;

    /** @var int The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you're using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially. */
    public int $update_id;

    /** @var Message|null New incoming message of any kind — text, photo, sticker, etc. */
    public ?Message $message = null;

    /** @var Message|null New version of a message that is known to the bot and was edited */
    public ?Message $edited_message = null;

    /** @var Message|null New incoming channel post of any kind — text, photo, sticker, etc. */
    public ?Message $channel_post = null;

    /** @var Message|null New version of a channel post that is known to the bot and was edited */
    public ?Message $edited_channel_post = null;

    /** @var InlineQuery|null New incoming inline query */
    public ?InlineQuery $inline_query = null;

    /** @var ChosenInlineResult|null The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot. */
    public ?ChosenInlineResult $chosen_inline_result = null;

    /** @var CallbackQuery|null New incoming callback query */
    public ?CallbackQuery $callback_query = null;

    /** @var ShippingQuery|null New incoming shipping query. Only for invoices with flexible price */
    public ?ShippingQuery $shipping_query = null;

    /** @var PreCheckoutQuery|null New incoming pre-checkout query. Contains full information about checkout */
    public ?PreCheckoutQuery $pre_checkout_query = null;

    /** @var Poll|null New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot */
    public ?Poll $poll = null;

    /** @var PollAnswer|null A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself. */
    public ?PollAnswer $poll_answer = null;

    /** @var ChatMemberUpdated|null The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user. */
    public ?ChatMemberUpdated $my_chat_member = null;

    /** @var ChatMemberUpdated|null A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates. */
    public ?ChatMemberUpdated $chat_member = null;

    /**
     * Get the sender Id
     * @return User_Id|null
     */
    public function UserID()
    {
        if ($this->message !== null) {
            return $this->message->from->id ?? null;
        }

        if ($this->edited_message !== null) {
            return $this->edited_message->from->id ?? null;
        }

        if ($this->channel_post !== null) {
            return $this->channel_post->from->id ?? null;
        }

        if ($this->edited_channel_post !== null) {
            return $this->edited_channel_post->from->id ?? null;
        }

        if ($this->inline_query !== null) {
            return $this->inline_query->from->id;
        }

        if ($this->chosen_inline_result !== null) {
            return $this->chosen_inline_result->from->id;
        }

        if ($this->callback_query !== null) {
            return $this->callback_query->from->id;
        }

        if ($this->shipping_query !== null) {
            return $this->shipping_query->from->id;
        }

        if ($this->pre_checkout_query !== null) {
            return $this->pre_checkout_query->from->id;
        }

        if ($this->poll_answer !== null) {
            return $this->poll_answer->user;
        }

        return null;
    }

    /**
     * Get the sender first name
     * @return text|null
     */
    public function FirstName()
    {
        if ($this->message !== null) {
            return $this->message->from->first_name ?? null;
        }

        if ($this->edited_message !== null) {
            return $this->edited_message->from->first_name ?? null;
        }
        if ($this->channel_post !== null) {
            return $this->channel_post->from->first_name ?? null;
        }

        if ($this->callback_query !== null) {
            return $this->callback_query->from->first_name;
        }

        return null;
    }

    /**
     * Get the sender last name
     * @return LastName|null
     */
    public function LastName()
    {
        if ($this->message !== null) {
            return $this->message->from->last_name ?? null;
        }

        if ($this->edited_message !== null) {
            return $this->edited_message->from->last_name ?? null;
        }

        if ($this->channel_post !== null) {
            return $this->channel_post->from->last_name ?? null;
        }

        if ($this->callback_query !== null) {
            return $this->callback_query->from->last_name;
        }

        return null;
    }

    /**
     * Get the sender username
     * @return LastName|null
     */
    public function Username()
    {
        if ($this->message !== null) {
            return $this->message->from->username ?? null;
        }

        if ($this->edited_message !== null) {
            return $this->edited_message->from->username ?? null;
        }
        if ($this->channel_post !== null) {
            return $this->channel_post->from->username ?? null;
        }

        if ($this->callback_query !== null) {
            return $this->callback_query->from->username;
        }

        return null;
    }

    /**
     * Get the sender language
     * @return Language|null
     */
    public function Language()
    {
        if ($this->message !== null) {
            return $this->message->from->language_code ?? null;
        }

        if ($this->edited_message !== null) {
            return $this->edited_message->from->language_code ?? null;
        }

        if ($this->channel_post !== null) {
            return $this->channel_post->from->language_code ?? null;
        }

        if ($this->callback_query !== null) {
            return $this->callback_query->from->language_code;
        }

        return null;
    }

}